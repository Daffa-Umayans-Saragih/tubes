<?php
session_start();

if (!isset($_SESSION['id_akun'])) {
  header("Location: login.html");
  exit;
}

$idAkun   = $_SESSION['id_akun'];
$username = $_SESSION['username'];
$role     = $_SESSION['role'];
$isPremium= $_SESSION['is_premium'];
?>


<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Krusty Krab | Order</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="customer_menu.css">

<style>

body { font-family: Arial, sans-serif; margin:0; background:#f4f6f8; }
.top-bar {
  position: sticky; top:0; z-index:100;
  display:flex; justify-content:space-between; align-items:center;
  padding:14px 20px;
  background: linear-gradient(135deg, #1B7EA1 0%, #145f7a);
  color:white;
}
.top-right { display:flex; align-items:center; gap:14px; }
.upgrade {
  background: rgba(255,255,255,0.2);
  padding:6px 14px;
  border-radius:999px;
  font-size:13px;
  font-weight:600;
  color:white;
  text-decoration:none;
  cursor:pointer;
}
.category-nav {
  display:flex; gap:8px; padding:12px;
  background:white; border-bottom:1px solid #ddd;
  position: sticky;
  top: 60px; /* SESUAI tinggi top-bar */
  z-index: 99;

  display: flex;
  gap: 8px;
  padding: 12px;
  background: white;
  border-bottom: 1px solid #ddd;

}
.category-nav button {
  border: none;
  padding: 8px 16px;
  border-radius: 999px;
  background: #e6e6e6;
  cursor: pointer;
  font-weight: 500;
  transition: all 0.25s ease;
}

.category-nav button.active {
  background: #F9C80E;
  color: #1B7EA1;
  font-weight: 700;
  box-shadow: 0 4px 10px rgba(249,200,14,0.5);
  transform: translateY(-1px);
}

.menu-container {
  max-width:900px; margin:auto; padding:20px 20px 100px 20px;
  display:grid;
  grid-template-columns:repeat(auto-fit, minmax(240px,1fr));
  gap:16px;
}
.menu-card {
  background:white;
  border-radius:16px;
  padding:12px;
  box-shadow:0 4px 10px rgba(0,0,0,0.08);
}
.menu-card img {
  width:100%; height:130px;
  object-fit:cover;
  border-radius:12px;
}
.add-btn {
  width:100%;
  padding:10px;
  margin-top:8px;
  border-radius:10px;
  border:none;
  background:#F9C80E;
  font-weight:600;
  cursor:pointer;
}
.membership {
  position: fixed; inset:0;
  background: rgba(0,0,0,0.45);
  display:none;
  justify-content:center;
  align-items:center;
  z-index:200;
}
.card {
  width:340px;
  background:white;
  border-radius:20px;
  overflow:hidden;
  animation:pop 0.25s ease;
}
@keyframes pop {
  from { transform: scale(0.9); opacity:0; }
  to { transform: scale(1); opacity:1; }
}
.card-header {
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:14px 16px;
  font-weight:600;
  border-bottom:1px solid #eee;
}
.close-btn {
  background:none; border:none;
  font-size:18px; cursor:pointer;
}
.card-body {
  padding:18px;
  text-align:center;
}
.price { font-size:16px; font-weight:600; margin-bottom:12px; }
.features { list-style:none; text-align:left; margin-bottom:16px; padding:0; }
.features li { margin-bottom:6px; }
.subscribe-btn {
  width:100%;
  padding:14px;
  border-radius:12px;
  border:none;
  background:#1B7EA1;
  color:white;
  font-weight:bold;
  cursor:pointer;
}
.qr { margin-top:16px; display:none; }
.qr img { width:180px; }
.success {
  margin-top:12px;
  color:green;
  font-weight:bold;
  display:none;
}
.logout-btn {
  background:none;
  border:none;
  color:white;
  font-weight:600;
  cursor:pointer;
}
.logout-btn:hover {
  text-decoration: underline;
}

/* ORDER BOTTOM SHEET */
.order-sheet {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  background: white;
  border-radius: 20px 20px 0 0;
  box-shadow: 0 -4px 20px rgba(0,0,0,0.15);
  padding: 20px;
  z-index: 150;
  transform: translateY(100%);
  transition: transform 0.3s ease;
}
.order-sheet.show {
  transform: translateY(0);
}
.order-sheet.hidden {
  transform: translateY(100%);
}
.order-content h3 {
  margin-top: 0;
  color: #1B7EA1;
}
.order-content textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 8px;
  margin: 10px 0;
  font-family: Arial, sans-serif;
  resize: vertical;
  min-height: 60px;
}
.qty {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
  margin: 15px 0;
}
.qty button {
  width: 40px;
  height: 40px;
  border: none;
  background: #F9C80E;
  border-radius: 50%;
  font-size: 20px;
  font-weight: bold;
  cursor: pointer;
}
.qty span {
  font-size: 20px;
  font-weight: bold;
  min-width: 30px;
  text-align: center;
}
#total {
  font-size: 18px;
  font-weight: bold;
  text-align: center;
  color: #1B7EA1;
}
.order-btn {
  width: 100%;
  padding: 14px;
  background: #1B7EA1;
  color: white;
  border: none;
  border-radius: 12px;
  font-weight: bold;
  font-size: 16px;
  cursor: pointer;
  margin-top: 10px;
}



