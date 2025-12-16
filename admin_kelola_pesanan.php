<?php
session_start();
require 'koneksi.php';

/* OPTIONAL ROLE CHECK */
if ($_SESSION['role'] !== 'admin') {
  die('Akses ditolak');
}

$sql = "
  SELECT 
    kp.id_pesanan,
    kp.no_meja,
    t.username,
    kp.item,
    t.total_belanja,
    kp.waktu,
    kp.status
  FROM kelola_pesanan kp
  JOIN transaksi t ON kp.id_transaksi = t.id_transaksi
  ORDER BY kp.waktu DESC
";

$result = mysqli_query($conn, $sql);
?>
