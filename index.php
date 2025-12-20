<?php include 'includes/meta.php'; ?>
<?php include 'includes/header.php'; ?>

<?php 

include 'config/koneksi.php';


$query = "SELECT * FROM kegiatan ORDER BY id_kegiatan ASC LIMIT 10";
$result = mysqli_query($conn, $query);
$kegiatan_list = mysqli_fetch_all($result, MYSQLI_ASSOC);
$total_kegiatan = count($kegiatan_list);

$query_promo = "SELECT * FROM promo ORDER BY id_promo DESC";
$result_promo = mysqli_query($conn, $query_promo);
$promo_list = mysqli_fetch_all($result_promo, MYSQLI_ASSOC);

?>
<main>
        <div class="hero-container">
            <section class="hero">
                <p class="above-hero-text">Tempat terbaik untuk menemukan berbagai jenis roti</p>
                <h1 class="hero-main-text">Temukan berbagai produk roti terbaik di sini</h1>
                <p class="under-hero-text">Temukan kehangatan dalam setiap aroma roti yang baru keluar dari oven.
                        Bergabunglah bersama komunitas kami dan rasakan kebersamaan yang tumbuh dari setiap gigitan.</p>
                        <a href="products.php">
                            <button class="btn">CARI ROTI</button>
                        </a>
            </section>
            <section class="hero-container-image">
                <img class="hero-img"
                src="./assets/images/hero.png" alt="roti ku">
            </section>
        </div>
        <hr>
        <section class="promo-container">
            <div class="promo-second-container">
                <h2 style="font-size: 32px; font-weight: 400; color: #664D42;">  Promo  </h2>
                <?php foreach ($promo_list as $promo): ?>
                <video autoplay muted loop>
                    <source src="./uploads/video/<?php echo htmlspecialchars($promo['video_promo']); ?>" type="video/mp4">
                </video>
            <?php endforeach; ?>
            </div>
        </section>
 <!-- Slideshow container -->
<h2 style="font-size: 32px; font-weight: 400; text-align: center; color: #664D42;">Kegiatan Kami</h2>

<div class="slideshow-container">
    <?php if ($total_kegiatan > 0): ?>
        <?php foreach ($kegiatan_list as $index => $kegiatan): ?>
            <!-- Slide <?php echo $index + 1; ?> -->
            <div class="mySlides">
                <div class="slide-image">
                    <div class="numbertext"><?php echo $index + 1; ?> / <?php echo $total_kegiatan; ?></div>
                    <img src="./uploads/gambar_kegiatan/<?php echo htmlspecialchars($kegiatan['foto_kegiatan']); ?>" 
                         alt="<?php echo htmlspecialchars($kegiatan['judul_kegiatan']); ?>">
                </div>
                <div class="slide-text">
                    <h2><?php echo htmlspecialchars($kegiatan['judul_kegiatan']); ?></h2>
                    <p><?php echo nl2br(htmlspecialchars($kegiatan['isi_kegiatan'])); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- Jika belum ada data di database -->
        <div class="mySlides">
            <div class="slide-text" style="text-align: center; padding: 50px;">
                <h2>Belum ada kegiatan</h2>
                <p>Silakan tambahkan kegiatan melalui halaman admin.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Dots -->
<div class="dots-container">
    <?php if ($total_kegiatan > 0): ?>
        <?php for ($i = 1; $i <= $total_kegiatan; $i++): ?>
            <span class="dot" onclick="currentSlide(<?php echo $i; ?>)"></span>
        <?php endfor; ?>
    <?php endif; ?>
</div>

        </main>




<?php include 'includes/footer.php'; ?>
<script src="assets/js/slideshow.js"></script>