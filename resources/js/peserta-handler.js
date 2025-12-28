/**
 * Logika Filter dan Search Tabel Peserta
 */
window.filterTable = function () {
    const inputSearch = document.getElementById("searchInput");
    const inputFilter = document.getElementById("filterBidang");

    const filterSearch = inputSearch.value.toLowerCase().trim();
    const filterBidang = inputFilter.value.toLowerCase().trim();

    const table = document.getElementById("pesertaTable");
    if (!table) return;

    const tr = table.getElementsByTagName("tr");
    let hasResult = false;

    // Mulai dari i = 1 untuk melewati <thead>
    for (let i = 1; i < tr.length; i++) {
        // Cek apakah ini baris data (bukan baris pesan kosong)
        const tds = tr[i].getElementsByTagName("td");

        // Sesuaikan Indeks Kolom:
        // Jika kolom 1 = No, kolom 2 = Nama, kolom 3 = Bidang
        // Maka gunakan index [1] untuk Nama dan [3] untuk Bidang (sesuaikan tabel anda)
        const tdNama = tds[0];
        const tdBidang = tds[1];

        if (tdNama && tdBidang) {
            const txtNama = (
                tdNama.textContent || tdNama.innerText
            ).toLowerCase();
            const txtBidang = (
                tdBidang.textContent || tdBidang.innerText
            ).toLowerCase();

            const matchSearch = txtNama.includes(filterSearch);
            const matchBidang =
                filterBidang === "" || txtBidang.includes(filterBidang);

            if (matchSearch && matchBidang) {
                tr[i].style.display = "";
                hasResult = true;
            } else {
                tr[i].style.display = "none";
            }
        }
    }

    // Tampilkan/Sembunyikan pesan "Tidak ditemukan"
    const noResultMsg = document.getElementById("noResult");
    if (noResultMsg) {
        if (!hasResult) {
            noResultMsg.classList.remove("hidden");
        } else {
            noResultMsg.classList.add("hidden");
        }
    }
};

window.searchTable = function () {
    window.filterTable();
};
