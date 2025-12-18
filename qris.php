<?php
$id = $_GET['id'];
$total = $_GET['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>QRIS Payment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS TERPISAH -->
  <link rel="stylesheet" href="qris.css">
</head>
<body>

  <div class="qris-card">

    <h2>QRIS Payment</h2>

    <div class="qris-total-label">Total Pembayaran</div>
    <div class="qris-total">
      Rp<?= number_format($total,0,',','.') ?>
    </div>

    <div class="qris-qr">
      <img
        src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=QRIS-<?= $id ?>"
        alt="QRIS Code">
    </div>

    <button class="qris-btn" onclick="confirmQRIS()">
      Konfirmasi Pembayaran
    </button>

  </div>

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
