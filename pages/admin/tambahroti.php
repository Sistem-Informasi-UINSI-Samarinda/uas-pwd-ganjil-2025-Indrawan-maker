<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';
$tes = "SELECT * FROM jenis_roti";
$jenis = mysqli_query($conn, $tes);

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
      <h2>Rotiku Admin</h2>
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
        <a href="jenis.php">List Kategori</a>
        <a href="tambahroti.php">+ Tambah Roti</a>
    </header>

    <section class="cards">
        <div class="card">
            <form class="form-tambah" action="" method="POST" enctype="multipart/form-data">
                <div class="group">
                    <input class="input-tambah" type="text" name="nama_roti" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-tambah" for="">Nama Roti</label>
                </div>


                <div class="group">
                    <select class="input-tambah" name="id_jenis" required>
                        <?php while($row = mysqli_fetch_assoc($jenis)) {
                            ?>
                        <option value="<?= $row['id_jenis'] ?>"><?php echo $row['nama_jenis'] ?></option>
                        <?php } ?>
                    </select>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-tambah" for="" style="text-align: center;">Jenis Roti</label>
                </div>
                <div class="group">
                    <input class="input-tambah" type="date" name="tanggal_produksi">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-tambah" for="">Tanggal Produksi</label> 
                </div>


                <div class="group">
                    <textarea class="input-tambah" name="deskripsi_roti" rows="8" cols="70"></textarea>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-tambah" for="">Deskripsi Roti</label> 
                </div>


                <div class="group">
                    <input class="input-tambah" type="file" name="foto_roti">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-tambah" for="">Gambar Roti</label>
                </div>


                <div class="container-btn-submit">
                    <button class="btn-submit" type="submit" name="simpan">Simpan</button>
                </div>
            </form>
        </div>
    </section>
  </div>

<?php 
    if(isset($_POST['simpan'])){
        $id_jenis = $_POST['id_jenis'];
        $nama_roti = $_POST['nama_roti'];
        $deskripsi_roti = $_POST['deskripsi_roti'];
        $tanggal_produksi = $_POST['tanggal_produksi'];

        // Upload File
        $gambar = $_FILES['foto_roti']['name'];
        $tmp = $_FILES['foto_roti']['tmp_name'];
        $folder = '../../uploads/';

        // agar nama file unique
        $foto_roti = uniqid() .  "_" . $gambar;

        // opsional
        if($_FILES['foto_roti']['error'] !== UPLOAD_ERR_OK){
            echo "ERROR UPLOAD GAMBAR, KODE: ". $_FILES['foto_roti']['error'];
        }
        // eksekusi Upload
        move_uploaded_file($tmp, $folder . $foto_roti);

        $query = "
        INSERT INTO roti (id_jenis, nama_roti, deskripsi_roti, foto_roti, tanggal_produksi)
        VALUES ('$id_jenis', '$nama_roti', '$deskripsi_roti', '$foto_roti', '$tanggal_produksi')
        ";

        if(mysqli_query($conn, $query)){
            echo "<script>
                alert('roti Telah di unggah');
                window.location.href='roti.php';
            </script>";
        }
        else{
             echo "<script>
                alert('roti Gagal di unggah');
                window.location.href='roti.php';
            </script>";
        }
    }
?>

</body>
</html>
