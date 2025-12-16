// ==================== STATE ====================
let cart = [];
let tableNumber = null;
let currentItem = { name: '', price: 0, qty: 1 };

// ==================== USER ====================
let user = JSON.parse(localStorage.getItem('kk_currentUser')) || {username: 'Guest', is_premium: false};

const profileName = document.getElementById('profileName');
const btnUpgrade = document.getElementById('btnUpgrade');
const membershipOverlay = document.getElementById('membership');
const subscribeBtn = document.getElementById('subscribeBtn');
const qr = document.getElementById('qr');
const success = document.getElementById('success');

/* REDIRECT JIKA PREMIUM */
if(user && user.is_premium){
  window.location.href = 'membership_menu.html';
}

/* TAMPILKAN NAMA USER */
if(user && user.username){
  profileName.textContent = "👤 " + user.username;
} else {
  btnUpgrade.style.display = 'none';
}

// ==================== SHOW TABLE MODAL ON LOAD ====================
window.addEventListener('DOMContentLoaded', () => {
  // Tampilkan modal table number saat halaman dimuat
  if(!tableNumber){
    document.getElementById('tableModal').classList.add('show');
  }
});

// ==================== ORDER SYSTEM ====================
function openOrder(name, price){
  // Cek table number dulu
  if(!tableNumber){
    document.getElementById('tableModal').classList.add('show');
    return;
  }

  currentItem = { name, price, qty: 1 };
  document.getElementById('orderName').textContent = name;
  document.getElementById('qty').textContent = '1';
  document.getElementById('orderNotes').value = '';
  updateTotal();
  
  document.getElementById('orderSheet').classList.remove('hidden');
  document.getElementById('orderSheet').classList.add('show');
}

function updateTotal(){
  const total = currentItem.price * currentItem.qty;
  document.getElementById('total').textContent = `Total: Rp${total.toLocaleString('id-ID')}`;
}

function addToCart(){
  const notes = document.getElementById('orderNotes').value;
  cart.push({
    name: currentItem.name,
    price: currentItem.price,
    qty: currentItem.qty,
    notes: notes
  });
  
  // Close order sheet
  document.getElementById('orderSheet').classList.remove('show');
  document.getElementById('orderSheet').classList.add('hidden');
  
  // Update checkout bar
  updateCheckoutBar();
}

function updateCheckoutBar(){
  const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
  document.getElementById('cartCount').textContent = `${totalItems} items`;
  document.getElementById('tableDisplay').textContent = tableNumber;
  document.getElementById('checkoutBar').classList.add('show');
}

// ==================== QUANTITY CONTROLS ====================
document.getElementById('plus').addEventListener('click', ()=>{
  currentItem.qty++;
  document.getElementById('qty').textContent = currentItem.qty;
  updateTotal();
});

document.getElementById('minus').addEventListener('click', ()=>{
  if(currentItem.qty > 1){
    currentItem.qty--;
    document.getElementById('qty').textContent = currentItem.qty;
    updateTotal();
  }
});

// ==================== TABLE NUMBER ====================
document.getElementById('saveTable').addEventListener('click', ()=>{
  const input = document.getElementById('tableInput');
  if(input.value && parseInt(input.value) > 0){
    tableNumber = parseInt(input.value);
    document.getElementById('tableModal').classList.remove('show');
    alert(`Table #${tableNumber} saved!`);
  } else {
    alert('Please enter a valid table number');
  }
});

// ==================== CHECKOUT ====================
function checkout(){
  if(cart.length === 0){
    alert('Cart is empty!');
    return;
  }
  
  const total = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
  let message = `=== KRUSTY KRAB ORDER ===\n\n`;
  message += `Table: ${tableNumber}\n\n`;
  message += `Order:\n`;
  message += `─────────────────────────\n`;
  
  cart.forEach((item, idx) => {
    message += `${idx + 1}. ${item.name}\n`;
    message += `   ${item.qty}x @ Rp${item.price.toLocaleString('id-ID')}\n`;
    message += `   Subtotal: Rp${(item.price * item.qty).toLocaleString('id-ID')}\n`;
    if(item.notes) message += `   Notes: ${item.notes}\n`;
    message += `\n`;
  });
  
  message += `─────────────────────────\n`;
  message += `TOTAL: Rp${total.toLocaleString('id-ID')}\n`;
  message += `\nOrder submitted successfully!`;
  
  alert(message);
  
  // Reset
  cart = [];
  document.getElementById('checkoutBar').classList.remove('show');
}

// ==================== MEMBERSHIP ====================
btnUpgrade.addEventListener('click', e=>{
  e.preventDefault();
  membershipOverlay.style.display='flex';
});

function closeMembership(){
  membershipOverlay.style.display='none';
}

subscribeBtn.addEventListener('click', ()=>{
  qr.style.display='block';

  const payTab = window.open('','_blank');
  payTab.document.write(`
    <html>
    <head><title>DANA</title></head>
    <body style="background:#008FE5;font-family:Arial">
      <div style="background:white;width:300px;margin:100px auto;padding:20px;border-radius:20px;text-align:center">
        <h3>DANA</h3>
        <p>Pembayaran Premium</p>
        <p><b>Rp 99.000</b></p>
        <button style="width:100%;padding:14px;background:#008FE5;color:white;border:none;border-radius:12px;cursor:pointer"
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

      // Simulasi API call
      // fetch('pay_premium.php',{...})
      
      // SET FLAG PREMIUM
      user.is_premium = true;
      localStorage.setItem('kk_currentUser', JSON.stringify(user));

      qr.style.display='none';
      success.style.display='block';

      setTimeout(()=>{
        // PINDAHKAN KE MENU PREMIUM
        window.location.href = 'membership_menu.html';
      }, 1500);
    }
  },500);
});

// ==================== LOGOUT ====================
function logout(){
  localStorage.removeItem('kk_currentUser');
  localStorage.removeItem('kk_guest');
  window.location.href = 'login.html';
}

// ==================== EVENT LISTENERS ====================
// Add to Cart buttons
document.querySelectorAll('.add-btn').forEach(btn => {
  btn.addEventListener('click', (e) => {
    const card = e.target.closest('.menu-card');
    const name = card.dataset.name;
    const price = parseInt(card.dataset.price);
    openOrder(name, price);
  });
});

// Order button
document.querySelector('.order-btn').addEventListener('click', addToCart);

// Checkout button
document.querySelector('.checkout-btn').addEventListener('click', checkout);

// Close membership button
document.querySelector('.close-btn').addEventListener('click', closeMembership);

// Logout button
document.querySelector('.logout-btn').addEventListener('click', logout);