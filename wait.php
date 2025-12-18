<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['id_akun'])) {
  die('Akses ditolak');
}

$id_akun = $_SESSION['id_akun'];

$sql = "
  SELECT 
    t.kode_transaksi,
    t.total_belanja,
    t.status_transaksi,
    t.username,
    t.created_at,
    kp.no_meja,
    kp.status AS status_pesanan,
    t.id_transaksi
  FROM transaksi t
  JOIN kelola_pesanan kp ON t.id_transaksi = kp.id_transaksi
  WHERE t.id_akun = ?
  ORDER BY t.id_transaksi DESC
  LIMIT 1
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_akun);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if (!$data = mysqli_fetch_assoc($res)) {
  echo "Tidak ada data transaksi.";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Struk Pemesanan</title>
  <link rel="stylesheet" href="wait.css">
</head>
<body>

<div class="box">
  <h2>Struk Pemesanan</h2>

  <p><strong>ID Transaksi:</strong> <?= $data['kode_transaksi'] ?></p>
  <p><strong>Username:</strong> <?= $data['username'] ?></p>
  <p><strong>Tanggal:</strong> <?= date('d M Y H:i', strtotime($data['created_at'])) ?></p>
  <p><strong>No Meja:</strong> <?= $data['no_meja'] ?></p>

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
    mysqli_stmt_bind_param($stmtDtl, "i", $data['id_transaksi']);
    mysqli_stmt_execute($stmtDtl);
    $resDtl = mysqli_stmt_get_result($stmtDtl);

    while ($item = mysqli_fetch_assoc($resDtl)):
    ?>
    <tr>
      <td><?= $item['jumlah'] . "x " . $item['nama_menu'] ?></td>
      <td><?= $item['catatan'] ?? '-' ?></td>
      <td>Rp<?= number_format($item['subtotal'], 0, ',', '.') ?></td>
    </tr>
    <?php endwhile; ?>
    <tr class="total-row">
      <td colspan="2">Total</td>
      <td>Rp<?= number_format($data['total_belanja'], 0, ',', '.') ?></td>
    </tr>
  </table>

  <div class="status">
    Status Pesanan: <?= strtoupper($data['status_pesanan']) ?>
  </div>

  <div class="buttons">
    <a href="customer_menu.php"><button>🛒 Pesan Lagi</button></a>
    <a href="history.php"><button>📜 Riwayat</button></a>
  </div>
</div>

</body>
</html>
