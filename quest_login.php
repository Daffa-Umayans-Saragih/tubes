<?php
session_start();
require 'koneksi.php';

/* =========================
   BUAT USERNAME GUEST UNIK
========================= */

// hitung berapa guest sudah ada
$q = mysqli_query(
  $conn,
  "SELECT COUNT(*) AS total FROM akun WHERE status='GUEST'"
);
$row = mysqli_fetch_assoc($q);

$guestNumber = $row['total'] + 1;
$username = "guest" . $guestNumber;

/* =========================
   INSERT AKUN GUEST
========================= */
$sql = "
  INSERT INTO akun (username, status, is_premium)
  VALUES (?, 'GUEST', 0)
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$id_akun = mysqli_insert_id($conn);

/* =========================
   SIMPAN KE SESSION
========================= */
$_SESSION['id_akun']   = $id_akun;
$_SESSION['username']  = $username;
$_SESSION['role']      = 'GUEST';
$_SESSION['is_premium']= 0;

/* =========================
   REDIRECT
========================= */
header("Location: quest_menu.php");
exit;
