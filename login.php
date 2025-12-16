<?php
session_start();
header('Content-Type: application/json');
require 'koneksi.php';

// Ambil JSON dari fetch
$data = json_decode(file_get_contents("php://input"), true);

$username = trim($data['username'] ?? '');
$password = $data['password'] ?? '';

if ($username === '' || $password === '') {
  echo json_encode([
    'status' => 'error',
    'message' => 'Username dan password wajib diisi'
  ]);
  exit;
}

// Cari akun
$sql = "SELECT id_akun, username, password, status, is_premium 
        FROM akun 
        WHERE username = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$row = mysqli_fetch_assoc($result)) {
  echo json_encode([
    'status' => 'error',
    'message' => 'Akun tidak ditemukan'
  ]);
  exit;
}

// Verifikasi password
if (!password_verify($password, $row['password'])) {
  echo json_encode([
    'status' => 'error',
    'message' => 'Password salah'
  ]);
  exit;
}

// =====================
// SIMPAN KE SESSION
// =====================
$_SESSION['id_akun']   = $row['id_akun'];
$_SESSION['username']  = $row['username'];
$_SESSION['role']      = $row['status'];
$_SESSION['is_premium']= $row['is_premium'];

// =====================
// RESPONSE KE FRONTEND
// =====================
echo json_encode([
  'status'     => 'success',
  'username'   => $row['username'],
  'role'       => $row['status'],
  'is_premium' => $row['is_premium']
]);
