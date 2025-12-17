<?php
session_start();

if (
  !isset($_SESSION['id_akun']) ||
  $_SESSION['role'] !== 'admin'
) {
  header("Location: login.html");
  exit;
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Krusty Krab | Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f6fa;
    }

    /* Navbar */
    .navbar {
      background: #fff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.08);
      padding: 1rem 2rem;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      height: 70px;
    }

    .navbar-brand {
      font-size: 1.5rem;
      font-weight: 700;
      color: #2c3e50;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 70px;
      left: 0;
      width: 250px;
      height: calc(100vh - 70px);
      background: #2c3e50;
      padding: 2rem 0;
      overflow-y: auto;
    }

    .sidebar .nav-link {
      color: rgba(255,255,255,0.8);
      padding: 0.875rem 1.5rem;
      display: flex;
      align-items: center;
      transition: all 0.3s;
      border-left: 3px solid transparent;
    }

    .sidebar .nav-link i {
      margin-right: 0.75rem;
      font-size: 1.1rem;
    }

    .sidebar .nav-link:hover {
      background: rgba(255,255,255,0.1);
      color: #fff;
    }

    .sidebar .nav-link.active {
      background: rgba(52, 152, 219, 0.2);
      color: #fff;
      border-left-color: #3498db;
    }

    /* Main Content */
    .main-content {
      margin-left: 250px;
      margin-top: 70px;
      padding: 2rem;
      min-height: calc(100vh - 70px);
    }

    /* Cards */
    .stat-card {
      background: #fff;
      border-radius: 8px;
      padding: 1.5rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.08);
      transition: transform 0.3s, box-shadow 0.3s;
      border-left: 4px solid;
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .stat-card.primary { border-left-color: #3498db; }
    .stat-card.success { border-left-color: #2ecc71; }
    .stat-card.warning { border-left-color: #f39c12; }
    .stat-card.danger { border-left-color: #e74c3c; }

    .stat-card .icon {
      width: 50px;
      height: 50px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      color: #fff;
    }

    .stat-card.primary .icon { background: #3498db; }
    .stat-card.success .icon { background: #2ecc71; }
    .stat-card.warning .icon { background: #f39c12; }
    .stat-card.danger .icon { background: #e74c3c; }

    .card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.08);
      border: none;
    }

    .card-header {
      background: #fff;
      border-bottom: 1px solid #ecf0f1;
      padding: 1.25rem 1.5rem;
      font-weight: 600;
      color: #2c3e50;
    }

    /* Table */
    .table {
      margin-bottom: 0;
    }

    .table thead th {
      border-bottom: 2px solid #ecf0f1;
      color: #7f8c8d;
      font-weight: 600;
      font-size: 0.875rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      padding: 1rem;
    }

    .table tbody td {
      padding: 1rem;
      vertical-align: middle;
      color: #2c3e50;
    }

    .table tbody tr {
      transition: background 0.2s;
    }

    .table tbody tr:hover {
      background: #f8f9fa;
    }

    /* Badges */
    .badge {
      padding: 0.5rem 0.875rem;
      font-weight: 500;
      border-radius: 6px;
    }

    .status-membership {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      color: #fff;
    }

    .status-member {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      color: #fff;
    }

    .status-guest {
      background: #95a5a6;
      color: #fff;
    }

    /* Buttons */
    .btn {
      padding: 0.5rem 1.25rem;
      border-radius: 6px;
      font-weight: 500;
      transition: all 0.3s;
    }

    .btn-primary {
      background: #3498db;
      border: none;
    }

    .btn-primary:hover {
      background: #2980b9;
      transform: translateY(-2px);
    }

    .btn-success {
      background: #2ecc71;
      border: none;
    }

    .btn-success:hover {
      background: #27ae60;
    }

    .btn-danger {
      background: #e74c3c;
      border: none;
    }

    .btn-danger:hover {
      background: #c0392b;
    }

    .btn-info {
      background: #3498db;
      border: none;
    }

    /* User Avatar */
    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      color: #fff;
      font-size: 0.875rem;
    }

    /* Chart Container */
    .chart-container {
      position: relative;
      height: 300px;
      padding: 1rem;
    }

    /* Trending Item */
    .trending-item {
      padding: 1rem 1.5rem;
      border-bottom: 1px solid #ecf0f1;
      transition: all 0.3s;
    }

    .trending-item:last-child {
      border-bottom: none;
    }

    .trending-item:hover {
      background: #f8f9fa;
    }

    /* Menu Card */
    .menu-card {
      border-radius: 8px;
      overflow: hidden;
      transition: all 0.3s;
    }

    .menu-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }

    .menu-card img {
      height: 200px;
      object-fit: cover;
      width: 100%;
    }

    /* Section */
    .section {
      animation: fadeIn 0.5s;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
      }
      
      .main-content {
        margin-left: 0;
      }
    }

    .section.d-none {
      display: none !important;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
  <div class="container-fluid px-0">
    <span class="navbar-brand">🦀 Krusty Krab Admin</span>
    <div class="d-flex align-items-center gap-3">
      <i class="bi bi-bell fs-5 text-muted position-relative">
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">3</span>
      </i>
      <span class="fw-semibold">Admin</span>
      <button class="btn btn-danger btn-sm" id="logoutBtn">
        <i class="bi bi-box-arrow-right"></i> Logout
      </button>
    </div>
  </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
  <nav class="nav flex-column">
    <a class="nav-link active" href="#" data-section="dashboard">
      <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a class="nav-link" href="#" data-section="orders">
      <i class="bi bi-clipboard-check"></i> Kelola Pesanan
    </a>
    <a class="nav-link" href="#" data-section="menu">
      <i class="bi bi-box"></i> Kelola Menu
    </a>
    <a class="nav-link" href="#" data-section="reports">
      <i class="bi bi-file-earmark-text"></i> Laporan
    </a>
    <a class="nav-link" href="#" data-section="customers">
      <i class="bi bi-people"></i> Data Customer
    </a>
    <a class="nav-link" href="#" data-section="analytics">
      <i class="bi bi-graph-up"></i> Analytics
    </a>
  </nav>
</div>

<!-- Main Content -->
<main class="main-content">

  <!-- DASHBOARD SECTION -->
  <div class="section" id="dashboard">
    <h2 class="mb-4">Dashboard Overview</h2>
    
    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
      <div class="col-md-3">
        <div class="stat-card success">
          <div class="d-flex align-items-center">
            <div class="icon me-3">
              <i class="bi bi-currency-dollar"></i>
            </div>
            <div>
              <small class="text-muted d-block">Pendapatan Hari Ini</small>
              <h4 class="mb-0 fw-bold">Rp1.250.000</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="stat-card primary">
          <div class="d-flex align-items-center">
            <div class="icon me-3">
              <i class="bi bi-cart-check"></i>
            </div>
            <div>
              <small class="text-muted d-block">Pesanan Hari Ini</small>
              <h4 class="mb-0 fw-bold">45</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="stat-card warning">
          <div class="d-flex align-items-center">
            <div class="icon me-3">
              <i class="bi bi-clock-history"></i>
            </div>
            <div>
              <small class="text-muted d-block">Pesanan Pending</small>
              <h4 class="mb-0 fw-bold">8</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="stat-card danger">
          <div class="d-flex align-items-center">
            <div class="icon me-3">
              <i class="bi bi-star-fill"></i>
            </div>
            <div>
              <small class="text-muted d-block">Menu Terlaris</small>
              <h4 class="mb-0 fw-bold" style="font-size: 1.25rem;">Krabby Patty</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-3 mb-4">
      <!-- Chart -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <i class="bi bi-graph-up-arrow me-2"></i>Grafik Penjualan Mingguan
          </div>
          <div class="card-body">
            <div class="chart-container">
              <canvas id="salesChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- Trending Menu -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <i class="bi bi-fire me-2 text-danger"></i>Trending Menu
          </div>
          <div class="card-body p-0">
            <div class="trending-item">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="d-flex align-items-center">
                  <span class="badge bg-warning me-2">1</span>
                  <div>
                    <h6 class="mb-0">Krabby Patty</h6>
                    <small class="text-muted">145 orders</small>
                  </div>
                </div>
                <div class="text-end">
                  <small class="text-success">+12%</small>
                  <div class="fw-bold">Rp1.74jt</div>
                </div>
              </div>
              <div class="progress" style="height: 6px;">
                <div class="progress-bar bg-warning" style="width: 85%"></div>
              </div>
            </div>
            <div class="trending-item">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="d-flex align-items-center">
                  <span class="badge bg-secondary me-2">2</span>
                  <div>
                    <h6 class="mb-0">Double Krabby</h6>
                    <small class="text-muted">98 orders</small>
                  </div>
                </div>
                <div class="text-end">
                  <small class="text-success">+8%</small>
                  <div class="fw-bold">Rp1.76jt</div>
                </div>
              </div>
              <div class="progress" style="height: 6px;">
                <div class="progress-bar bg-secondary" style="width: 72%"></div>
              </div>
            </div>
            <div class="trending-item">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="d-flex align-items-center">
                  <span class="badge bg-info me-2">3</span>
                  <div>
                    <h6 class="mb-0">Kelp Shake</h6>
                    <small class="text-muted">76 orders</small>
                  </div>
                </div>
                <div class="text-end">
                  <small class="text-success">+5%</small>
                  <div class="fw-bold">Rp760k</div>
                </div>
              </div>
              <div class="progress" style="height: 6px;">
                <div class="progress-bar bg-info" style="width: 58%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Orders -->
    <div class="card">
      <div class="card-header">
        <i class="bi bi-clock-history me-2"></i>Pesanan Terbaru
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Meja</th>
                <th>Items</th>
                <th>Total</th>
                <th>Status</th>
                <th>Waktu</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>#001</strong></td>
                <td><span class="badge bg-dark">Meja 5</span></td>
                <td>2x Krabby Patty</td>
                <td><strong>Rp34.000</strong></td>
                <td><span class="badge bg-info">Cooking</span></td>
                <td>10:45</td>
              </tr>
              <tr>
                <td><strong>#002</strong></td>
                <td><span class="badge bg-dark">Meja 3</span></td>
                <td>1x Double Krabby</td>
                <td><strong>Rp18.000</strong></td>
                <td><span class="badge bg-warning text-dark">Pending</span></td>
                <td>11:20</td>
              </tr>
              <tr>
                <td><strong>#003</strong></td>
                <td><span class="badge bg-dark">Meja 7</span></td>
                <td>3x Krabby Patty</td>
                <td><strong>Rp52.000</strong></td>
                <td><span class="badge bg-success">Ready</span></td>
                <td>11:35</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- ORDERS SECTION -->
<div class="section d-none" id="orders">
  <h2 class="mb-4">Kelola Pesanan</h2>

  <div class="card">
    <div class="card-body p-0">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Meja</th>
            <th>Customer</th>
            <th>Items</th>
            <th>Total</th>
            <th>Waktu</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>

        <?php
        
require 'koneksi.php';

$sql = "
  SELECT 
    kp.id_pesanan,
    kp.no_meja,
    kp.item,
    kp.status,
    kp.waktu,
    t.total_belanja,
    a.username
  FROM kelola_pesanan kp
  JOIN transaksi t ON kp.id_transaksi = t.id_transaksi
  JOIN akun a ON t.id_akun = a.id_akun
  ORDER BY kp.waktu DESC
";

$result = mysqli_query($conn, $sql);
?>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td>#<?= $row['id_pesanan'] ?></td>
            <td><?= $row['no_meja'] ?></td>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><?= htmlspecialchars($row['item']) ?></td>
            <td>Rp<?= number_format($row['total_belanja'],0,',','.') ?></td>
            <td><?= date('H:i', strtotime($row['waktu'])) ?></td>
            <td>
              <span class="badge bg-info"><?= $row['status'] ?></span>
            </td>
            <td>
              <form action="update_status.php" method="post">
                <input type="hidden" name="id_pesanan" value="<?= $row['id_pesanan'] ?>">
                <select name="status" onchange="this.form.submit()">
                  <option <?= $row['status']=='COOKING'?'selected':'' ?>>COOKING</option>
                  <option <?= $row['status']=='SERVED'?'selected':'' ?>>SERVED</option>
                </select>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>

        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- MENU SECTION -->
<div class="section d-none" id="menu">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Kelola Menu</h2>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#menuModal">
      <i class="bi bi-plus-circle me-2"></i>Tambah Menu
    </button>
  </div>

  <div class="row g-3">
    <?php
    require 'koneksi.php';
    $sql = "SELECT * FROM menu ORDER BY tipe, nama_menu";
    $result = mysqli_query($conn, $sql);

    while ($menu = mysqli_fetch_assoc($result)):
      switch ($menu['tipe']) {
        case 'MAIN_COURSE': $badge = 'bg-secondary'; $label='Main Course'; break;
        case 'APPETIZER':   $badge = 'bg-warning text-dark'; $label='Appetizer'; break;
        case 'DRINK':       $badge = 'bg-info'; $label='Drinks'; break;
        case 'DESSERT':     $badge = 'bg-success'; $label='Dessert'; break;
        default:            $badge = 'bg-secondary'; $label='-';
      }
    ?>
    <div class="col-md-3">
      <div class="card menu-card">
        <img src="https://picsum.photos/400/300?random=<?= $menu['id_menu'] ?>">
        <div class="card-body">
          <h5 class="card-title mb-2"><?= htmlspecialchars($menu['nama_menu']) ?></h5>
          <p class="text-primary fw-bold mb-2">
            Rp<?= number_format($menu['harga_menu'],0,',','.') ?>
          </p>
          <span class="badge <?= $badge ?> mb-3"><?= $label ?></span>

          <div class="d-flex gap-2">
            <!-- EDIT -->
            <button 
              class="btn btn-success btn-sm flex-fill"
              data-bs-toggle="modal"
              data-bs-target="#editMenu<?= $menu['id_menu'] ?>">
              <i class="bi bi-pencil"></i> Edit
            </button>

            <!-- DELETE -->
            <a 
              href="menu_delete.php?id=<?= $menu['id_menu'] ?>"
              onclick="return confirm('Hapus menu ini?')"
              class="btn btn-danger btn-sm flex-fill">
              <i class="bi bi-trash"></i> Hapus
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL EDIT -->
    <div class="modal fade" id="editMenu<?= $menu['id_menu'] ?>">
      <div class="modal-dialog">
        <form method="POST" action="menu_update.php" class="modal-content">
          <div class="modal-header">
            <h5>Edit Menu</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id_menu" value="<?= $menu['id_menu'] ?>">
            <input class="form-control mb-2" name="nama_menu" value="<?= $menu['nama_menu'] ?>" required>
            <input class="form-control mb-2" name="harga_menu" type="number" value="<?= $menu['harga_menu'] ?>" required>
            <select class="form-select" name="tipe">
              <option value="MAIN_COURSE">Main Course</option>
              <option value="APPETIZER">Appetizer</option>
              <option value="DRINK">Drinks</option>
              <option value="DESSERT">Dessert</option>
            </select>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>

    <?php endwhile; ?>
  </div>
</div>

  <!-- REPORTS SECTION -->
  <div class="section d-none" id="reports">
    <h2 class="mb-4">Laporan Penjualan</h2>

    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-file-earmark-bar-graph me-2"></i>Data Penjualan</span>
        <select class="form-select form-select-sm w-auto">
          <option value="daily">Harian</option>
          <option value="weekly">Mingguan</option>
          <option value="monthly">Bulanan</option>
        </select>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Total Pesanan</th>
                <th>Total Pendapatan</th>
                <th>Detail Pesanan</th>
                <th>Menu Terlaris</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>15 Des 2024</strong></td>
                <td><span class="badge bg-primary">45</span></td>
                <td><strong>Rp1.250.000</strong></td>
                <td><button class="btn btn-sm btn-info"><i class="bi bi-eye"></i> Lihat Detail</button></td>
                <td>Krabby Patty</td>
              </tr>
              <tr>
                <td><strong>14 Des 2024</strong></td>
                <td><span class="badge bg-primary">52</span></td>
                <td><strong>Rp1.480.000</strong></td>
                <td><button class="btn btn-sm btn-info"><i class="bi bi-eye"></i> Lihat Detail</button></td>
                <td>Double Krabby Patty</td>
              </tr>
              <tr>
                <td><strong>13 Des 2024</strong></td>
                <td><span class="badge bg-primary">38</span></td>
                <td><strong>Rp980.000</strong></td>
                <td><button class="btn btn-sm btn-info"><i class="bi bi-eye"></i> Lihat Detail</button></td>
                <td>Krabby Patty</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- CUSTOMERS SECTION -->
  <div class="section d-none" id="customers">
    <h2 class="mb-4">Data Customer</h2>

    <div class="card">
      <div class="card-header">
        <i class="bi bi-people-fill me-2"></i>Daftar Customer
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Status</th>
                <th>Pesanan</th>
                <th>Total Belanja</th>
                <th>Tanggal</th>
              </tr>
            </thead>
<?php
require 'koneksi.php';

$sql = "
SELECT 
  a.id_akun,
  a.username,
  a.email,
  a.status,
  a.is_premium,
  a.created_at,
  COALESCE(SUM(t.total_belanja),0) AS total_belanja
FROM akun a
LEFT JOIN transaksi t 
  ON a.id_akun = t.id_akun 
  AND t.status_transaksi = 'SELESAI'
WHERE a.status IN ('guest','customer')
GROUP BY a.id_akun
ORDER BY total_belanja DESC
";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)):

  // STATUS BADGE
  if ($row['status'] === 'guest') {
    $badge = '<span class="badge status-guest"><i class="bi bi-person me-1"></i>Guest</span>';
  } elseif ($row['is_premium'] == 1) {
    $badge = '<span class="badge status-membership"><i class="bi bi-star-fill me-1"></i>Membership</span>';
  } else {
    $badge = '<span class="badge status-member"><i class="bi bi-person-fill me-1"></i>Member Biasa</span>';
  }

  // INISIAL AVATAR
  $inisial = strtoupper(substr($row['username'],0,2));
?>

<tr>
  <td><strong>C<?= str_pad($row['id_akun'], 3, '0', STR_PAD_LEFT) ?></strong></td>

  <td>
    <div class="d-flex align-items-center">
      <div class="user-avatar me-2" style="background: linear-gradient(135deg,#3498db,#2980b9);">
        <?= $inisial ?>
      </div>
      <?= htmlspecialchars($row['username']) ?>
    </div>
  </td>

  <td><?= $row['email'] ?: '-' ?></td>
  <td>-</td>

  <td><?= $badge ?></td>

  <td>
    <?php
    $qItem = "
      SELECT m.nama_menu, SUM(d.jumlah) qty
      FROM detail_transaksi d
      JOIN transaksi t ON d.id_transaksi = t.id_transaksi
      JOIN menu m ON d.id_menu = m.id_menu
      WHERE t.id_akun = {$row['id_akun']}
        AND t.status_transaksi = 'SELESAI'
      GROUP BY m.nama_menu
      LIMIT 3
    ";
    $items = mysqli_query($conn, $qItem);

    if (mysqli_num_rows($items) == 0) {
      echo '<small class="text-muted">Belum ada pesanan</small>';
    } else {
      while ($i = mysqli_fetch_assoc($items)) {
        echo '<small class="d-block">'
            . htmlspecialchars($i['nama_menu'])
            . ' (' . $i['qty'] . 'x)</small>';
      }
    }
    ?>
  </td>

  <td><strong>Rp<?= number_format($row['total_belanja'],0,',','.') ?></strong></td>
  <td><?= date('d M Y', strtotime($row['created_at'])) ?></td>
</tr>

<?php endwhile; ?>

          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- ANALYTICS SECTION -->
  <div class="section d-none" id="analytics">
    <h2 class="mb-4">Analytics</h2>

    <div class="row g-3 mb-4">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <i class="bi bi-bar-chart-line me-2"></i>Customer Map & Revenue
          </div>
          <div class="card-body">
            <div class="chart-container">
              <canvas id="revenueChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <i class="bi bi-pie-chart me-2"></i>Category Sales
          </div>
          <div class="card-body">
            <canvas id="categoryChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-3">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <i class="bi bi-trophy me-2"></i>Best Seller Menus
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Rank</th>
                    <th>Menu</th>
                    <th>Sold</th>
                    <th>Revenue</th>
                    <th>Growth</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><span class="badge bg-warning text-dark">1</span></td>
                    <td><strong>Krabby Patty</strong></td>
                    <td>145</td>
                    <td><strong>Rp1.740.000</strong></td>
                    <td><span class="badge bg-success">+12%</span></td>
                  </tr>
                  <tr>
                    <td><span class="badge bg-secondary">2</span></td>
                    <td><strong>Double Krabby Patty</strong></td>
                    <td>98</td>
                    <td><strong>Rp1.764.000</strong></td>
                    <td><span class="badge bg-success">+8%</span></td>
                  </tr>
                  <tr>
                    <td><span class="badge bg-secondary">3</span></td>
                    <td><strong>Kelp Shake</strong></td>
                    <td>76</td>
                    <td><strong>Rp760.000</strong></td>
                    <td><span class="badge bg-success">+5%</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <i class="bi bi-star-fill me-2"></i>Loyal Customers
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Customer</th>
                    <th>Orders</th>
                    <th>Total Spent</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="user-avatar me-2" style="background: linear-gradient(135deg, #667eea, #764ba2);">SB</div>
                        <strong>SpongeBob</strong>
                      </div>
                    </td>
                    <td>28</td>
                    <td><strong>Rp856.000</strong></td>
                    <td><span class="badge status-membership">Membership</span></td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="user-avatar me-2" style="background: linear-gradient(135deg, #f39c12, #e67e22);">SC</div>
                        <strong>Sandy</strong>
                      </div>
                    </td>
                    <td>32</td>
                    <td><strong>Rp1.120.000</strong></td>
                    <td><span class="badge status-membership">Membership</span></td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="user-avatar me-2" style="background: linear-gradient(135deg, #2ecc71, #27ae60);">PS</div>
                        <strong>Patrick</strong>
                      </div>
                    </td>
                    <td>15</td>
                    <td><strong>Rp420.000</strong></td>
                    <td><span class="badge status-member">Member</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<!-- Menu Modal -->
<div class="modal fade" id="menuModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="menu_insert.php" class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Tambah Menu Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nama Menu</label>
          <input type="text" name="nama_menu" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Kategori</label>
          <select name="tipe" class="form-select" required>
            <option value="">Pilih Kategori</option>
            <option value="MAIN_COURSE">Main Course</option>
            <option value="APPETIZER">Appetizer</option>
            <option value="DRINK">Drinks</option>
            <option value="DESSERT">Dessert</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Harga</label>
          <input type="number" name="harga_menu" class="form-control" required>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Batal
        </button>
        <button type="submit" class="btn btn-success">
          <i class="bi bi-save"></i> Simpan
        </button>
      </div>

    </form>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Sidebar Navigation
  document.querySelectorAll('.sidebar .nav-link').forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      
      document.querySelectorAll('.sidebar .nav-link').forEach(l => l.classList.remove('active'));
      link.classList.add('active');
      
      document.querySelectorAll('.section').forEach(section => section.classList.add('d-none'));
      
      const sectionId = link.dataset.section;
      document.getElementById(sectionId).classList.remove('d-none');
    });
  });

  // Sales Chart
  const ctx = document.getElementById('salesChart');
  if (ctx) {
    new Chart(ctx.getContext('2d'), {
      type: 'line',
      data: {
        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        datasets: [{
          label: 'Pendapatan (Rp)',
          data: [1200000, 1500000, 980000, 1750000, 2100000, 2400000, 1800000],
          borderColor: '#3498db',
          backgroundColor: 'rgba(52, 152, 219, 0.1)',
          tension: 0.4,
          fill: true,
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: true }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function(value) {
                return 'Rp' + value.toLocaleString('id-ID');
              }
            }
          }
        }
      }
    });
  }

  // Revenue Chart
  const ctxRevenue = document.getElementById('revenueChart');
  if (ctxRevenue) {
    new Chart(ctxRevenue.getContext('2d'), {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [{
          label: 'Revenue',
          data: [30000000, 35000000, 32000000, 40000000, 38000000, 42000000],
          backgroundColor: 'rgba(52, 152, 219, 0.8)',
          borderColor: '#3498db',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
  }

  // Category Chart
  const ctxCategory = document.getElementById('categoryChart');
  if (ctxCategory) {
    new Chart(ctxCategory.getContext('2d'), {
      type: 'doughnut',
      data: {
        labels: ['Main Course', 'Appetizer', 'Drinks', 'Dessert'],
        datasets: [{
          data: [45, 20, 25, 10],
          backgroundColor: ['#3498db', '#f39c12', '#2ecc71', '#e74c3c']
        }]
      },
      options: {
        responsive: true
      }
    });
  }

  // Logout
  document.getElementById('logoutBtn').addEventListener('click', () => {
    if (confirm('Yakin ingin logout?')) {
      alert('Logout berhasil!');
      
      // Redirect to login page or perform logout action
      window.location.href = 'logout.php';
    }
  });
</script>

</body>
</html>