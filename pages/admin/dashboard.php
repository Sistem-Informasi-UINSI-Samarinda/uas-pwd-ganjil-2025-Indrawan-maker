<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../../config/koneksi.php';
?>

<?php
// Total Produk (roti)
$qProduk   = mysqli_query($conn, "SELECT COUNT(*) AS total FROM roti");
$totalProduk = mysqli_fetch_assoc($qProduk)['total'];

// Total Kategori (jenis roti)
$qKategori = mysqli_query($conn, "SELECT COUNT(*) AS total FROM jenis_roti");
$totalKategori = mysqli_fetch_assoc($qKategori)['total'];

// Total Promo
$qPromo    = mysqli_query($conn, "SELECT COUNT(*) AS total FROM promo");
$totalPromo = mysqli_fetch_assoc($qPromo)['total'];

// Total Kegiatan
$qKegiatan = mysqli_query($conn, "SELECT COUNT(*) AS total FROM kegiatan");
$totalKegiatan = mysqli_fetch_assoc($qKegiatan)['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="../../assets/css/adminStyles.css">
</head>
<body>

  <div class="sidebar">
    <div>
      <img src="../../assets/images/logo.png" alt="" class="logo-sidebar">
      <h2>Admin Panel</h2>
    </div>
    <ul>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="roti.php">Menu Utama</a></li>
      <li><a href="promo.php">Promo</a></li>
      <li><a href="kegiatan.php">Kegiatan</a></li>
      <li><a href="logout.php" class="logout">Logout</a></li>
    </ul>
  </div>

  <div class="main-content">
    <header>
      <h1>Selamat Datang, <?php echo $_SESSION['nama_lengkap']; ?>!</h1>
      <p>Anda sedang berada di halaman dashboard utama.</p>
      <!-- <button>☰ Menu</button> -->
    </header>

    <section class="cards">
      <div class="card">
    <h3>Total Produk</h3>
    <p><?= $totalProduk; ?></p>
  </div>

  <div class="card">
    <h3>Total Kategori</h3>
    <p><?= $totalKategori; ?></p>
  </div>

  <div class="card">
    <h3>Total Promo</h3>
    <p><?= $totalPromo; ?></p>
  </div>

  <div class="card">
    <h3>Total Kegiatan</h3>
    <p><?= $totalKegiatan; ?></p>
  </div>
    </section>
  </div>

</body>
</html>