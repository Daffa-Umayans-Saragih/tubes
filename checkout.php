<?php
session_start();
header('Content-Type: application/json');
require 'koneksi.php';

/* =========================
   WAJIB LOGIN
========================= */
if (!isset($_SESSION['id_akun'], $_SESSION['username'])) {
  echo json_encode(['status'=>'error','message'=>'Silakan login']);
  exit;
}

$id_akun  = (int)$_SESSION['id_akun'];
$username = $_SESSION['username'];

/* =========================
   AMBIL DATA
========================= */
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || empty($data['items']) || !isset($data['table'])) {
  echo json_encode(['status'=>'error','message'=>'Data tidak lengkap']);
  exit;
}

$items   = $data['items'];
$no_meja = (int)$data['table'];

/* =========================
   HITUNG TOTAL
========================= */
$total = 0;
foreach ($items as $i) {
  $total += ((float)$i['price'] * (int)$i['qty']);
}

/* =========================
   SIMPAN TRANSAKSI (PENDING)
========================= */
$kode = 'TRX-' . date('Ymd-His');

$stmt = mysqli_prepare($conn,"
  INSERT INTO transaksi
  (id_akun, username, kode_transaksi, total_belanja, status_transaksi)
  VALUES (?, ?, ?, ?, 'PENDING')
");
mysqli_stmt_bind_param($stmt,"issd",$id_akun,$username,$kode,$total);
mysqli_stmt_execute($stmt);

$id_transaksi = mysqli_insert_id($conn);

/* =========================
   DETAIL TRANSAKSI
========================= */
$stmtD = mysqli_prepare($conn,"
  INSERT INTO detail_transaksi
  (id_transaksi,id_menu,no_meja,jumlah,catatan,harga_satuan,subtotal)
  VALUES (?,?,?,?,?,?,?)
");

foreach ($items as $i) {
  $q = mysqli_prepare($conn,"SELECT id_menu FROM menu WHERE nama_menu=?");
  mysqli_stmt_bind_param($q,"s",$i['name']);
  mysqli_stmt_execute($q);
  $m = mysqli_fetch_assoc(mysqli_stmt_get_result($q));
  if(!$m) continue;

  $subtotal = $i['qty'] * $i['price'];
  $note = $i['note'] ?? null;

  mysqli_stmt_bind_param(
    $stmtD,
    "iiiisdd",
    $id_transaksi,
    $m['id_menu'],
    $no_meja,
    $i['qty'],
    $note,
    $i['price'],
    $subtotal
  );
  mysqli_stmt_execute($stmtD);
}

/* =========================
   RESPONSE
========================= */
echo json_encode([
  'status'=>'success',
  'id_transaksi'=>$id_transaksi,
  'total'=>$total
]);
