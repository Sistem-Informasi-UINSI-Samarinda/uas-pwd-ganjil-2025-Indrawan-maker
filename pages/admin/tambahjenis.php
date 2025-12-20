<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


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
    <section class="cards">
        <form  class="form-tambah" action="" method="post">
          <div class="group">
            <input class="input-tambah" type="text" name="nama_jenis">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label class="label-tambah" for="">Nama Jenis Roti</label>
          </div>


                            <div class="container-btn-submit">
                    <button class="btn-submit" type="submit" name="simpan">Simpan</button>
                </div>
        </form>
     
    </section>
  </div>
<?php 
include '../../config/koneksi.php';

if(isset($_POST['simpan'])){
    $nama_jenis = $_POST['nama_jenis'];
    $created_at = date("Y-m-d H:i:s");

    $query = "
            INSERT INTO jenis_roti 
            (nama_jenis, created_at) VALUES
            ('$nama_jenis','$created_at')
            ";

    if(mysqli_query($conn, $query)){
        echo "<script>
                alert('Kategori Telah di unggah');
                window.location.href='jenis.php';
            </script>";
    }
    else{
        echo "Gagal menambahkan data: ". mysqli_error($conn);
    }
}
?>

</body>
</html>
