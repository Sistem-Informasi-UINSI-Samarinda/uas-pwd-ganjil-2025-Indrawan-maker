<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';

$jenis = "SELECT * FROM jenis_roti";
$tampilkanjenis = mysqli_query($conn, $jenis);

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
      <a href="tambahjenis.php">+ Tambah Jenis Roti</a>
      <a href="roti.php"><- Kembali</a>
    </header>

    <section class="cards">
        <div class="card">
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama Jenis</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $no = 1;
                while($row = mysqli_fetch_assoc($tampilkanjenis)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['nama_jenis'] ?></td>
                    <td><?php echo $row['created_at'] ?></td>
                    <td>
                        <a href="editjenis.php?id=<?= $row['id_jenis'] ?>">Edit</a> |
                        <a href="hapusjenis.php?id=<?php echo $row['id_jenis'] ?>" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</a>
                    </td>
                </tr>

                <?php } ?>
            </table>
        </div>
    </section>
  </div>

</body>
</html>