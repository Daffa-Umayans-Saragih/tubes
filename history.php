<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['id_akun'])) {
  die('Login diperlukan');
}

if ($_SESSION['role'] === 'GUEST') {
  echo "Guest tidak dapat melihat riwayat.";
  exit;
}

$id_akun = $_SESSION['id_akun'];
$username = $_SESSION['username'];

$sql = "
  SELECT 
    t.id_transaksi,
    t.kode_transaksi,
    t.total_belanja,
    t.id_akun,
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

$transaksis = [];
while ($row = mysqli_fetch_assoc($res)) {
  $transaksis[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Riwayat Pesanan</title>
  <style>
    body { font-family: Arial; margin: 20px; background: #f9f9f9; }
    .struk { border: 1px solid #ccc; padding: 15px; margin-bottom: 25px; width: 500px; background: #fff; box-shadow: 0 0 5px rgba(0,0,0,0.1); }
    .title { font-weight: bold; font-size: 18px; margin-bottom: 5px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 4px; text-align: left; }
    .total-row { font-weight: bold; border-top: 1px solid #aaa; margin-top: 8px; padding-top: 5px; }
    .status { margin-top: 8px; font-style: italic; color: green; }
    .buttons { margin-top: 30px; }
    .buttons a {
      display: inline-block;
      padding: 10px 18px;
      margin-right: 10px;
      background: #008FE5;
      color: #fff;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
    }
    small { color: #888; font-size: 12px; }
  </style>
</head>
<body>

<h2>Riwayat Pesanan</h2>

<?php foreach ($transaksis as $trx): ?>
  <div class="struk">
    <div class="title">
      Kode: <?= $trx['kode_transaksi'] ?> | Akun: <?= $trx['id_akun'] ?> (<?= $trx['username'] ?>)<br>
      <small>Tanggal: <?= date('d M Y H:i', strtotime($trx['created_at'])) ?></small>
    </div>

    <table>
      <tr><th>Menu</th><th>Catatan</th><th>Subtotal</th></tr>
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
          <td><?= $item['jumlah'] . "x " . $item['nama_menu'] ?></td>
          <td><?= $item['catatan'] ?? '-' ?></td>
          <td>Rp<?= number_format($item['subtotal'], 0, ',', '.') ?></td>
        </tr>
      <?php endwhile; ?>
    </table>

    <div class="total-row">No Meja: <?= $trx['no_meja'] ?> | Total: Rp<?= number_format($trx['total_belanja'], 0, ',', '.') ?></div>
    <div class="status">Status: <?= strtoupper($trx['status']) ?></div>
  </div>
<?php endforeach; ?>

<div class="buttons">
  <a href="wait.php">🔙 Kembali ke Struk</a>
  <a href="customer_menu.php">🛒 Pesan Lagi</a>
</div>

</body>
</html>
