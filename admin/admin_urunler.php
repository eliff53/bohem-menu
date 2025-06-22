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

$arama = "";
$sql = "SELECT urunler.*, kategoriler.kategori_adi 
        FROM urunler 
        LEFT JOIN kategoriler ON urunler.kategori_id = kategoriler.id";

if (isset($_GET['arama']) && !empty(trim($_GET['arama']))) {
    $arama = trim($_GET['arama']);
    $sql .= " WHERE urunler.urun_adi LIKE ?";
    $stmt = $conn->prepare($sql);
    $like_arama = "%" . $arama . "%";
    $stmt->bind_param("s", $like_arama);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün Yönetimi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f4f6f9;
        }
        .card {
            border-radius: 16px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            transition: 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
        }
        .navbar {
            border-radius: 0 0 10px 10px;
        }
        .table thead {
            background-color: #343a40;
            color: #fff;
        }
        .btn-custom {
            border-radius: 30px;
        }
        footer {
            text-align: center;
            padding: 1rem;
            color: #777;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="#">🍫 Bohem Çikolata - Admin Panel</a>
        
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle rounded-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= htmlspecialchars($_SESSION['kullanici_adi']) ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="../admin/kullaniciguncelle.php">Kullanıcı Bilgilerini Güncelle</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="../login/logout.php" onclick="return confirm('Çıkış yapmak istediğinize emin misiniz?')">Çıkış Yap</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2 class="fw-bold mb-2">Ürünler</h2>
        <form method="GET" action="" class="d-flex mb-2" role="search">
           <input type="text" name="arama" class="form-control me-2" placeholder="Ürün adı ara..." style="max-width: 300px;">
        </form>
        <a href="urun_ekle.php" class="btn btn-success btn-custom">+ Yeni Ürün Ekle</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Resim</th>
                    <th>Adı</th>
                    <th>Açıklama</th>
                    <th>Fiyat</th>
                    <th>Kategori</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td>
                                <?php if ($row['resim']): ?>
                                    <img src="../resimler/<?= $row['resim'] ?>" style="width: 120px; height: auto; border-radius: 10px;">
                                <?php else: ?>
                                    Yok
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($row['urun_adi']) ?></td>
                            <td><?= htmlspecialchars($row['aciklama']) ?></td>
                            <td><?= $row['fiyat'] ?>₺</td>
                            <td><?= htmlspecialchars($row['kategori_adi']) ?></td>
                            <td>
                               <a href="urun_guncelle.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3">Güncelle</a>
                               <a href="urun_sil.php?id=<?= $row['id'] ?>" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="btn btn-outline-danger btn-sm rounded-pill px-3">Sil</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="7">Hiç ürün bulunamadı.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const aramaInput = document.querySelector('input[name="arama"]');
    const urunTablo = document.querySelector('tbody');

    aramaInput.addEventListener('input', function () {
        const arama = this.value;

        fetch('urun_ara.php?arama=' + encodeURIComponent(arama))
            .then(response => response.text())
            .then(html => {
                urunTablo.innerHTML = html;
            })
            .catch(err => console.error('Arama hatası:', err));
    });
});
</script>
</body>
</html>

<?php $conn->close(); ?>
