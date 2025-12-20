<?php include 'includes/meta.php'; ?>
<?php include 'includes/header.php'; ?>

<?php 

?>

<main>
        <section class="contact-container">
            <h2 class="text-contact">Kontak Kami</h2>
            <p class="text-contact-description">terhubung dengan kami melalui form dibawah ini</p>
            <form class="contact-container-form" action="">
                <label for="nama">Nama</label>
                <input class="input" type="text" required>
                <label for="email">Email</label>
                <input class="input" type="email" required>
                <label for="pesan">Pesan</label>
                <textarea class="textarea" name="" id=""></textarea>
                <div class="contact-button-container">
                    <button class="btn" type="submit">kirim</button>
                </div>
            </form>
        </section>
    </main>


<?php include 'includes/footer.php'; ?>