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
   UPDATE TRANSAKSI
========================= */
$stmt = mysqli_prepare($conn,"
  UPDATE transaksi
  SET status_transaksi='SELESAI'
  WHERE id_transaksi=?
");
mysqli_stmt_bind_param($stmt,"i",$id_transaksi);
mysqli_stmt_execute($stmt);

/* =========================
   AMBIL DETAIL → GABUNG ITEM
========================= */
$q = mysqli_prepare($conn,"
  SELECT dt.no_meja, dt.jumlah, m.nama_menu
  FROM detail_transaksi dt
  JOIN menu m ON dt.id_menu=m.id_menu
  WHERE dt.id_transaksi=?
");
mysqli_stmt_bind_param($q,"i",$id_transaksi);
mysqli_stmt_execute($q);
$res = mysqli_stmt_get_result($q);

$items = [];
$no_meja = null;

while($r = mysqli_fetch_assoc($res)){
  $no_meja = $r['no_meja'];
  $items[] = $r['jumlah']."x ".$r['nama_menu'];
}

$itemText = implode(', ', $items);

/* =========================
   INSERT KELOLA_PESANAN
========================= */
$stmtI = mysqli_prepare($conn,"
  INSERT INTO kelola_pesanan
  (id_transaksi,no_meja,item,status)
  VALUES (?,?,?,'Cooking')
");
mysqli_stmt_bind_param($stmtI,"iis",$id_transaksi,$no_meja,$itemText);
mysqli_stmt_execute($stmtI);

echo json_encode([
  'status'=>'success',
  'message'=>'Pembayaran & pesanan berhasil'
]);
