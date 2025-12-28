window.filterVerifikasi = function () {
    const searchInput = document
        .getElementById("searchInput")
        .value.toLowerCase()
        .trim();
    const filterStatus = document
        .getElementById("filterStatus")
        .value.toLowerCase()
        .trim();

    const items = document.querySelectorAll(".verifikasi-item");
    let hasVisibleItem = false;

    items.forEach((item) => {
        // Gunakan (item.getAttribute(...) || "") untuk mencegah error jika atribut kosong
        const name = (item.getAttribute("data-nama") || "")
            .toLowerCase()
            .trim();
        const status = (item.getAttribute("data-status") || "")
            .toLowerCase()
            .trim();

        // LOGIKA PENCARIAN
        // matchName: Apakah nama mengandung kata kunci?
        const matchName = name.includes(searchInput);

        // matchStatus: Apakah status cocok? (Logika includes lebih fleksibel)
        const matchStatus =
            filterStatus === "" || status.includes(filterStatus);

        if (matchName && matchStatus) {
            item.classList.remove("hidden");
            hasVisibleItem = true;
        } else {
            item.classList.add("hidden");
        }
    });

    // Tampilkan pesan jika benar-benar tidak ada yang cocok
    const noResult = document.getElementById("noResult");
    if (noResult) {
        if (!hasVisibleItem && (searchInput !== "" || filterStatus !== "")) {
            noResult.classList.remove("hidden");
        } else if (hasVisibleItem) {
            noResult.classList.add("hidden");
        }
    }
};
