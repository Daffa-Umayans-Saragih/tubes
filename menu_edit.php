<?php
require 'koneksi.php';

mysqli_query($conn, "
  UPDATE menu SET
    nama_menu='{$_POST['nama_menu']}',
    harga_menu={$_POST['harga_menu']},
    tipe='{$_POST['tipe']}'
  WHERE id_menu={$_POST['id_menu']}
");

header('Location: admin_dashboard.php#menu');
