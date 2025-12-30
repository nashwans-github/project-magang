/**
 * Fungsi untuk melakukan preview gambar sebelum diupload
 */
function previewImage(input) {
    const fileNameElement = document.getElementById("file-name");
    const fileName = input.files[0]
        ? input.files[0].name
        : "Silahkan pilih file";
    fileNameElement.innerText = fileName;

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const placeholder = document.getElementById("preview-placeholder");
            const imgDisplay = document.getElementById("preview-image-display");

            if (placeholder) placeholder.classList.add("hidden");

            imgDisplay.src = e.target.result;
            imgDisplay.classList.remove("hidden");
            imgDisplay.style.display = "block";
        };
        reader.readAsDataURL(input.files[0]);
    }
}

/**
 * Fungsi untuk mengaktifkan mode edit pada form detail berita
 */
function enableEditMode() {
    // 1. Ubah teks judul form
    const formTitle = document.getElementById("form-title-text");
    if (formTitle) formTitle.innerText = "Edit Berita";

    // 2. Aktifkan semua input field
    const inputs = ["input-judul", "input-tanggal", "file_upload"];
    inputs.forEach((id) => {
        const el = document.getElementById(id);
        if (el) {
            el.removeAttribute("readonly");
            el.removeAttribute("disabled");
        }
    });

    // 3. Aktifkan tombol upload visual
    const uploadBtn = document.getElementById("btn-upload-label");
    if (uploadBtn) {
        uploadBtn.classList.remove("pointer-events-none", "opacity-60");
    }

    // 4. Tukar grup tombol aksi
    const initialGroup = document.getElementById("action-group-initial");
    const saveGroup = document.getElementById("action-group-save");

    if (initialGroup) initialGroup.classList.add("hidden");
    if (saveGroup) {
        saveGroup.classList.remove("hidden");
        saveGroup.classList.add("flex");
    }
}
