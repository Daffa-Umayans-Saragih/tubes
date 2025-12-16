<?php
$id = $_GET['id'];
$total = $_GET['total'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>DANA Payment</title>
</head>
<body style="text-align:center;font-family:Arial;background:#008FE5;color:white">

<h2>DANA</h2>
<p>Total Pembayaran</p>
<h3>Rp<?= number_format($total,0,',','.') ?></h3>

<button onclick="confirmDANA()" style="padding:14px;border:none;border-radius:12px">
  Konfirmasi Pembayaran
</button>

<script>
function confirmDANA() {
  fetch('confirm_payment.php', {
    method: 'POST',
    headers: {'Content-Type':'application/json'},
    body: JSON.stringify({
      id_transaksi: <?= $id ?>,
      metode: 'DANA'
    })
  })
  .then(res => res.json())
  .then(() => {
    window.location.href = 'wait.php';
  
  });
}
</script>

</body>
</html>
