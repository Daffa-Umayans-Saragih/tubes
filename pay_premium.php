<?php
header('Content-Type: application/json');
$conn=new mysqli("localhost","root","","tubes");

$data=json_decode(file_get_contents("php://input"),true);
$q=$conn->prepare("UPDATE akun SET is_premium=1 WHERE username=?");
$q->bind_param("s",$data['username']);

echo json_encode($q->execute()
  ? ['status'=>'success']
  : ['status'=>'error']
);
