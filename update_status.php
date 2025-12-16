<?php
session_start();
require 'koneksi.php';

$id = (int)$_POST['id_pesanan'];
$status = $_POST['status'];

$sql = "UPDATE kelola_pesanan SET status=? WHERE id_pesanan=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "si", $status, $id);
mysqli_stmt_execute($stmt);

header('Location: admin_kelola_pesanan.php');
