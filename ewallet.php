<?php
$id = $_GET['id'] ?? 0;
$total = $_GET['total'] ?? 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>E-Wallet Payment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS TERPISAH -->
  <link rel="stylesheet" href="ewallet.css">
</head>
<body>

<div class="ewallet-card">

  <h2>E-Wallet Payment</h2>

  <div class="ewallet-total-label">Total Pembayaran</div>
  <div class="ewallet-total">
    Rp<?= number_format($total,0,',','.') ?>
  </div>

  <div class="ewallet-info">
    <p>Silakan lakukan pembayaran melalui aplikasi E-Wallet pilihan Anda.</p>
    <small>(OVO, GoPay, ShopeePay, dll)</small>
  </div>

  <button class="ewallet-btn" onclick="confirmEwallet()">
    Konfirmasi Pembayaran
  </button>

</div>

<script>
function confirmEwallet() {
  fetch('confirm_payment.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      id_transaksi: <?= (int)$id ?>,
      metode: 'E-WALLET'
    })
  })
  .then(res => res.json())
  .then(() => {
    window.location.href = 'wait.php';
  })
  .catch(() => {
    alert('Gagal konfirmasi pembayaran');
  });
}
</script>

</body>
</html>
