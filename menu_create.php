<?php
require 'koneksi.php';

mysqli_query($conn, "
  INSERT INTO menu (nama_menu, harga_menu, tipe)
  VALUES (
    '{$_POST['nama_menu']}',
    {$_POST['harga_menu']},
    '{$_POST['tipe']}'
  )
");

header('Location: admin_dashboard.php#menu');
