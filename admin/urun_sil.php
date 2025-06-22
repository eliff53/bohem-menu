<?php
session_start();

// Giriş kontrolü
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}

// Veritabanı bağlantısı
$conn = new mysqli("localhost", "root", "", "bohem_db");
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Ürün ID'si alındı mı?
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Önce ürünün resmini bul
    $stmt = $conn->prepare("SELECT resim FROM urunler WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $urun = $res->fetch_assoc();

        // Eğer resim varsa, dosyayı sil
        if (!empty($urun['resim']) && file_exists("../resimler/" . $urun['resim'])) {
            unlink("../resimler/" . $urun['resim']);
        }

        // Ürünü sil
        $stmt = $conn->prepare("DELETE FROM urunler WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

$conn->close();

// Geri yönlendir
header("Location: admin_urunler.php");
exit();
?> 
