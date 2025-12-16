<?php
$id = $_GET['id'];
$total = $_GET['total'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>QRIS Payment</title>
</head>
<body style="text-align:center;font-family:Arial">

<h2>QRIS Payment</h2>
<p>Total Pembayaran:</p>
<h3>Rp<?= number_format($total,0,',','.') ?></h3>

<img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=QRIS-<?= $id ?>">

<br><br>

<button onclick="confirmQRIS()">Konfirmasi Pembayaran</button>

<script>
function confirmQRIS() {
  fetch('confirm_payment.php', {
    method: 'POST',
    headers: {'Content-Type':'application/json'},
    body: JSON.stringify({
      id_transaksi: <?= $id ?>,
      metode: 'QRIS'
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
