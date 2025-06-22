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

$hata = "";
$basari = "";

// Kullanıcı bilgilerini getir
$stmt = $conn->prepare("SELECT kullanici_adi, sifre FROM kullanicilar WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($kullanici_adi, $mevcut_hashli_sifre);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eski_sifre = trim($_POST['eski_sifre']);
    $yeni_kullanici_adi = trim($_POST['kullanici_adi']);
    $yeni_sifre = trim($_POST['sifre']);

    if (empty($eski_sifre) || empty($yeni_kullanici_adi)) {
        $hata = "Eski şifre ve kullanıcı adı boş olamaz.";
    } elseif (!password_verify($eski_sifre, $mevcut_hashli_sifre)) {
        $hata = "Eski şifre yanlış.";
    } else {
        if (!empty($yeni_sifre)) {
            $hashli_sifre = password_hash($yeni_sifre, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE kullanicilar SET kullanici_adi = ?, sifre = ? WHERE id = ?");
            $stmt->bind_param("ssi", $yeni_kullanici_adi, $hashli_sifre, $_SESSION['user_id']);
        } else {
            $stmt = $conn->prepare("UPDATE kullanicilar SET kullanici_adi = ? WHERE id = ?");
            $stmt->bind_param("si", $yeni_kullanici_adi, $_SESSION['user_id']);
        }

        if ($stmt->execute()) {
            $basari = "Bilgiler başarıyla güncellendi.";
            $_SESSION['kullanici_adi'] = $yeni_kullanici_adi;
        } else {
            $hata = "Güncelleme sırasında hata oluştu.";
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Profil Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; font-family: 'Quicksand', sans-serif; }
        .form-container { max-width: 500px; margin: 50px auto; background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="form-container">
    <h3 class="mb-4 text-center">Kullanıcı Bilgilerini Düzenle</h3>

    <?php if ($hata): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($hata) ?></div>
    <?php elseif ($basari): ?>
        <div class="alert alert-success"><?= htmlspecialchars($basari) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="kullanici_adi" class="form-label">Kullanıcı Adı</label>
            <input type="text" name="kullanici_adi" class="form-control" id="kullanici_adi" value="<?= htmlspecialchars($kullanici_adi) ?>" required>
        </div>

        <div class="mb-3">
            <label for="eski_sifre" class="form-label">Eski Şifre</label>
            <input type="password" name="eski_sifre" class="form-control" id="eski_sifre" required>
        </div>

        <div class="mb-3">
            <label for="sifre" class="form-label">Yeni Şifre <small class="text-muted">(Boş bırakırsanız şifre değişmez)</small></label>
            <input type="password" name="sifre" class="form-control" id="sifre">
        </div>

        <button type="submit" class="btn btn-primary w-100">Güncelle</button>
        <a href="../admin/admin_urunler.php" class="btn btn-secondary w-100 mt-2">Geri Dön</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
