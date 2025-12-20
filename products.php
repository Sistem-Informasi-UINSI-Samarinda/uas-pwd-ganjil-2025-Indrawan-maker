<?php include 'includes/meta.php'; ?>
<?php include 'includes/header.php'; ?>

<?php 
include 'config/koneksi.php';

$id_jenis = isset($_GET['jenis']) ? $_GET['jenis'] : '';

if ($id_jenis) {
    $tes = "SELECT * FROM roti WHERE id_jenis = '$id_jenis' ORDER BY id_roti ASC";
} else {
    $tes = "SELECT * FROM roti ORDER BY id_roti DESC";
}
$roti = mysqli_query($conn, $tes);

$ambil = "SELECT * FROM jenis_roti";
$jenis = mysqli_query($conn, $ambil);
?>

<main class="produk">
    <div class="title-produk">

        <h2>Spesial Produk</h2>
        <div class="selectdiv">
            <select onchange="location.href='?jenis='+this.value">
                <option value="" selected>Semua</option>
                <?php while($j = mysqli_fetch_assoc($jenis)) { ?>
                    <option value="<?= $j['id_jenis'] ?>" <?= $id_jenis == $j['id_jenis'] ? 'selected' : '' ?>>
                        <?= $j['nama_jenis'] ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
        </div>
    <div>
 
    </div>
    <section class="product-container">
        
        <div class="card-product-container">
            <?php while($r = mysqli_fetch_assoc($roti)) { ?>
                <div class="card-product">
                    <img src="uploads/<?= $r["foto_roti"] ?>" alt="">
                    <div>
                        <h4><?= $r["nama_roti"] ?></h4>
                        <p class="text-roti"><?= $r["deskripsi_roti"] ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>