/* CHECKOUT BAR */
.checkout-bar {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  background: #1B7EA1;
  color: white;
  padding: 15px 20px;
  display: none;
  justify-content: space-between;
  align-items: center;
  z-index: 100;
}
.checkout-bar.show {
  display: flex;
}
.checkout-info {
  display: flex;
  flex-direction: column;
  gap: 3px;
}
.checkout-info small {
  opacity: 0.9;
}
.checkout-btn {
  background: #F9C80E;
  color: #1B7EA1;
  border: none;
  padding: 10px 25px;
  border-radius: 10px;
  font-weight: bold;
  cursor: pointer;
}
</style>
</head>

<body>
  <script>
const CURRENT_USER = {
  isLogin: <?= isset($_SESSION['id_akun']) ? 'true' : 'false' ?>,
  id_akun: <?= isset($_SESSION['id_akun']) ? (int)$_SESSION['id_akun'] : 'null' ?>,
  username: <?= isset($_SESSION['username']) ? json_encode($_SESSION['username']) : 'null' ?>,
  role: <?= isset($_SESSION['role']) ? json_encode($_SESSION['role']) : 'null' ?>,
  is_premium: <?= isset($_SESSION['is_premium']) ? (int)$_SESSION['is_premium'] : 0 ?>
};
</script>

  
<script>
  let cart = {};
  let isTableSaved = false;
</script>


<div class="top-bar">
  <div style="display:flex;align-items:center;gap:10px">
    ☰
    <input 
      type="text"
      id="searchInput"
      placeholder="Cari menu..."
      class="menu-search"
      onkeyup="searchMenu(this.value)"
    >
  </div>
  <!-- =========================
     RESTO INFO CARD
========================= -->


  <div class="top-right">
    <span id="profileName">👤 Guest</span>
    <a href="#" class="upgrade" id="btnUpgrade">Upgrade ke Premium</a>
    <button class="logout-btn" onclick="logout()">Log Out</button>
  </div>
</div>

<div class="resto-card">
  <div class="resto-card-inner">

    <div class="resto-title">🦀 Krusty Krab — Bikini Bottom 🦀</div>
    <div class="resto-time">Open • 08.00 – 22.00</div>

    <div class="table-box-display">
      Table Number:
      <span id="tableBoxNumber">-</span>
    </div>

  </div>
</div>

