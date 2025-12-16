<?php
// menu_update.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'koneksi.php';

// =========================
// VALIDASI REQUEST
// =========================
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request method');
}

// =========================
// AMBIL & VALIDASI INPUT
// =========================
$id_menu    = isset($_POST['id_menu']) ? (int)$_POST['id_menu'] : 0;
$nama_menu  = trim($_POST['nama_menu'] ?? '');
$harga_menu = isset($_POST['harga_menu']) ? (float)$_POST['harga_menu'] : 0;
$tipe       = $_POST['tipe'] ?? '';

$allowedTipe = ['MAIN_COURSE', 'APPETIZER', 'DRINK', 'DESSERT'];

// Validasi dasar
if (
    $id_menu <= 0 ||
    $nama_menu === '' ||
    $harga_menu <= 0 ||
    !in_array($tipe, $allowedTipe)
) {
    die('Data tidak valid');
}

// =========================
// UPDATE DATABASE
// =========================
$sql = "
    UPDATE menu
    SET 
        nama_menu = ?,
        harga_menu = ?,
        tipe = ?
    WHERE id_menu = ?
";

$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    die('Prepare failed: ' . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    'sdsi',
    $nama_menu,
    $harga_menu,
    $tipe,
    $id_menu
);

if (!mysqli_stmt_execute($stmt)) {
    die('Execute failed: ' . mysqli_stmt_error($stmt));
}

mysqli_stmt_close($stmt);

// =========================
// REDIRECT KEMBALI
// =========================
header('Location: admin_dashboard.php?menu_updated=1');
exit;
