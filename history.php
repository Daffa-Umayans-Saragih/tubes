<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['id_akun'])) {
  die('Login diperlukan');
}

if ($_SESSION['role'] === 'GUEST') {
  die('Guest tidak dapat melihat riwayat.');
}

$id_akun = $_SESSION['id_akun'];

$sql = "
  SELECT 
    t.id_transaksi,
    t.kode_transaksi,
    t.total_belanja,
    t.username,
    t.created_at,
    kp.no_meja,
    kp.status
  FROM transaksi t
  JOIN kelola_pesanan kp ON t.id_transaksi = kp.id_transaksi
  WHERE t.id_akun = ?
  ORDER BY t.id_transaksi DESC
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_akun);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Pesanan</title>
  <link rel="stylesheet" href="history.css">
</head>
<body>

<h2>Riwayat Pesanan</h2>

<?php while ($trx = mysqli_fetch_assoc($res)): ?>

  <?php
    // NORMALISASI STATUS (INI PENTING)
    $statusRaw   = trim($trx['status']);          // dari DB
    $statusClass = strtolower($statusRaw);        // cooking / served / selesai
  ?>

  <div class="struk">

    <div class="title">
      Kode: <?= htmlspecialchars($trx['kode_transaksi']) ?>
      <br>
      <small>
        Tanggal: <?= date('d M Y H:i', strtotime($trx['created_at'])) ?>
      </small>
    </div>

    <table>
      <tr>
        <th>Menu</th>
        <th>Catatan</th>
        <th>Subtotal</th>
      </tr>

      <?php
      $q = "
        SELECT dt.jumlah, m.nama_menu, dt.catatan, dt.subtotal
        FROM detail_transaksi dt
        JOIN menu m ON dt.id_menu = m.id_menu
        WHERE dt.id_transaksi = ?
      ";
      $stmtDtl = mysqli_prepare($conn, $q);
      mysqli_stmt_bind_param($stmtDtl, "i", $trx['id_transaksi']);
      mysqli_stmt_execute($stmtDtl);
      $resDtl = mysqli_stmt_get_result($stmtDtl);

      while ($item = mysqli_fetch_assoc($resDtl)):
      ?>
        <tr>
          <td><?= $item['jumlah'] ?>x <?= htmlspecialchars($item['nama_menu']) ?></td>
          <td><?= $item['catatan'] ? htmlspecialchars($item['catatan']) : '-' ?></td>
          <td>Rp<?= number_format($item['subtotal'], 0, ',', '.') ?></td>
        </tr>
      <?php endwhile; ?>
    </table>

    <div class="total-row">
      No Meja: <?= $trx['no_meja'] ?> |
      Total: Rp<?= number_format($trx['total_belanja'], 0, ',', '.') ?>
    </div>

    <!-- STATUS (SATU-SATUNYA, JANGAN DUPLIKAT) -->
    <div class="status <?= $statusClass ?>">
      <?php if ($statusClass === 'cooking'): ?>🍳<?php endif; ?>
      <?php if ($statusClass === 'served'): ?>🍽️<?php endif; ?>
      <?php if ($statusClass === 'selesai'): ?>✅<?php endif; ?>
      <?= strtoupper($statusRaw) ?>
    </div>

  </div>

<?php endwhile; ?>

<div class="buttons">
  <a href="wait.php">🔙 Kembali ke Struk</a>
  <a href="customer_menu.php">🛒 Pesan Lagi</a>
</div>

<!-- JS (opsional, aman dihapus) -->
<script>
   // future use: auto refresh status
   // setInterval(() => location.reload(), 15000);
</script>

</body>
</html>
