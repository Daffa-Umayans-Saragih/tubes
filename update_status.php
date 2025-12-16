<?php
session_start();
require 'koneksi.php';

if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'dapur') {
  die('Akses ditolak');
}

$id = (int)$_POST['id_pesanan'];
$status = $_POST['status'];

if (!in_array($status, ['COOKING','SERVED'])) {
  die('Status tidak valid');
}

$sql = "
  UPDATE kelola_pesanan
  SET status = ?
  WHERE id_pesanan = ?
";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "si", $status, $id);
mysqli_stmt_execute($stmt);

header("Location: admin_dashboard.php#orders");
exit;
