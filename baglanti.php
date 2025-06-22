<?php
// InfinityFree Hosting Ayarları - Gerçek Bilgiler
$servername = "sql306.infinityfree.com";  // MySQL Hostname
$username = "if0_39296038";               // MySQL Username
$password = "rBo86TUxuA7wT6";             // MySQL Password
$dbname = "if0_39296038_bohem_menu";      // MySQL Database Name

// Yerel geliştirme için (XAMPP/WAMP) - Yorum satırı
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "bohem_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Türkçe karakter desteği
$conn->set_charset("utf8");
?>







