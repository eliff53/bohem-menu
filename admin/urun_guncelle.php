<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "bohem_db");
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$kategoriler = $conn->query("SELECT * FROM kategoriler");

if (!isset($_GET['id'])) {
    echo "Güncellenecek ürün bulunamadı.";
    exit();
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM urunler WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows == 0) {
    echo "Ürün bulunamadı.";
    exit();
}

$urun = $res->fetch_assoc();
$hata = "";
$basari = "";
$guncellendi = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $urun_adi = $_POST['urun_adi'];
    $aciklama = $_POST['aciklama'];
    $fiyat = floatval($_POST['fiyat']);  // float olarak al
    $kategori_id = $_POST['kategori_id'];
    $resim_ad = $urun['resim'];

    if (!empty($_FILES['resim']['name'])) {
        $izinli_uzantilar = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $max_boyut = 2 * 1024 * 1024; // 2 MB

        $dosya_adi = $_FILES['resim']['name'];
        $tmp_adres = $_FILES['resim']['tmp_name'];
        $dosya_boyutu = $_FILES['resim']['size'];
        $dosya_uzantisi = strtolower(pathinfo($dosya_adi, PATHINFO_EXTENSION));

        if (!in_array($dosya_uzantisi, $izinli_uzantilar)) {
            $hata = "Sadece JPG, JPEG, PNG, GIF veya WEBP dosyaları yüklenebilir.";
        } elseif ($dosya_boyutu > $max_boyut) {
            $hata = "Dosya boyutu 2 MB'den büyük olamaz.";
        } else {
            $hedef_klasor = "../resimler/";
            $yeni_resim_ad = uniqid('resim_', true) . '.' . $dosya_uzantisi;
            $yukleme_dizini = $hedef_klasor . $yeni_resim_ad;

            if (move_uploaded_file($tmp_adres, $yukleme_dizini)) {
                if (!empty($urun['resim']) && file_exists($hedef_klasor . $urun['resim'])) {
                    unlink($hedef_klasor . $urun['resim']);
                }
                $resim_ad = $yeni_resim_ad;
            } else {
                $hata = "Resim yüklenirken hata oluştu.";
            }
        }
    }

    if (empty($hata)) {
        $stmt = $conn->prepare("UPDATE urunler SET urun_adi = ?, aciklama = ?, fiyat = ?, resim = ?, kategori_id = ? WHERE id = ?");
        $stmt->bind_param("ssdsii", $urun_adi, $aciklama, $fiyat, $resim_ad, $kategori_id, $id);

        if ($stmt->execute()) {
            $basari = "Ürün başarıyla güncellendi.";
            $guncellendi = true;

            // Güncellenmiş ürünü tekrar çek
            $stmt2 = $conn->prepare("SELECT * FROM urunler WHERE id = ?");
            $stmt2->bind_param("i", $id);
            $stmt2->execute();
            $res2 = $stmt2->get_result();
            $urun = $res2->fetch_assoc();

            // 2 saniye sonra yönlendirme
            header("Refresh: 2; url=admin_urunler.php");
        } else {
            $hata = "Güncelleme sırasında hata oluştu: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün Güncelle</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            padding: 20px;
            color: #333;
        }
        h2 {
            color: #444;
        }
        form {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 20px;
            border: 1.5px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus,
        textarea:focus {
            border-color: #999;
            outline: none;
        }
        textarea {
            min-height: 100px;
            resize: vertical;
        }
        .btn {
            background-color: #555;
            color: white;
            border: none;
            padding: 12px 22px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #444;
        }
        img {
            max-width: 150px;
            border-radius: 6px;
            margin-bottom: 20px;
            box-shadow: 0 0 6px rgba(0,0,0,0.1);
        }
        .message {
            max-width: 600px;
            margin: 15px auto;
            padding: 12px 18px;
            border-radius: 6px;
            font-weight: 600;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        a.back-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
        }
        a.back-link:hover {
            text-decoration: underline;
        }
    </style>
    <script>
    let formDegisti = false;

    window.addEventListener("DOMContentLoaded", () => {
        const form = document.querySelector("form");
        const inputlar = form.querySelectorAll("input, textarea, select");

        inputlar.forEach(input => {
            input.addEventListener("input", () => {
                formDegisti = true;
            });
        });

        form.addEventListener("submit", () => {
            formDegisti = false;
        });

        // Sayfa kapatma, yenileme uyarısı
        window.addEventListener("beforeunload", function (e) {
            if (formDegisti) {
                e.preventDefault();
                e.returnValue = ""; // Modern tarayıcılarda bu yeterli
                return "";
            }
        });

        // Geri/ileri tuşları için kontrol (popstate)
        window.addEventListener("popstate", function (e) {
            if (formDegisti) {
                const cevap = confirm("Değişiklikler kaydedilmedi. Sayfadan çıkmak istediğinize emin misiniz?");
                if (!cevap) {
                    history.pushState(null, "", location.href); // Geri gitmeyi engelle
                }
            }
        });

        // Geri tuşunun popstate tetiklemesi için history state ekle
        if (history.state === null) {
            history.pushState({}, "");
        }
    });
</script>
</head>
<body>
    <h2>Ürün Güncelle</h2>

    <?php if ($basari): ?>
        <div class="message success"><?= htmlspecialchars($basari) ?> (2 saniye içinde yönlendiriliyorsunuz...)</div>
    <?php endif; ?>
    <?php if ($hata): ?>
        <div class="message error"><?= htmlspecialchars($hata) ?></div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <label>Ürün Adı:</label>
        <input type="text" name="urun_adi" value="<?= htmlspecialchars($urun['urun_adi']) ?>" required>

        <label>Açıklama:</label>
        <textarea name="aciklama"><?= htmlspecialchars($urun['aciklama']) ?></textarea>

        <label>Fiyat (₺):</label>
        <input type="number" step="0.01" name="fiyat" value="<?= htmlspecialchars($urun['fiyat']) ?>" required>

        <label>Kategori:</label>
        <select name="kategori_id" required>
            <option value="">Kategori Seçin</option>
            <?php
            // Kategorileri baştan çağır (eğer $kategoriler pointer dolmuşsa)
            $kategoriler = $conn->query("SELECT * FROM kategoriler");
            while($kat = $kategoriler->fetch_assoc()):
            ?>
                <option value="<?= $kat['id'] ?>" <?= ($kat['id'] == $urun['kategori_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($kat['kategori_adi']) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Mevcut Resim:</label>
        <?php if ($urun['resim']): ?>
            <img src="../resimler/<?= htmlspecialchars($urun['resim']) ?>" alt="Ürün Resmi">
        <?php else: ?>
            <p>Resim yok</p>
        <?php endif; ?>

        <label>Yeni Resim (Değiştirmek için):</label>
        <input type="file" name="resim">

        <input class="btn" type="submit" value="Güncelle">
    </form>

    <a class="back-link" href="admin_urunler.php">← Geri Dön</a>
</body>
</html>

<?php $conn->close(); ?>

