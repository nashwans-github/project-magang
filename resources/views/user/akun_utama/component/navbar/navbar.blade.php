<nav id="navbar"
    class="navbar-main w-full fixed top-0 left-0 z-50 transition-all duration-300
            bg-white/50">
    <div class="max-w-7xl mx-auto flex items-center justify-between py-5 px-6">

        <!-- LOGO + TEXT -->
        <div class="flex items-center space-x-3">
            <img src="/images/logo-pemkot.png" class="w-10" alt="Logo">
            <span class="font-bold text-[#031CFC] text-[16px]" style="font-family: 'Poppins', sans-serif;">
                PEMERINTAH KOTA SURABAYA
            </span>
        </div>

        <!-- MENU -->
        <div class="flex items-center">

            <ul class="navbar-menu flex items-center">
                <li><a href="#hero2" data-navbar="akun" class="scroll-link nav-scroll text-[#0015FF] text-[18.5px] font-medium hover:text-blue-800 transition" style="font-family: 'Poppins', sans-serif;">Beranda</a></li>
                <li><a href="#pemberitahuan" data-navbar="akun" class="scroll-link nav-scroll text-[#0015FF] text-[18.5px] font-medium hover:text-blue-800 transition" style="font-family: 'Poppins', sans-serif;">Pemberitahuan</a></li>
                <li><a href="#informasi" data-navbar="akun" class="scroll-link nav-scroll text-[#0015FF] text-[18.5px] font-medium hover:text-blue-800 transition" style="font-family: 'Poppins', sans-serif;">Informasi</a></li>
                <li><a href="#login" data-navbar="akun" class="scroll-link nav-scroll text-[#0015FF] text-[18.5px] font-medium hover:text-blue-800 transition" style="font-family: 'Poppins', sans-serif;">Login</a></li>
            </ul>

            <div class="nav-action ml-28">
                <a href="#"
                class="nav-login-btn exit-btn flex items-center justify-center
                        w-12 h-12 bg-[#C30000] rounded-full
                        hover:bg-red-700 transition">
                    <img src="/vector/exit.svg" alt="Exit" class="exit-icon w-6 h-6">
                </a>
            </div>

        </div>

    </div>
</nav>

<div id="exitModal" class="hidden fixed inset-0 z-[999] flex items-center justify-center">
    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm"
         onclick="closeExitModal()"></div>

    <div class="relative bg-black border-[3px] border-[#B8860B]
                w-[654px] h-[253px] rounded-[30px] p-10 text-center
                shadow-[0_0_50px_rgba(184,134,11,0.6)]
                animate-fade-in-up">

        <h3 class="text-[#B8860B] text-[24px] font-bold mb-4">
            Keluar dari Portal Utama?
        </h3>

        <p class="text-white text-[16px] mb-8 leading-relaxed px-4">
            Anda akan keluar dari akun utama portal magang.<br>
            Semua data dan progres Anda akan tetap tersimpan.
        </p>

        <div class="flex gap-4 justify-center">
            <button onclick="closeExitModal()"
                class="w-[150px] py-3 rounded-xl bg-[#444] text-white font-semibold
                       hover:bg-[#555] transition">
                Batal
            </button>

            {{-- ✅ LOGOUT POST --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-[150px] py-3 rounded-xl bg-[#B8860B]
                           text-white font-semibold
                           hover:bg-[#cf980c]
                           hover:shadow-[0_0_15px_#B8860B] transition">
                    Keluar
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const exitBtn = document.querySelector(".exit-btn");
    const exitModal = document.getElementById("exitModal");

    if (!exitBtn || !exitModal) return;

    exitBtn.addEventListener("click", (e) => {
        e.preventDefault();
        openExitModal();
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && !exitModal.classList.contains("hidden")) {
            closeExitModal();
        }
    });
});

function openExitModal() {
    const modal = document.getElementById("exitModal");
    if (!modal) return;

    modal.classList.remove("hidden");
    document.body.classList.add("overflow-hidden");
}

function closeExitModal() {
    const modal = document.getElementById("exitModal");
    if (!modal) return;

    modal.classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
}
</script>