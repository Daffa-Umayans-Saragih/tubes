<?php
require 'koneksi.php';

// Daftar kategori berurutan
$categories = [
  'MAIN_COURSE' => 'Main Course',
  'APPETIZER'   => 'Appetizer',
  'DRINK'       => 'Drinks',
  'DESSERT'     => 'Dessert'
];

foreach ($categories as $tipe => $label):

  $sql = "
    SELECT id_menu, nama_menu, harga_menu
    FROM menu
    WHERE is_aktif = 1 AND tipe = '$tipe'
    ORDER BY nama_menu
  ";

  $result = mysqli_query($conn, $sql);
  if (!$result || mysqli_num_rows($result) === 0) continue;

  // Badge class
  switch ($tipe) {
    case 'MAIN_COURSE': $badgeClass = 'bg-secondary'; break;
    case 'APPETIZER':   $badgeClass = 'bg-warning text-dark'; break;
    case 'DRINK':       $badgeClass = 'bg-info'; break;
    case 'DESSERT':     $badgeClass = 'bg-success'; break;
    default:            $badgeClass = 'bg-secondary';
  }
?>

<!-- ======================
     MENU SECTION
====================== -->
<section class="menu-section" data-tipe="<?= $tipe ?>">
  
  <div class="menu-container">
    <?php while ($menu = mysqli_fetch_assoc($result)): ?>
      <div class="menu-card menu-item" data-tipe="<?= $tipe ?>">

        <img
          loading="lazy"
          src="https://picsum.photos/400/300?random=<?= $menu['id_menu'] ?>"
          alt="<?= htmlspecialchars($menu['nama_menu']) ?>"
        >

        <h3 class="menu-title">
          <?= htmlspecialchars($menu['nama_menu']) ?>
        </h3>

        <p class="menu-price">
          Rp<?= number_format($menu['harga_menu'], 0, ',', '.') ?>
        </p>

        <span class="badge <?= $badgeClass ?> mb-2 d-inline-block">
          <?= $label ?>
        </span>

        <button
          class="add-btn"
          onclick="openOrder(
            '<?= htmlspecialchars($menu['nama_menu'], ENT_QUOTES) ?>',
            <?= (int)$menu['harga_menu'] ?>
          )"
        >
          Add
        </button>

      </div>
    <?php endwhile; ?>
  </div>
</section>

<?php endforeach; ?>
