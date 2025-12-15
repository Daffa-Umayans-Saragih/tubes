<?php
session_start();
header('Content-Type: application/json');
$conn=new mysqli("localhost","root","","tubes");

$data=json_decode(file_get_contents("php://input"),true);
$user=$data['username'];
$pass=$data['password'];

$q=$conn->prepare("SELECT * FROM akun WHERE username=?");
$q->bind_param("s",$user);
$q->execute();
$r=$q->get_result();

if(!$row=$r->fetch_assoc()){
  echo json_encode(['status'=>'error','message'=>'Akun tidak ditemukan']); exit;
}
if(!password_verify($pass,$row['password'])){
  echo json_encode(['status'=>'error','message'=>'Password salah']); exit;
}

$_SESSION['id_akun']=$row['id_akun'];

echo json_encode([
  'status'=>'success',
  'username'=>$row['username'],
  'role'=>$row['status'],
  'is_premium'=>$row['is_premium']
]);
