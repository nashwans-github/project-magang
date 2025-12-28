// resources/js/news-handler.js

document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("news-slider-container");
    if (!container) return;

    // Ambil data berita dan route dari atribut data
    const beritaData = JSON.parse(
        container.getAttribute("data-berita") || "[]"
    );
    const editRouteBase = container.getAttribute("data-edit-route");
    const editBtn = document.getElementById("edit-btn-link");

    let currentIndex = 0;
    const slides = document.querySelectorAll(".slide-item");
    const dots = document.querySelectorAll(".dot");

    function updateSlider(index) {
        if (slides.length === 0) return;

        // Reset index jika melebihi jumlah slide
        if (index >= slides.length) currentIndex = 0;
        else if (index < 0) currentIndex = slides.length - 1;
        else currentIndex = index;

        // 1. Update visibilitas Slide
        slides.forEach((slide, i) => {
            if (i === currentIndex) {
                slide.classList.remove("hidden");
                slide.classList.add("block");
            } else {
                slide.classList.add("hidden");
                slide.classList.remove("block");
            }
        });

        // 2. Update Warna Dots
        dots.forEach((dot, i) => {
            if (i === currentIndex) {
                dot.classList.add("bg-white", "scale-125");
                dot.classList.remove("bg-gray-600");
            } else {
                dot.classList.remove("bg-white", "scale-125");
                dot.classList.add("bg-gray-600");
            }
        });

        // 3. Update Link Tombol Edit
        if (editBtn && beritaData[currentIndex]) {
            const currentId = beritaData[currentIndex].id;
            // Menghasilkan URL: /admin/opd/beritainstansi?edit=1
            editBtn.href = `${editRouteBase}?edit=${currentId}`;
        }
    }

    // WAJIB: Tempelkan ke window agar onclick="moveSlide()" di Blade terbaca
    window.moveSlide = function (step) {
        updateSlider(currentIndex + step);
    };

    window.jumpToSlide = function (index) {
        updateSlider(index);
    };

    // Jalankan inisialisasi pertama kali
    updateSlider(0);
});
