/**
 * Logika Pencarian Permintaan Surat Magang
 */
window.filterSurat = function () {
    // 1. Ambil nilai input, kecilkan huruf, dan hapus spasi awal/akhir
    let input = document
        .getElementById("searchSurat")
        .value.toLowerCase()
        .trim();

    // 2. Ambil semua elemen item
    let items = document.querySelectorAll(".surat-item");
    let hasResult = false;

    // 3. Loop setiap item
    items.forEach(function (item) {
        // Ambil nama dari atribut data-name yang sudah kita set di HTML
        let name = item.getAttribute("data-nama");

        if (name.includes(input)) {
            // Jika COCOK: Tampilkan kembali
            item.classList.remove("hidden");
            item.classList.add("flex");
            hasResult = true;
        } else {
            // Jika TIDAK COCOK: Sembunyikan
            item.classList.add("hidden");
            item.classList.remove("flex");
        }
    });

    // 4. Tampilkan pesan kosong jika tidak ada hasil
    let emptyMsg = document.getElementById("noResultSurat");
    if (emptyMsg) {
        if (!hasResult) {
            emptyMsg.classList.remove("hidden");
        } else {
            emptyMsg.classList.add("hidden");
        }
    }
};
