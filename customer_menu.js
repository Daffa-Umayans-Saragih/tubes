const addBtns = document.querySelectorAll('.add-btn');
const orderSheet = document.querySelector('.order-sheet');
const orderName = document.getElementById('orderName');
const qtyText = document.getElementById('qty');
const totalText = document.getElementById('total');

let qty = 1;
let price = 0;

addBtns.forEach(btn => {
  btn.onclick = () => {
    const card = btn.parentElement;
    orderName.innerText = card.dataset.name;
    price = card.dataset.price;
    qty = 1;
    qtyText.innerText = qty;
    totalText.innerText = `Total: Rp${price}`;
    orderSheet.classList.remove('hidden');
  };
});

document.getElementById('plus').onclick = () => {
  qty++;
  qtyText.innerText = qty;
  totalText.innerText = `Total: Rp${qty * price}`;
};

document.getElementById('minus').onclick = () => {
  if (qty > 1) qty--;
  qtyText.innerText = qty;
  totalText.innerText = `Total: Rp${qty * price}`;
};

document.getElementById('saveTable').onclick = () => {
  document.querySelector('.table-modal').style.display = 'none';
};
