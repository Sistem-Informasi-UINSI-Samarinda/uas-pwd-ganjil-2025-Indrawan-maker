<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';
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
            <form  class="form-tambah" action="" method="POST" enctype="multipart/form-data">
                        <div class="group">
                    <input class="input-tambah" type="text" name="judul_kegiatan" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-tambah" for="">Nama Kegiatan</label>
                </div>

                <div class="group">
                    <textarea class="input-tambah" name="isi_kegiatan" rows="8" cols="70"></textarea>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-tambah" for="">Isi Kegiatan</label> 
                </div>


                <div class="group">
                    <input class="input-tambah" type="file" name="foto_kegiatan">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-tambah" for="">Gambar Kegiatan</label>
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
        $judul_kegiatan = $_POST['judul_kegiatan'];
        $isi_kegiatan = $_POST['isi_kegiatan'];

        // Upload File
        $gambar = $_FILES['foto_kegiatan']['name'];
        $tmp = $_FILES['foto_kegiatan']['tmp_name'];
        $folder = '../../uploads/gambar_kegiatan/';

        // agar nama file unique
        $foto_kegiatan = uniqid() .  "_" . $gambar;

        // opsional
        if($_FILES['foto_kegiatan']['error'] !== UPLOAD_ERR_OK){
            echo "ERROR UPLOAD GAMBAR, KODE: ". $_FILES['foto_kegiatan']['error'];
        }
        // eksekusi Upload
        move_uploaded_file($tmp, $folder . $foto_kegiatan);

        $query = "
        INSERT INTO kegiatan (judul_kegiatan, isi_kegiatan, foto_kegiatan)
        VALUES ('$judul_kegiatan', '$isi_kegiatan', '$foto_kegiatan')
        ";

        if(mysqli_query($conn, $query)){
            echo "<script>
                alert('Kegiatan Telah di unggah');
                window.location.href='kegiatan.php';
            </script>";
        }
        else{
             echo "<script>
                alert('Kegiatan Gagal di unggah');
                window.location.href='kegiatan.php';
            </script>";
        }
    }
?>

</body>
</html>
