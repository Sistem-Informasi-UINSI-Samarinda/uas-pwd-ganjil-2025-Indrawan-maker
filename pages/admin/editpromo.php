<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';
if(isset($_GET['id'])){
    $id_promo = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM promo WHERE id_promo = '$id_promo'");
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
                                    <input class="input-tambah" type="file" name="video_promo" >
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-tambah" for="">Video Promo</label>
                </div>

                <div class="container-btn-submit">
                    <button class="btn-submit" type="submit" name="simpan">Simpan</button>
                </div>
            </form>
    </section>
  </div>
<?php 

if(isset($_POST['simpan'])){
        $video = $_FILES['video_promo']['name'];
        $tmp = $_FILES['video_promo']['tmp_name'];
        $folder = '../../uploads/video/';

 // agar nama file unique
        $video_promo = uniqid() .  "_" . $video;

        // opsional
        if($_FILES['video_promo']['error'] !== UPLOAD_ERR_OK){
            echo "ERROR UPLOAD VIDEO, KODE: ". $_FILES['video_promo']['error'];
        }
        // eksekusi Upload
        move_uploaded_file($tmp, $folder . $video_promo);

        // Update dengan video baru
        $query = "
            UPDATE promo 
            SET video_promo = '$video_promo'
            WHERE id_promo = '$id_promo'
        ";

    if(mysqli_query($conn, $query)){
        header("Location: promo.php");
        exit();
    }
    else{
        echo "Gagal menambahkan data: ". mysqli_error($conn);
    }
}
?>

</body>
</html>