<?php
require 'koneksi.php';

$id = (int)$_GET['id'];
mysqli_query($conn, "DELETE FROM menu WHERE id_menu=$id");

header('Location: admin_dashboard.php#menu');