<div class="category-nav">
  <button id="btn-all" class="active" onclick="filterMenu('ALL', this)">All</button>
  <button id="btn-main" onclick="filterMenu('MAIN_COURSE', this)">Main Course</button>
  <button id="btn-appetizer" onclick="filterMenu('APPETIZER', this)">Appetizer</button>
  <button id="btn-drink" onclick="filterMenu('DRINK', this)">Drinks</button>
  <button id="btn-dessert" onclick="filterMenu('DESSERT', this)">Dessert</button>
</div>


<div id="menuContainer">
  <?php include 'get_menu.php'; ?>
</div>



<!-- ORDER BOTTOM SHEET -->
<div class="order-sheet hidden" id="orderSheet">
  <div class="order-content">
    <h3 id="orderName"></h3>
    <textarea id="orderNotes" placeholder="Notes untuk dapur"></textarea>
    <div class="qty">
      <button id="minus">-</button>
      <span id="qty">1</span>
      <button id="plus">+</button>
    </div>
    <p id="total">Total: Rp0</p>
    <button class="order-btn" onclick="addToCart()">Add Order</button>
  </div>
</div>

<!-- TABLE NUMBER MODAL -->
<div class="table-modal" id="tableModal">
  <div class="table-box">
    <h3>Dine In</h3>
    <input
      type="number"
      id="tableInput"
      placeholder="Enter your table number"
      min="1"
      required
    >
    <button id="saveTable" >Save</button>
  </div>
</div>

<script>
/* =========================
   TABLE NUMBER LOGIC
========================= */

const tableModal = document.getElementById('tableModal');
const tableInput = document.getElementById('tableInput');
const saveTableBtn = document.getElementById('saveTable');



/* SIMPAN NOMOR MEJA */
saveTableBtn.addEventListener('click', () => {
  const value = parseInt(tableInput.value);

  if (!tableInput.value || isNaN(value) || value <= 0) {
    alert('Masukkan nomor meja yang valid!');
    tableInput.focus();
    return;
  }

  tableNumber = value;
  isTableSaved = true; // 🔥 INI KUNCINYA
  document.getElementById('tableBoxNumber').textContent = tableNumber;


  tableModal.classList.add('hidden');

  alert('Meja #' + tableNumber + ' berhasil disimpan');
});


/* BONUS: TEKAN ENTER = SAVE */
tableInput.addEventListener('keydown', (e) => {
  if (e.key === 'Enter') {
    saveTableBtn.click();
  }
});
</script>


<!-- CHECKOUT BAR -->
<div class="checkout-bar" id="checkoutBar">
  <div class="checkout-info">
    <div id="cartList"></div>
    <small>Table #<span id="tableDisplay">-</span></small>
  </div>
  <button class="checkout-btn" onclick="checkout()">Checkout</button>

</div>


<!-- MEMBERSHIP MODAL -->
<div class="membership" id="membership">
  <div class="card">
    <div class="card-header">
      <span>Premium Membership</span>
      <button class="close-btn" onclick="closeMembership()">✕</button>
    </div>
    <div class="card-body">
      <p class="price">Rp 99.000 / bulan</p>
      <ul class="features">
        <li>✓ Akses khusus member</li>
        <li>✓ Simulasi order eksklusif</li>
        <li>✓ Prioritas layanan</li>
      </ul>
      <button class="subscribe-btn" id="subscribeBtn">Berlangganan Sekarang</button>
      <div class="qr" id="qr">
        <p>Scan QR untuk pembayaran</p>
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=ewallet">
      </div>
      <div class="success" id="success">Pembayaran telah berhasil</div>
    </div>
  </div>
</div>

<script>
// =====================
// STATE
// =====================
let tableNumber = null;
let currentItem = { name: '', price: 0, qty: 1 };

// =====================
// USER AUTH
// =====================
let user = CURRENT_USER;

if (user.isLogin) {
  document.getElementById('profileName').textContent =
    "👤 " + user.username;
} else {
  document.getElementById('profileName').textContent =
    "👤 Guest";
}


// ELEMENTS
const profileName = document.getElementById('profileName');
const btnUpgrade = document.getElementById('btnUpgrade');
const membershipOverlay = document.getElementById('membership');

