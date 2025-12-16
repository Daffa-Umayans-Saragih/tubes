<?php
session_start();
header('Content-Type: application/json');
require 'koneksi.php';

/* =========================
   WAJIB LOGIN
========================= */
if (!isset($_SESSION['id_akun'], $_SESSION['username'])) {
  echo json_encode([
    'status' => 'error',
    'message' => 'Silakan login terlebih dahulu'
  ]);
  exit;
}

$id_akun  = (int) $_SESSION['id_akun'];
$username = $_SESSION['username'];

/* =========================
   AMBIL DATA JSON
========================= */
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['items'], $data['table'])) {
  echo json_encode([
    'status' => 'error',
    'message' => 'Data tidak lengkap'
  ]);
  exit;
}

$items   = $data['items'];
$no_meja = (int) $data['table'];

if (count($items) === 0) {
  echo json_encode([
    'status' => 'error',
    'message' => 'Item kosong'
  ]);
  exit;
}

/* =========================
   HITUNG TOTAL
========================= */
$total = 0;
foreach ($items as $item) {
  $total += ((float)$item['price'] * (int)$item['qty']);
}

/* =========================
   SIMPAN TRANSAKSI
========================= */
$kode_transaksi = 'TRX-' . date('Ymd-His');

$sqlTransaksi = "
  INSERT INTO transaksi 
  (id_akun, username, kode_transaksi, total_belanja, status_transaksi)
  VALUES (?, ?, ?, ?, 'PENDING')
";

$stmt = mysqli_prepare($conn, $sqlTransaksi);
if (!$stmt) {
  echo json_encode(['status'=>'error','message'=>'Prepare transaksi gagal']);
  exit;
}

mysqli_stmt_bind_param(
  $stmt,
  "issd",
  $id_akun,
  $username,
  $kode_transaksi,
  $total
);

if (!mysqli_stmt_execute($stmt)) {
  echo json_encode(['status'=>'error','message'=>'Simpan transaksi gagal']);
  exit;
}

$id_transaksi = mysqli_insert_id($conn);

/* =========================
   SIMPAN DETAIL TRANSAKSI
========================= */
$sqlDetail = "
  INSERT INTO detail_transaksi
  (id_transaksi, id_menu, no_meja, jumlah, catatan, harga_satuan, subtotal)
  VALUES (?, ?, ?, ?, ?, ?, ?)
";

$stmtDetail = mysqli_prepare($conn, $sqlDetail);
if (!$stmtDetail) {
  echo json_encode(['status'=>'error','message'=>'Prepare detail gagal']);
  exit;
}

foreach ($items as $item) {

  $qMenu = mysqli_prepare(
    $conn,
    "SELECT id_menu FROM menu WHERE nama_menu = ?"
  );
  mysqli_stmt_bind_param($qMenu, "s", $item['name']);
  mysqli_stmt_execute($qMenu);
  $resMenu = mysqli_stmt_get_result($qMenu);

  if (!$menu = mysqli_fetch_assoc($resMenu)) continue;

  $id_menu  = (int) $menu['id_menu'];
  $qty      = (int) $item['qty'];
  $harga    = (float) $item['price'];
  $subtotal = $qty * $harga;
  $catatan  = $item['note'] ?? null;

  mysqli_stmt_bind_param(
    $stmtDetail,
    "iiiisdd",
    $id_transaksi,
    $id_menu,
    $no_meja,
    $qty,
    $catatan,
    $harga,
    $subtotal
  );

  mysqli_stmt_execute($stmtDetail);
}

// ============================
// INSERT KE KELOLA_PESANAN
// ============================
$sqlItem = "
  SELECT 
    dt.no_meja,
    GROUP_CONCAT(CONCAT(dt.jumlah, 'x ', m.nama_menu) SEPARATOR ', ') AS items
  FROM detail_transaksi dt
  JOIN menu m ON dt.id_menu = m.id_menu
  WHERE dt.id_transaksi = ?
  GROUP BY dt.no_meja
";

$stmtItem = mysqli_prepare($conn, $sqlItem);
mysqli_stmt_bind_param($stmtItem, "i", $id_transaksi);
mysqli_stmt_execute($stmtItem);
$resItem = mysqli_stmt_get_result($stmtItem);

if ($row = mysqli_fetch_assoc($resItem)) {
  $no_meja = $row['no_meja'];
  $items   = $row['items'];

  $sqlInsert = "
    INSERT INTO kelola_pesanan
    (id_transaksi, no_meja, item)
    VALUES (?, ?, ?)
  ";

  $stmtInsert = mysqli_prepare($conn, $sqlInsert);
  mysqli_stmt_bind_param(
    $stmtInsert,
    "iis",
    $id_transaksi,
    $no_meja,
    $items
  );
  mysqli_stmt_execute($stmtInsert);
}


/* =========================
   RESPONSE KE FRONTEND
========================= */
echo json_encode([
  'status' => 'success',
  'id_transaksi' => $id_transaksi,
  'total' => $total
]);
