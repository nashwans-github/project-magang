<div class="w-[270px] h-screen bg-[#272727]/60 text-white font-poppins flex flex-col">

    {{-- HEADER --}}
    <div class="bg-[#9E9E9E] h-[170px] flex flex-col justify-center items-center text-center">
        <img src="/images/logo-pemkot.png" class="w-[65px] mb-[13px]">
        <h3 class="text-[13px] font-extrabold text-[#031CFC]">
            PEMERINTAH KOTA SURABAYA
        </h3>
    </div>

    {{-- MENU --}}
    <ul class="mt-[25px] space-y-1 flex-1">
        <li class="menu-item {{ request()->routeIs('peserta.profile') ? 'active' : '' }}">
            <a href="{{ route('peserta.profile') }}">Profile</a>
        </li>
        <li class="menu-item {{ request()->routeIs('peserta.presensi') ? 'active' : '' }}">
            <a href="{{ route('peserta.presensi') }}">Presensi</a>
        </li>
        <li class="menu-item {{ request()->routeIs('peserta.progres') ? 'active' : '' }}">
            <a href="{{ route('peserta.progres') }}">Progres</a>
        </li>
        <li class="menu-item {{ request()->routeIs('peserta.penilaian') ? 'active' : '' }}">
            <a href="{{ route('peserta.penilaian') }}">Penilaian</a>
        </li>
        <li class="menu-item {{ request()->routeIs('peserta.surat') ? 'active' : '' }}">
            <a href="{{ route('peserta.surat') }}">Surat</a>
        </li>
    </ul>

    {{-- LOGOUT --}}
    <div onclick="openExitModal()"
        class="bg-[#353535] h-[70px] flex items-center justify-end pr-[60px]
                cursor-pointer hover:opacity-80 transition">

        <div class="flex items-center gap-3 text-[#B50000] font-extrabold text-[18px]">
            <img src="/vector/exit.svg" class="w-[23px]">
            <span>LogOut</span>
        </div>
    </div>
</div>

<!-- EXIT MODAL -->
<div id="exitModal"
     class="hidden fixed inset-0 z-[999] flex items-center justify-center">

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm"
         onclick="closeExitModal()"></div>

    <!-- MODAL -->
    <div class="relative w-[654px] h-[253px] rounded-[30px]
                bg-black border-[3px] border-[#B8860B]
                p-10 text-center
                shadow-[0_0_50px_rgba(184,134,11,0.6)]
                animate-fade-in-up">

        <h3 class="text-[#B8860B] text-[24px] font-bold mb-4">
            Keluar dari El-Magang?
        </h3>

        <p class="text-white text-[16px] font-normal leading-[1.6] mb-8 px-4">
            Anda akan keluar dari akun peserta.<br>
            Semua data dan progres Anda akan tetap tersimpan.
        </p>

        <div class="flex justify-center gap-4">
            <button onclick="closeExitModal()"
                class="w-[150px] py-3 rounded-xl
                       bg-[#444] text-white font-semibold
                       hover:bg-[#555] transition">
                Batal
            </button>

            <form id="logoutForm" method="POST" action="{{ route('peserta.logout') }}">
                @csrf
                <button type="submit"
                    class="w-[150px] py-3 rounded-xl
                           bg-[#B8860B] text-white font-semibold
                           hover:bg-[#cf980c]
                           hover:shadow-[0_0_15px_#B8860B]
                           transition">
                    Keluar
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function openExitModal() {
    const modal = document.getElementById('exitModal');
    if (!modal) return;

    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeExitModal() {
    const modal = document.getElementById('exitModal');
    if (!modal) return;

    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}
</script>