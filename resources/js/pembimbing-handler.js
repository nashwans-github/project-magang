/**
 * Logika Filter Tabel Pembimbing
 */
window.filterTable = function () {
    const searchInput = document
        .getElementById("searchInput")
        .value.toLowerCase();
    const filterValue = document.getElementById("filterBidang").value;
    const tableBody = document.getElementById("tableBody");
    const rows = tableBody.getElementsByClassName("data-row");
    let hasVisibleRow = false;

    for (let i = 0; i < rows.length; i++) {
        const namaCell = rows[i].getElementsByTagName("td")[0];
        const bidangCell = rows[i].getElementsByTagName("td")[1];

        if (namaCell && bidangCell) {
            const namaText = namaCell.textContent || namaCell.innerText;
            const bidangText = bidangCell.textContent || bidangCell.innerText;

            const matchSearch =
                namaText.toLowerCase().indexOf(searchInput) > -1;
            const matchFilter =
                filterValue === "" || bidangText.trim() === filterValue;

            if (matchSearch && matchFilter) {
                rows[i].style.display = "";
                hasVisibleRow = true;
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    const noDataMsg = document.getElementById("noDataMessage");
    if (noDataMsg) {
        hasVisibleRow
            ? noDataMsg.classList.add("hidden")
            : noDataMsg.classList.remove("hidden");
    }
};

/**
 * Logika Show/Hide Password
 */
window.togglePassword = function () {
    const passwordInput = document.getElementById("inputPassword");
    const iconOpen = document.getElementById("iconEyeOpen");
    const iconClose = document.getElementById("iconEyeClose");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        iconOpen.classList.add("hidden");
        iconClose.classList.remove("hidden");
    } else {
        passwordInput.type = "password";
        iconOpen.classList.remove("hidden");
        iconClose.classList.add("hidden");
    }
};
