<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    exit();
}

$conn = new mysqli("localhost", "root", "", "bohem_db");
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$arama = isset($_GET['arama']) ? trim($_GET['arama']) : "";

$sql = "SELECT urunler.*, kategoriler.kategori_adi 
        FROM urunler 
        LEFT JOIN kategoriler ON urunler.kategori_id = kategoriler.id";

if ($arama !== "") {
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

<?php $conn->close(); ?>
