<?php
session_start();

// Eğer kullanıcı giriş yapmamışsa, admin paneline erişim engellenmeli
if (!isset($_SESSION['user_id'])) {
    header("Location: login/login.php");  // Giriş sayfasına yönlendir
    exit();
}

echo "<h1>Hoş geldiniz, " . $_SESSION['kullanici_adi'] . "</h1>";
echo "<p>Buradan ürünleri ekleyebilir, silebilir veya fiyatları güncelleyebilirsiniz.</p>";

// Admin paneli içeriği
?>
