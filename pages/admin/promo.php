<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';
$ambilpromo = "SELECT * FROM promo ORDER BY id_promo DESC";
$promo = mysqli_query($conn, $ambilpromo);
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
      <a href="tambahpromo.php">+ Tambah Promo</a>
    </header>
    <section class="cards">
      <div class="card">
        <table>
          <tr>
            <th>No</th>
            <th>Video Promo</th>
            <th>Action</th>
          </tr>
          <?php 
          $no = 1;
          if(mysqli_num_rows($promo) > 0){
            while($row = mysqli_fetch_assoc($promo)){ 
          ?>
          <tr>
            <td><?= $no++; ?></td>
            <td>
              <video width="120" autoplay loop muted>
    <source src="../../uploads/video/<?= htmlspecialchars($row['video_promo']); ?>" type="video/mp4">
</video>
            </td>
            <td><a href="editpromo.php?id=<?= $row['id_promo'] ?>">Edit</a> |
            <a href="hapuspromo.php?id=<?php echo $row['id_promo'] ?>" onclick="return confirm('Yakin ingin menghapus promo ini?')">Hapus</a></td>
          </tr>
          <?php
            }
          } ?>
        </table>
      </div>
    </section>
  </div>

</body>
</html>