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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $urun_adi = $_POST['urun_adi'];
    $aciklama = $_POST['aciklama'];
    $fiyat = $_POST['fiyat'];
    $kategori_id = $_POST['kategori_id'];
    $resim_ad = "";

   if (!empty($_FILES['resim']['name'])) {
    $izinli_uzantilar = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $max_boyut = 2 * 1024 * 1024; // 2 MB

    $dosya_adi = $_FILES['resim']['name'];
    $tmp_adres = $_FILES['resim']['tmp_name'];
    $dosya_boyutu = $_FILES['resim']['size'];
    $dosya_uzantisi = strtolower(pathinfo($dosya_adi, PATHINFO_EXTENSION));

    // Uzantı kontrolü
    if (!in_array($dosya_uzantisi, $izinli_uzantilar)) {
        $hata = "Sadece JPG, PNG, GIF veya WEBP dosyaları yüklenebilir.";
    }
    // Boyut kontrolü
    elseif ($dosya_boyutu > $max_boyut) {
        $hata = "Dosya boyutu 2 MB'den büyük olamaz.";
    }
    else {
        $hedef_klasor = "../resimler/";
        $yeni_resim_ad = uniqid('resim_', true) . '.' . $dosya_uzantisi;
        $yukleme_dizini = $hedef_klasor . $yeni_resim_ad;

        if (move_uploaded_file($tmp_adres, $yukleme_dizini)) {
            $resim_ad = $yeni_resim_ad;
        } else {
            $hata = "Resim yüklenirken hata oluştu.";
        }
    }
}


    $stmt = $conn->prepare("INSERT INTO urunler (urun_adi, aciklama, fiyat, kategori_id, resim) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdis", $urun_adi, $aciklama, $fiyat, $kategori_id, $resim_ad);
    $stmt->execute();

    header("Location: admin_urunler.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>Yeni Ürün Ekle - Yönetim Paneli</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f6fa;
            color: #333;
            margin: 0;
            padding: 40px 10px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
            max-width: 480px;
            width: 100%;
            transition: box-shadow 0.3s ease;
        }

        form:hover {
            box-shadow: 0 12px 36px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 26px;
            color: #222;
            text-align: center;
            letter-spacing: 0.03em;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 14px;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            font-size: 15px;
            border: 1.8px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            color: #333;
            transition: border-color 0.25s ease;
            font-family: 'Inter', sans-serif;
            resize: vertical;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus,
        textarea:focus {
            border-color: #3b82f6; /* mavi ton */
            outline: none;
            box-shadow: 0 0 8px rgba(59, 130, 246, 0.3);
        }

        textarea {
            min-height: 90px;
        }

        input[type="file"] {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
            font-family: 'Inter', sans-serif;
        }

        input[type="submit"] {
            margin-top: 30px;
            width: 100%;
            background-color: #3b82f6;
            border: none;
            color: white;
            font-size: 17px;
            font-weight: 600;
            padding: 14px 0;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 6px 16px rgba(59,130,246,0.4);
        }

        input[type="submit"]:hover {
            background-color: #2563eb;
            box-shadow: 0 8px 20px rgba(37,99,235,0.6);
        }

        a {
            display: block;
            margin-top: 25px;
            text-align: center;
            color: #3b82f6;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #2563eb;
            text-decoration: underline;
        }

        @media (max-width: 520px) {
            form {
                padding: 25px 20px;
            }
        }
    </style>
</head>
<body>

<form action="" method="POST" enctype="multipart/form-data" novalidate>
    <h2>Yeni Ürün Ekle</h2>

    <label for="urun_adi">Ürün Adı:</label>
    <input type="text" id="urun_adi" name="urun_adi" required placeholder="Örnek: Çikolatalı Kek" />

    <label for="aciklama">Açıklama:</label>
    <textarea id="aciklama" name="aciklama" placeholder="Ürünle ilgili kısa bilgi..."></textarea>

    <label for="fiyat">Fiyat (₺):</label>
    <input type="number" step="0.01" id="fiyat" name="fiyat" required placeholder="Örnek: 25.50" />

    <label for="kategori_id">Kategori:</label>
    <select id="kategori_id" name="kategori_id" required>
        <option value="">Kategori Seçin</option>
        <?php while($kat = $kategoriler->fetch_assoc()): ?>
            <option value="<?= $kat['id'] ?>"><?= htmlspecialchars($kat['kategori_adi']) ?></option>
        <?php endwhile; ?>
    </select>

    <label for="resim">Resim:</label>
    <input type="file" id="resim" name="resim" accept="image/*" />

    <input type="submit" value="Ürünü Ekle" />
    <a href="admin_urunler.php">← Geri Dön</a>
</form>

</body>
</html>

<?php $conn->close(); ?>


