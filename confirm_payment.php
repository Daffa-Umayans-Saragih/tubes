<?php
session_start();
header('Content-Type: application/json');
require 'koneksi.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id_transaksi'])) {
  echo json_encode(['status'=>'error','message'=>'ID transaksi kosong']);
  exit;
}

$id_transaksi = (int)$data['id_transaksi'];

/* =========================
   UPDATE TRANSAKSI → SELESAI
========================= */
$sql = "
  UPDATE transaksi 
  SET status_transaksi = 'SELESAI'
  WHERE id_transaksi = ?
";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_transaksi);
mysqli_stmt_execute($stmt);

/* =========================
   CEK APAKAH SUDAH ADA
========================= */
$cek = mysqli_prepare(
  $conn,
  "SELECT id_pesanan FROM kelola_pesanan WHERE id_transaksi = ?"
);
mysqli_stmt_bind_param($cek, "i", $id_transaksi);
mysqli_stmt_execute($cek);
$resCek = mysqli_stmt_get_result($cek);

if (mysqli_num_rows($resCek) > 0) {
  echo json_encode(['status'=>'success','message'=>'Sudah diproses']);
  exit;
}

/* =========================
   AMBIL DETAIL PESANAN
========================= */
$q = "
  SELECT 
    dt.no_meja,
    dt.jumlah,
    m.nama_menu
  FROM detail_transaksi dt
  JOIN menu m ON dt.id_menu = m.id_menu
  WHERE dt.id_transaksi = ?
";

$stmt = mysqli_prepare($conn, $q);
mysqli_stmt_bind_param($stmt, "i", $id_transaksi);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

$itemList = [];
$no_meja = null;

while ($row = mysqli_fetch_assoc($res)) {
  $no_meja = $row['no_meja'];
  $itemList[] = $row['jumlah'] . "x " . $row['nama_menu'];
}

$itemText = implode(', ', $itemList);

/* =========================
   INSERT KELOLA_PESANAN
========================= */
$sqlInsert = "
  INSERT INTO kelola_pesanan
  (id_transaksi, no_meja, item, status)
  VALUES (?, ?, ?, 'COOKING')
";

$stmt = mysqli_prepare($conn, $sqlInsert);
mysqli_stmt_bind_param(
  $stmt,
  "iis",
  $id_transaksi,
  $no_meja,
  $itemText
);
mysqli_stmt_execute($stmt);

echo json_encode([
  'status' => 'success',
  'message' => 'Pembayaran berhasil & pesanan masuk dapur'
]);
