<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE FROM kegiatan WHERE id_kegiatan = '$id'";

    // jika berhasil hapus
    if(mysqli_query($conn, $query)){
        header("Location: kegiatan.php");
        exit();
    }
    // jika gagal hapus
    else{
        header("Location: kegiatan.php");
        exit();
    }
} else{
    // Jika id kategori tidak ditemukan
    header("Location: kegiatan.php");
        exit();
}

?>