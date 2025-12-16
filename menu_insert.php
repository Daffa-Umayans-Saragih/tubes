<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  die('Akses tidak valid');
}

$nama   = trim($_POST['nama_menu']);
$harga  = (int) $_POST['harga_menu'];
$tipe   = $_POST['tipe'];

if ($nama === '' || $harga <= 0 || $tipe === '') {
  die('Data tidak lengkap');
}

$sql = "INSERT INTO menu (nama_menu, harga_menu, tipe, is_aktif)
        VALUES (?, ?, ?, 1)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'sis', $nama, $harga, $tipe);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

header('Location: admin_dashboard.php#menu');
exit;
