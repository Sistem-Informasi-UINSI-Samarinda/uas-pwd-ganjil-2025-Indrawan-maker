<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';
$ambilkegiatan = "SELECT * FROM kegiatan ORDER BY id_kegiatan DESC";
$kegiatan = mysqli_query($conn, $ambilkegiatan);
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
      <a href="tambahkegiatan.php">+ Tambah Kegiatan</a>
    </header>
    <section class="cards">
      <div class="card">
        <table>
          <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Foto</th>
            <th>Action</th>
          </tr>
          <?php 
          $no = 1;
          if(mysqli_num_rows($kegiatan) > 0){
            while($row = mysqli_fetch_assoc($kegiatan)){ 
          ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['judul_kegiatan']; ?></td>
            <td>
              <img src="../../uploads/gambar_kegiatan/<?= $row['foto_kegiatan']; ?>" alt="" width="80">
            </td>
            <td><a href="editkegiatan.php?id=<?= $row['id_kegiatan'] ?>">Edit</a> |
            <a href="hapuskegiatan.php?id=<?php echo $row['id_kegiatan'] ?>" onclick="return confirm('Yakin ingin menghapus kegiatan ini?')">Hapus</a></td>
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