// =====================
// REDIRECT PREMIUM (FIX UTAMA)
// =====================
if (user && user.is_premium === true) {
  window.location.href = 'membership_menu.html';
}

// =====================
// DISPLAY USER
// =====================
if (user && user.username) {
  profileName.textContent = "👤 " + user.username;
} else {
  profileName.textContent = "👤 Guest";
  btnUpgrade.style.display = 'none';
}

// =====================
// ORDER FLOW
// =====================
function openOrder(name, price) {

  if (!isTableSaved) {
    alert('Silakan masukkan dan simpan nomor meja terlebih dahulu');
    return;
  }

  currentItem = { name, price, qty: 1 };
  document.getElementById('orderName').textContent = name;
  document.getElementById('qty').textContent = '1';
  document.getElementById('orderNotes').value = '';
  updateTotal();

  const sheet = document.getElementById('orderSheet');
  sheet.classList.remove('hidden');
  sheet.classList.add('show');
}


document.getElementById('plus').onclick = () => {
  currentItem.qty++;
  document.getElementById('qty').textContent = currentItem.qty;
  updateTotal();
};

document.getElementById('minus').onclick = () => {
  if(currentItem.qty > 1){
    currentItem.qty--;
    document.getElementById('qty').textContent = currentItem.qty;
    updateTotal();
  }
};

function updateTotal(){
  const total = currentItem.price * currentItem.qty;
  document.getElementById('total').textContent =
    `Total: Rp${total.toLocaleString('id-ID')}`;
}

function addToCart() {
  if (!isTableSaved) {
    alert('Masukkan nomor meja terlebih dahulu');
    return;
  }

  const name = currentItem.name;

  if (cart[name]) {
    cart[name].qty += currentItem.qty;
  } else {
    cart[name] = {
      name: name,
      price: currentItem.price,
      qty: currentItem.qty,
      note: document.getElementById('orderNotes').value
    };
  }

  document.getElementById('orderSheet').classList.remove('show');
  updateCheckoutBar();
}



// =====================
// CHECKOUT BAR
// =====================
function updateCheckoutBar() {
  const cartList = document.getElementById('cartList');
  cartList.innerHTML = '';

  const keys = Object.keys(cart);

  if (keys.length === 0) {
    document.getElementById('checkoutBar').classList.remove('show');
    return;
  }

  keys.forEach(key => {
    const item = cart[key];

    const row = document.createElement('div');
    row.className = 'cart-row';

    row.innerHTML = `
      <span>
        <strong>${item.name}</strong><br>
        Rp${(item.price * item.qty).toLocaleString('id-ID')}
      </span>

      <!-- EDIT JUMLAH -->
      <input 
        type="number"
        min="1"
        value="${item.qty}"
        class="cart-qty"
        onchange="updateQty('${key}', this.value)"
      >

      <!-- EDIT CATATAN -->
      <input
        type="text"
        class="cart-note"
        placeholder="Catatan"
        value="${item.note ?? ''}"
        onchange="updateNote('${key}', this.value)"
      >

      <!-- HAPUS -->
      <button 
        class="cart-remove"
        onclick="removeItem('${key}')"
        title="Hapus item"
      >✕</button>
    `;

    cartList.appendChild(row);
  });

  document.getElementById('tableDisplay').textContent = tableNumber ?? '-';
  document.getElementById('checkoutBar').classList.add('show');
}


function updateQty(name, newQty) {
  const qty = parseInt(newQty);

  if (isNaN(qty) || qty <= 0) {
    removeItem(name);
    return;
  }

  cart[name].qty = qty;
  updateCheckoutBar();
}

function updateNote(name, newNote) {
  if (!cart[name]) return;
  cart[name].note = newNote;
}

function removeItem(name) {
  delete cart[name];
  updateCheckoutBar();
}



