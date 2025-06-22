<?php
$servername = "localhost";     // Local sunucu adı
$username = "root";            // XAMPP / MAMP varsayılan kullanıcı adı
$password = "";                // Varsayılan şifre (genelde boş)
$dbname = "bohem_db";          // Localde oluşturduğun veritabanının adı

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>







