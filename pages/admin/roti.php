<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';
$ambilroti = "SELECT roti.*, jenis_roti.nama_jenis FROM roti
                LEFT JOIN jenis_roti ON roti.id_jenis = jenis_roti.id_jenis
                ORDER BY roti.id_roti DESC";
$roti = mysqli_query($conn, $ambilroti);
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
      <img src="../../assets/images/logo.png" alt="">
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
      <a href="jenis.php">List Jenis Roti</a>
      <a href="tambahroti.php">+ Tambah Roti</a>
    </header>

    <section class="cards">
      <div class="card">
        <table>
          <tr>
            <th>No</th>
            <th>Nama Roti</th>
            <th>Jenis Roti</th>
            <th>Foto</th>
            <th>Action</th>
          </tr>
          <?php 
          $no = 1;
          if(mysqli_num_rows($roti) > 0){
            while($row = mysqli_fetch_assoc($roti)){ 
          ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_roti']; ?></td>
            <td><?= $row['nama_jenis']; ?></td>
            <td>
              <img src="../../uploads/<?= $row['foto_roti']; ?>" alt="" width="80">
            </td>
            <td><a href="editroti.php?id=<?= $row['id_roti'] ?>">Edit</a> |
            <a href="hapusroti.php?id=<?php echo $row['id_roti'] ?>" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</a></td>
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