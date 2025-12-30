/**
 * Logika Toggle Mode Edit & View
 */
window.toggleEditMode = function (isEdit) {
    const viewModeInfo = document.getElementById("info-view-mode");
    const editModeInfo = document.getElementById("info-edit-mode");
    const btnEdit = document.getElementById("btn-edit");
    const btnSave = document.getElementById("btn-save");
    const btnCancel = document.getElementById("btn-cancel");
    const editOnlyElements = document.querySelectorAll(".edit-only");

    const docInputs = document.querySelectorAll(".doc-input");
    const docLabels = document.querySelectorAll(".doc-label");

    if (isEdit) {
        if (viewModeInfo) viewModeInfo.classList.add("hidden");
        if (editModeInfo) editModeInfo.classList.remove("hidden");
        if (btnEdit) btnEdit.classList.add("hidden");
        if (btnSave) btnSave.classList.remove("hidden");
        if (btnCancel) btnCancel.classList.remove("hidden");
        editOnlyElements.forEach((el) => el.classList.remove("hidden"));
        docInputs.forEach((input) => (input.disabled = false));
        docLabels.forEach((label) => {
            label.classList.remove("cursor-default");
            label.classList.add("cursor-pointer");
        });
    } else {
        if (viewModeInfo) viewModeInfo.classList.remove("hidden");
        if (editModeInfo) editModeInfo.classList.add("hidden");
        if (btnEdit) btnEdit.classList.remove("hidden");
        if (btnSave) btnSave.classList.add("hidden");
        if (btnCancel) btnCancel.classList.add("hidden");
        editOnlyElements.forEach((el) => el.classList.add("hidden"));
        docInputs.forEach((input) => (input.disabled = true));
        docLabels.forEach((label) => {
            label.classList.add("cursor-default");
            label.classList.remove("cursor-pointer");
        });
    }
};

// Variabel Global
let currentFileUrl = null;
let currentTargetElement = null;
let scrollPosition = 0;

/**
 * Fungsi Pembantu: Mengunci Scroll
 * Mencegah layar bergeser saat modal terbuka
 */
function toggleLockScroll(isLocked) {
    const html = document.documentElement;
    const body = document.body;

    if (isLocked) {
        // Simpan posisi scroll saat ini
        scrollPosition = window.pageYOffset || html.scrollTop;

        // Lock scroll pada html dan body
        html.style.overflow = "hidden";
        html.style.height = "100%";
        body.style.overflow = "hidden";
        body.style.height = "100%";
        body.style.position = "fixed";
        body.style.top = `-${scrollPosition}px`;
        body.style.width = "100%";
    } else {
        // Kembalikan scroll ke posisi semula
        html.style.overflow = "";
        html.style.height = "";
        body.style.overflow = "";
        body.style.height = "";
        body.style.position = "";
        body.style.top = "";
        body.style.width = "";

        // Restore posisi scroll
        window.scrollTo(0, scrollPosition);
    }
}

/**
 * Manajemen Bidang
 */
window.toggleDropdown = function (event, button) {
    event.preventDefault();
    event.stopPropagation();
    document.querySelectorAll(".dropdown-menu").forEach((menu) => {
        if (menu !== button.nextElementSibling) menu.classList.add("hidden");
    });
    const dropdown = button.nextElementSibling;
    if (dropdown) dropdown.classList.toggle("hidden");
};

window.removeField = function (event, button) {
    event.preventDefault();
    event.stopPropagation();
    if (confirm("Apakah Anda yakin ingin menghapus bidang ini?")) {
        const item = button.closest(".field-item");
        if (item) item.remove();
    }
};

window.openRenameModal = function (event, button) {
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }

    currentTargetElement = button.closest(".field-item");
    const nameSpan = currentTargetElement.querySelector(".field-name");
    const currentName = nameSpan ? nameSpan.innerText : "";

    const input = document.getElementById("rename-input");
    if (input) input.value = currentName.trim();

    const modal = document.getElementById("rename-modal");
    if (modal) {
        // Lock scroll SEBELUM menampilkan modal
        toggleLockScroll(true);

        // Tampilkan modal
        modal.classList.remove("hidden");

        // Focus pada input setelah modal tampil
        setTimeout(() => {
            if (input) input.focus();
        }, 100);
    }

    // Tutup dropdown
    document
        .querySelectorAll(".dropdown-menu")
        .forEach((menu) => menu.classList.add("hidden"));
};

window.saveRename = function (event) {
    if (event) event.preventDefault();
    const newName = document.getElementById("rename-input").value;
    if (newName && currentTargetElement) {
        const nameSpan = currentTargetElement.querySelector(".field-name");
        if (nameSpan) nameSpan.innerText = newName;
        window.closeModal("rename-modal");
    }
};

window.openAddModal = function (event) {
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }

    const input = document.getElementById("add-input");
    if (input) input.value = "";

    window.resetFileUpload(null);

    const modal = document.getElementById("add-modal");
    if (modal) {
        // Lock scroll SEBELUM menampilkan modal
        toggleLockScroll(true);

        // Tampilkan modal
        modal.classList.remove("hidden");

        // Focus pada input setelah modal tampil
        setTimeout(() => {
            if (input) input.focus();
        }, 100);
    }
};

window.saveAdd = function (event) {
    if (event) event.preventDefault();
    const newName = document.getElementById("add-input").value;
    if (!newName) {
        alert("Nama bidang tidak boleh kosong!");
        return;
    }
    alert("Bidang '" + newName + "' berhasil ditambahkan!");
    window.closeModal("add-modal");
};

window.closeModal = function (modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add("hidden");
        // Unlock scroll setelah modal ditutup
        toggleLockScroll(false);
    }
};

window.closeModalOutside = function (event) {
    if (event.target.id === "rename-modal" || event.target.id === "add-modal") {
        window.closeModal(event.target.id);
    }
};

/**
 * Upload File Ikon
 */
window.handleFileSelect = function (event) {
    const file = event.target.files[0];
    if (file) {
        if (currentFileUrl) URL.revokeObjectURL(currentFileUrl);
        currentFileUrl = URL.createObjectURL(file);

        const fileNameText = document.getElementById("file-name-text");
        const stateDefault = document.getElementById("state-default");
        const stateUploaded = document.getElementById("state-uploaded");

        if (fileNameText) fileNameText.innerText = file.name;
        if (stateDefault) stateDefault.classList.add("hidden");
        if (stateUploaded) {
            stateUploaded.classList.remove("hidden");
            stateUploaded.classList.add("inline-flex");
        }
    }
};

window.resetFileUpload = function (event) {
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }
    const iconInput = document.getElementById("add-icon-input");
    if (iconInput) iconInput.value = "";

    if (currentFileUrl) {
        URL.revokeObjectURL(currentFileUrl);
        currentFileUrl = null;
    }

    const stateUploaded = document.getElementById("state-uploaded");
    const stateDefault = document.getElementById("state-default");

    if (stateUploaded) {
        stateUploaded.classList.add("hidden");
        stateUploaded.classList.remove("inline-flex");
    }
    if (stateDefault) stateDefault.classList.remove("hidden");
};

// Event Listener Global
window.addEventListener("click", () => {
    document
        .querySelectorAll(".dropdown-menu")
        .forEach((menu) => menu.classList.add("hidden"));
});
