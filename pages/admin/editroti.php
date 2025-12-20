<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';
$tes = "SELECT * FROM jenis_roti";
$jenis = mysqli_query($conn, $tes);

if(isset($_GET['id'])){
    $id_roti = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM roti WHERE id_roti = '$id_roti'");
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>
            alert('Data roti tidak ditemukan!');
            window.location.href='roti.php';
        </script>";
        exit();
    }
} else {
    echo "<script>
        alert('ID roti tidak ditemukan!');
        window.location.href='roti.php';
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
    <section class="cards">
                    <form  class="form-tambah" action="" method="POST" enctype="multipart/form-data">

                    <div class="group">
                        <input class="input-tambah" type="text" name="nama_roti" value="<?php echo $data['nama_roti'] ?>" placeholder="isikan nama roti" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                    <label class="label-tambah" for="">Nama Roti</label>

                    </div>


                <div class="group">
                    <select class="input-tambah" name="id_jenis" required>
                        <?php while($row = mysqli_fetch_assoc($jenis)) {
                            ?>
                        <option value="<?= $row['id_jenis'] ?>" <?= $row['id_jenis'] == $data['id_jenis'] ? 'selected' : '' ?>><?= $row['nama_jenis'] ?></option>
                        <?php } ?>
                    </select>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-tambah" for="">Jenis Roti</label> 
                </div>

                <div class="group">
                    <input class="input-tambah" type="date" name="tanggal_produksi" value="<?php echo $data['tanggal_produksi'] ?>">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-tambah" for="">Tanggal Produksi</label> 
                </div>


                                <div class="group">
                                    <textarea class="input-tambah" name="deskripsi_roti" rows="15" cols="70"><?php echo $data['deskripsi_roti'] ?></textarea>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-tambah" for="">Deskripsi Roti</label> 
                </div>


                                <div class="group">
                                    <input class="input-tambah" type="file" name="foto_roti" >
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-tambah" for="">Gambar Roti</label>
                </div>

                <div class="container-btn-submit">
                    <button class="btn-submit" type="submit" name="simpan">Simpan</button>
                </div>
            </form>
    </section>
  </div>
<?php 

if(isset($_POST['simpan'])){
        $id_jenis = $_POST['id_jenis'];
        $nama_roti = $_POST['nama_roti'];
        $deskripsi_roti = $_POST['deskripsi_roti'];
        $tanggal_produksi = $_POST['tanggal_produksi'];

         if($_FILES['foto_roti']['name'] != ""){
        $gambar = $_FILES['foto_roti']['name'];
        $tmp = $_FILES['foto_roti']['tmp_name'];
        $folder = '../../uploads/';
        $foto_roti = uniqid() . "_" . $gambar;

        move_uploaded_file($tmp, $folder . $foto_roti);

        // Update dengan foto baru
        $query = "
            UPDATE roti 
            SET id_jenis = '$id_jenis',
                nama_roti = '$nama_roti',
                deskripsi_roti = '$deskripsi_roti',
                tanggal_produksi = '$tanggal_produksi',
                foto_roti = '$foto_roti'
            WHERE id_roti = '$id_roti'
        ";
    } else {
            $query = "
            UPDATE roti 
            SET id_jenis = '$id_jenis',
                nama_roti = '$nama_roti',
                deskripsi_roti = '$deskripsi_roti',
                tanggal_produksi = '$tanggal_produksi'
            WHERE id_roti = '$id_roti'
        ";
    }

    if(mysqli_query($conn, $query)){
        header("Location: roti.php");
        exit();
    }
    else{
        echo "Gagal menambahkan data: ". mysqli_error($conn);
    }
}
?>

</body>
</html>