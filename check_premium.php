<?php
header('Content-Type: application/json');
$conn=new mysqli("localhost","root","","tubes");

$data=json_decode(file_get_contents("php://input"),true);
$q=$conn->prepare("SELECT is_premium FROM akun WHERE username=?");
$q->bind_param("s",$data['username']);
$q->execute();
$r=$q->get_result()->fetch_assoc();

echo json_encode(['is_premium'=>$r['is_premium']==1]);
