<?php
header('Content-Type: application/json');
$conn = new mysqli("localhost","root","","tubes");
$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];

$stmt = $conn->prepare("UPDATE akun SET status='premium' WHERE username=?");
$stmt->bind_param("s",$username);
$stmt->execute();
echo json_encode(['status'=>'ok']);
?>
