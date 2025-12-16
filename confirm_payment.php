<?php
session_start();
header('Content-Type: application/json');
require 'koneksi.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id_transaksi'], $data['metode'])) {
  echo json_encode([
    'status' => 'error',
    'message' => 'Data tidak lengkap'
  ]);
  exit;
}

$id_transaksi = (int)$data['id_transaksi'];
$metode       = $data['metode'];

/* =========================
   UPDATE STATUS TRANSAKSI
========================= */
$sql = "
  UPDATE transaksi 
  SET status_transaksi = 'SELESAI'
  WHERE id_transaksi = ?
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_transaksi);
mysqli_stmt_execute($stmt);

echo json_encode([
  'status' => 'success',
  'message' => 'Pembayaran berhasil'
]);