// =====================
// TABLE NUMBER
// =====================
document.getElementById('saveTable').onclick = () => {
  const val = document.getElementById('tableInput').value;
  if(val > 0){
    tableNumber = parseInt(val);
    document.getElementById('tableModal').classList.remove('show');
  }
};

// =====================
// CHECKOUT
// =====================
function checkout() {

  if (!isTableSaved) {
    alert('Masukkan nomor meja terlebih dahulu');
    return;
  }

  const items = Object.values(cart);
  if (items.length === 0) {
    alert('Cart kosong');
    return;
  }

  fetch('checkout.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({
      table: tableNumber,
      items: items
    })
  })
  .then(res => res.json())
  .then(data => {
    if (data.status !== 'success') {
      alert(data.message || 'Checkout gagal');
      return;
    }

    // 🔥 INI KUNCI UTAMA
    currentTransaksi = data.id_transaksi;
    currentTotal = data.total;

    // tampilkan popup pembayaran
    document.getElementById('paymentPopup').classList.add('show');
  });
}





// =====================
// MEMBERSHIP
// =====================
btnUpgrade?.addEventListener('click', e=>{
  e.preventDefault();
  membershipOverlay.style.display = 'flex';
});

function closeMembership(){
  membershipOverlay.style.display = 'none';
}

document.getElementById('subscribeBtn').onclick = () => {
  document.getElementById('qr').style.display = 'block';

const payTab = window.open('','_blank');
  payTab.document.write(`
    <html>
    <head><title>DANA</title></head>
    <body style="background:#008FE5;font-family:Arial">
      <div style="background:white;width:300px;margin:100px auto;padding:20px;border-radius:20px;text-align:center">
        <h3>DANA</h3>
        <p>Pembayaran Premium</p>
        <p><b>Rp 99.000</b></p>
        <button style="width:100%;padding:14px;background:#008FE5;color:white;border:none;border-radius:12px"
          onclick="localStorage.setItem('payment_done','true');window.close()">
          Konfirmasi Pembayaran
        </button>
      </div>
    </body>
    </html>
  `);

  const check = setInterval(()=>{
    if(localStorage.getItem('payment_done')==='true'){
      clearInterval(check);
      localStorage.removeItem('payment_done');

      fetch('pay_premium.php',{
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body: JSON.stringify({username:user.username})
      })
      .then(res=>res.json())
      .then(data=>{
        if(data.status==='success'){
          btnUpgrade.style.display='none';
          subscribeBtn.disabled=true;
          subscribeBtn.textContent="Akun Anda sudah premium";
          success.style.display='block';
        }
      });
    }
  },500);
};

// =====================
// LOGOUT (FIX FINAL)
// =====================
function logout() {
  window.location.href = 'logout.php';
}

// =====================
function filterMenu(tipe, btn) {
  // set active button
  document.querySelectorAll('.category-nav button')
    .forEach(b => b.classList.remove('active'));
  btn.classList.add('active');

  document.querySelectorAll('.menu-item').forEach(item => {
    if (tipe === 'ALL' || item.dataset.tipe === tipe) {
      item.style.display = 'block';
    } else {
      item.style.display = 'none';
    }
  });
}

/* =========================
   AUTO CATEGORY BY SCROLL
========================= */

const categoryOrder = [
  'MAIN_COURSE',
  'APPETIZER',
  'DRINK',
  'DESSERT'
];

const categoryButtons = {
  MAIN_COURSE: document.getElementById('btn-main'),
  APPETIZER: document.getElementById('btn-appetizer'),
  DRINK: document.getElementById('btn-drink'),
  DESSERT: document.getElementById('btn-dessert')
};

window.addEventListener('scroll', () => {
  const scrollMiddle = window.innerHeight / 2;

  for (let tipe of categoryOrder) {
    const firstItem = document.querySelector(
      `.menu-item[data-tipe="${tipe}"]`
    );

    if (!firstItem) continue;

    const rect = firstItem.getBoundingClientRect();

    // Jika kategori sudah masuk area tengah layar
    if (rect.top <= scrollMiddle && rect.bottom >= 0) {
      setActiveCategory(tipe);
      break;
    }
  }
});

