<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';
if(isset($_GET['id'])){
    $id_kegiatan = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id_kegiatan = '$id_kegiatan'");
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>
            alert('Data kegiatan tidak ditemukan!');
            window.location.href='kegiatan.php';
        </script>";
        exit();
    }
} else {
    echo "<script>
        alert('ID kegiatan tidak ditemukan!');
        window.location.href='kegiatan.php';
    </script>";
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
                    <form  class="form-tambah" action="" method="POST" enctype="multipart/form-data">

                    <div class="group">
                        <input class="input-tambah" type="text" name="judul_kegiatan" value="<?php echo $data['judul_kegiatan'] ?>" placeholder="isikan judul kegiatan" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                    <label class="label-tambah" for="">Nama Kegiatan</label>
                    </div>


                                <div class="group">
                                    <textarea class="input-tambah" name="isi_kegiatan" rows="15" cols="70"><?php echo $data['isi_kegiatan'] ?></textarea>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-tambah" for="">Isi Kegiatan</label> 
                </div>


                                <div class="group">
                                    <input class="input-tambah" type="file" name="foto_kegiatan" >
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-tambah" for="">Gambar Kegiatan</label>
                </div>

                <div class="container-btn-submit">
                    <button class="btn-submit" type="submit" name="simpan">Simpan</button>
                </div>
            </form>
    </section>
  </div>
<?php 

if(isset($_POST['simpan'])){
        $judul_kegiatan = $_POST['judul_kegiatan'];
        $isi_kegiatan = $_POST['isi_kegiatan'];

         if($_FILES['foto_kegiatan']['name'] != ""){
        $gambar = $_FILES['foto_kegiatan']['name'];
        $tmp = $_FILES['foto_kegiatan']['tmp_name'];
        $folder = '../../uploads/gambar_kegiatan/';
        $foto_kegiatan = uniqid() . "_" . $gambar;

        move_uploaded_file($tmp, $folder . $foto_kegiatan);

        // Update dengan foto baru
        $query = "
            UPDATE kegiatan 
            SET judul_kegiatan = '$judul_kegiatan',
                 isi_kegiatan = '$isi_kegiatan',
                foto_kegiatan = '$foto_kegiatan'
            WHERE id_kegiatan = '$id_kegiatan'
        ";
    } else {
            $query = "
            UPDATE kegiatan 
            SET judul_kegiatan = '$judul_kegiatan',
                 isi_kegiatan = '$isi_kegiatan'
            WHERE id_kegiatan = '$id_kegiatan'
        ";
    }

    if(mysqli_query($conn, $query)){
        header("Location: kegiatan.php");
        exit();
    }
    else{
        echo "Gagal menambahkan data: ". mysqli_error($conn);
    }
}
?>

</body>
</html>