<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';

if(isset($_GET['id'])){
    $id_jenis = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM jenis_roti WHERE id_jenis = '$id_jenis'");
    $data = mysqli_fetch_assoc($result);
} else {
    echo "<script>
    alert('ID Kategori tidak ditemukan'); 
    window.location.href='jenis.php';
    </script>";
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
                            <input class="input-tambah" type="text" name="nama_jenis" value="<?php echo $data['nama_jenis'] ?>">
                    <span class="highlight"></span>
                    <span class="highlight"></span>
                    <label class="label-tambah" for="">Jenis Roti</label>
                </div>
                           <div class="container-btn-submit">
                    <button class="btn-submit" type="submit" name="simpan">Simpan</button>
                </div>
        </form>
     
    </section>
  </div>
<?php 

if(isset($_POST['simpan'])){
    $nama_jenis = $_POST['nama_jenis'];

    $query = "
            UPDATE jenis_roti 
            SET nama_jenis = '$nama_jenis'
            WHERE id_jenis = '$id_jenis'
            ";

    if(mysqli_query($conn, $query)){
        header("Location: jenis.php");
        exit();
    }
    else{
        echo "Gagal menambahkan data: ". mysqli_error($conn);
    }
}
?>

</body>
</html>