function setActiveCategory(tipe) {
  document
    .querySelectorAll('.category-nav button')
    .forEach(btn => btn.classList.remove('active'));

  if (categoryButtons[tipe]) {
    categoryButtons[tipe].classList.add('active');
  }
}

/* =========================
   AUTO SCROLL KE KATEGORI BERIKUTNYA
========================= */

const categoryFlow = [
  'MAIN_COURSE',
  'APPETIZER',
  'DRINK',
  'DESSERT'
];

let currentAutoIndex = 0;
let isAutoScrolling = false;

window.addEventListener('scroll', () => {
  if (isAutoScrolling) return;

  const currentType = categoryFlow[currentAutoIndex];
  const items = document.querySelectorAll(
    `.menu-item[data-tipe="${currentType}"]`
  );

  if (!items.length) return;

  const lastItem = items[items.length - 1];
  const rect = lastItem.getBoundingClientRect();

  // Jika item terakhir kategori sudah lewat layar
  if (rect.bottom < window.innerHeight * 0.6) {
    const nextIndex = currentAutoIndex + 1;
    if (nextIndex >= categoryFlow.length) return;

    const nextType = categoryFlow[nextIndex];
    const nextItem = document.querySelector(
      `.menu-item[data-tipe="${nextType}"]`
    );

    if (nextItem) {
      isAutoScrolling = true;
      currentAutoIndex = nextIndex;

      nextItem.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });

      // aktifkan button kategori
      setActiveCategory(nextType);

      setTimeout(() => {
        isAutoScrolling = false;
      }, 800);
    }
  }
});

function searchMenu(keyword) {
  const search = keyword.toLowerCase();

  document.querySelectorAll('.menu-item').forEach(item => {
    const name = item.querySelector('.menu-title')
      ?.textContent.toLowerCase() || '';

    if (name.includes(search)) {
      item.style.display = 'block';
    } else {
      item.style.display = 'none';
    }
  });

  // reset auto scroll index biar tetap jalan normal
  currentAutoIndex = 0;
}
</script>
<!-- =========================
     POPUP PILIH PEMBAYARAN
========================= -->


<script>
  let pendingCheckoutData = null;

function openPaymentPopup() {
  if (!tableNumber || Object.keys(cart).length === 0) {
    alert('Lengkapi pesanan dan nomor meja');
    return;
  }

  // simpan data checkout sementara
  pendingCheckoutData = {
    table: tableNumber,
    items: Object.values(cart)
  };

  document.getElementById('paymentPopup').classList.add('show');
}

function closePaymentPopup() {
  document.getElementById('paymentPopup').classList.remove('show');
}
let currentTransaksi = null;
let currentTotal = 0;

function showPaymentPopup(id, total) {
  currentTransaksi = id;
  currentTotal = total;
  document.getElementById('paymentPopup').classList.remove('hidden');
}

function payQRIS() {
  window.location.href =
    `qris.php?id=${currentTransaksi}&total=${currentTotal}`;
}

function payDANA() {
  window.location.href =
    `dana.php?id=${currentTransaksi}&total=${currentTotal}`;
}




</script>
<div class="payment-popup" id="paymentPopup">
  <div class="payment-card">

    <h3>Pilih Metode Pembayaran</h3>

    <div class="payment-methods">

      <!-- QRIS -->
      <button class="pay-btn qris" onclick="payQRIS()">
        <img src="qris.png" alt="QRIS">
        <span>Bayar dengan QRIS</span>
      </button>

      <!-- DANA -->
      <button class="pay-btn dana" onclick="payDANA()">
        <img src="dana.png" alt="DANA">
        <span>Bayar dengan DANA</span>
      </button>

    </div>

    <button class="close-pay" onclick="closePaymentPopup()">Batal</button>

  </div>
</div>

</body>
</html>