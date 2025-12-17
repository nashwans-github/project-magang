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
                <li><a href="/?section=hero" class="scroll-link nav-scroll text-[#0015FF] text-[18.5px] font-medium hover:text-blue-800 transition" style="font-family: 'Poppins', sans-serif;">Beranda</a></li>
                <li><a href="/?section=instansi" class="scroll-link nav-scroll text-[#0015FF] text-[18.5px] font-medium hover:text-blue-800 transition" style="font-family: 'Poppins', sans-serif;">Instansi</a></li>
                <li><a href="/?section=langkah" class="scroll-link nav-scroll text-[#0015FF] text-[18.5px] font-medium hover:text-blue-800 transition" style="font-family: 'Poppins', sans-serif;">Cara Mendaftar</a></li>
                <li><a href="/?section=faq" class="scroll-link nav-scroll text-[#0015FF] text-[18.5px] font-medium hover:text-blue-800 transition" style="font-family: 'Poppins', sans-serif;">Faq</a></li>
            </ul>

            <div class="nav-action">
                <a href="{{ url('/login') }}"
                    class="nav-login-btn ml-28 px-8 py-3 bg-[#0554F2] text-white rounded-md font-medium text-[15px] hover:bg-blue-700 transition"
                    style="font-family: 'Poppins', sans-serif;">
                    Masuk
                </a>
            </div>

        </div>

    </div>
</nav>