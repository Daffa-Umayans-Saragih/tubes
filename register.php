<?php
header('Content-Type: application/json');

/* KONEKSI DATABASE */
$conn = new mysqli("localhost", "root", "", "tubes");
if ($conn->connect_error) {
  echo json_encode([
    'status' => 'error',
    'message' => 'Koneksi database gagal'
  ]);
  exit;
}

/* AMBIL DATA JSON */
$data = json_decode(file_get_contents("php://input"), true);

$email    = trim($data['email'] ?? '');
$username = trim($data['username'] ?? '');
$password = $data['password'] ?? '';

/* VALIDASI SERVER */
if (!$email || !$username || !$password) {
  echo json_encode([
    'status' => 'error',
    'message' => 'Data tidak lengkap'
  ]);
  exit;
}

/* VALIDASI EMAIL (DOUBLE SAFETY) */
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo json_encode([
    'status' => 'error',
    'message' => 'Format email tidak valid'
  ]);
  exit;
}

/* CEK EMAIL / USERNAME SUDAH ADA */
$cek = $conn->prepare(
  "SELECT id_akun FROM akun WHERE email = ? OR username = ?"
);
$cek->bind_param("ss", $email, $username);
$cek->execute();
$hasil = $cek->get_result();

if ($hasil->num_rows > 0) {
  echo json_encode([
    'status' => 'error',
    'message' => 'Email atau username sudah terpakai'
  ]);
  exit;
}

/* HASH PASSWORD */
$hashPassword = password_hash($password, PASSWORD_DEFAULT);

/* SIMPAN AKUN BARU */
$insert = $conn->prepare(
  "INSERT INTO akun (email, username, password, status, is_premium)
   VALUES (?, ?, ?, 'customer', 0)"
);
$insert->bind_param("sss", $email, $username, $hashPassword);

if ($insert->execute()) {
  echo json_encode([
    'status' => 'success',
    'message' => 'Registrasi berhasil!'
  ]);
} else {
  echo json_encode([
    'status' => 'error',
    'message' => 'Gagal registrasi'
  ]);
}
