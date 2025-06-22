<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bohem_db";

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}

// Formdan gelen verileri al
$kullanici_adi = $_POST['kullanici_adi'];
$sifre = $_POST['sifre'];

$stmt = $conn->prepare("SELECT * FROM kullanicilar WHERE kullanici_adi = ?");
$stmt->bind_param("s", $kullanici_adi);
$stmt->execute();
$result = $stmt->get_result();


// Eğer kullanıcı adı bulunduysa
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Şifreyi kontrol et (hashlenmiş şifreyi karşılaştırıyoruz)
    if (password_verify($sifre, $row['sifre'])) {
        // Giriş başarılı, kullanıcıyı admin paneline yönlendir
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['kullanici_adi'] = $row['kullanici_adi'];
        header("Location: /bohem-menu/admin/admin_urunler.php");
        exit();
    } else {
        // Şifre yanlış
        echo "Yanlış şifre!";
    }
} else {
    // Kullanıcı adı bulunamadı
    echo "Kullanıcı adı bulunamadı!";
}

$conn->close();
?>
