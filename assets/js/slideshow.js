let slideIndex = 1;
let slideInterval;

// Inisialisasi slideshow
showSlides(slideIndex);
autoSlide();

// Function untuk auto slide setiap 5 detik
function autoSlide() {
    slideInterval = setInterval(() => {
        plusSlides(1);
    }, 4000);
}

// Next/previous controls
function plusSlides(n) {
    clearInterval(slideInterval);
    showSlides(slideIndex += n);
    autoSlide();
}

// Thumbnail image controls
function currentSlide(n) {
    clearInterval(slideInterval);
    showSlides(slideIndex = n);
    autoSlide();
}

function showSlides(n) {
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    
    // Sembunyikan semua slides
    for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");
    }
    
    // Remove active class dari semua dots
    for (let i = 0; i < dots.length; i++) {
        dots[i].classList.remove("active");
    }
    
    // Tampilkan slide yang aktif
    slides[slideIndex-1].classList.add("active");
    dots[slideIndex-1].classList.add("active");}