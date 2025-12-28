<aside class="w-64 h-screen bg-[#232226] flex flex-col fixed left-0 top-0 z-50 overflow-y-auto font-sans">
    
    {{-- LOGO AREA --}}
    <div class="px-6 pt-8 pb-4 flex items-center gap-3">
        <img src="{{ asset('images/logo_surabaya.png') }}" alt="Logo" class="w-12 h-12 object-contain">
        {{-- Menggunakan warna request anda: #0554f2 --}}
        <h1 class="text-xl font-bold text-[#0554f2] tracking-wide">
            Admin OPD
        </h1>
    </div>

    <div class="mx-6 border-b border-white mb-4"></div>

    {{-- 
        DEFINISI STYLE (Cukup sekali disini) 
        Agar tidak perlu tulis ulang di setiap menu
    --}}
    @php
        // Style saat menu AKTIF (Background gelap, Teks Putih)
        $activeClass = 'bg-[#2C2C2C] text-white shadow-lg';
        
        // Style saat menu TIDAK AKTIF (Teks Biru #0554f2)
        // Saya tambahkan hover:text-white agar saat disorot mouse jadi putih (opsional, biar bagus)
        $inactiveClass = 'text-[#0554f2] hover:bg-[#2C2C2C]';
    @endphp

    {{-- MENU DASHBOARD --}}
    <div class="px-4">
        @php $isActive = request()->is('admin/opd/dashboard') || request()->is('/'); @endphp
        
        <a href="{{ url('/admin/opd/dashboard') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ $isActive ? $activeClass : $inactiveClass }}">
            
            {{-- Logic Gambar: Dashboardaktif.svg (Putih) atau Dashboardnonaktif.svg (Biru) --}}
            <img src="{{ asset('vector/Dashboard' . ($isActive ? 'aktif' : 'nonaktif') . '.svg') }}" 
                 alt="Dashboard" 
                 class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:scale-110">
            
            <span class="font-bold text-lg">Dashboard</span>
        </a>
    </div>

    <div class="px-8 mt-2 mb-2">
        <span class="text-[#0554f2] text-xs font-bold uppercase tracking-wider">
            MASTER
        </span>
    </div>

    <nav class="flex-1 px-4 space-y-2">

        {{-- MENU PROFILE --}}
        @php $isActive = request()->is('admin/opd/profile*'); @endphp
        <a href="{{ url('/admin/opd/profile') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ $isActive ? $activeClass : $inactiveClass }}">
            <img src="{{ asset('vector/Profile' . ($isActive ? 'aktif' : 'nonaktif') . '.svg') }}" 
                 alt="Profile" class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:scale-110">
            <span class="font-bold text-base">Profile</span>
        </a>

        {{-- MENU PEMBIMBING (Label di kode teman anda 'Presensi', sesuaikan jika perlu) --}}
        @php $isActive = request()->is('admin/opd/pembimbing*'); @endphp
        <a href="{{ url('/admin/opd/pembimbing') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ $isActive ? $activeClass : $inactiveClass }}">
            <img src="{{ asset('vector/Pembimbing' . ($isActive ? 'aktif' : 'nonaktif') . '.svg') }}" 
                 alt="Pembimbing" class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:scale-110">
            <span class="font-bold text-base">Pembimbing</span>
        </a>

        {{-- MENU VERIFIKASI --}}
        @php $isActive = request()->is('admin/opd/verifikasi*'); @endphp
        <a href="{{ url('/admin/opd/verifikasi') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ $isActive ? $activeClass : $inactiveClass }}">
            <img src="{{ asset('vector/Verifikasi' . ($isActive ? 'aktif' : 'nonaktif') . '.svg') }}" 
                 alt="Verifikasi" class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:scale-110">
            <span class="font-bold text-base">Verifikasi</span>
        </a>

        {{-- MENU PESERTA --}}
        @php $isActive = request()->is('admin/opd/peserta*'); @endphp
        <a href="{{ url('/admin/opd/peserta') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ $isActive ? $activeClass : $inactiveClass }}">
            <img src="{{ asset('vector/Peserta' . ($isActive ? 'aktif' : 'nonaktif') . '.svg') }}" 
                 alt="Peserta" class="w-7 h-7 -ml-0.5 mr-2.5 transition-transform duration-300 group-hover:scale-110">
            <span class="font-bold text-base">Peserta</span>
        </a>

        {{-- MENU SURAT MAGANG --}}
        @php $isActive = request()->is('admin/opd/surat-magang*'); @endphp
        <a href="{{ url('/admin/opd/surat-magang') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ $isActive ? $activeClass : $inactiveClass }}">
            <img src="{{ asset('vector/SuratMagang' . ($isActive ? 'aktif' : 'nonaktif') . '.svg') }}" 
                 alt="Surat" class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:scale-110">
            <span class="font-bold text-base">Surat Magang</span>
        </a>

        {{-- MENU BERITA INSTANSI --}}
        @php $isActive = request()->is('admin/opd/berita*'); @endphp
        <a href="{{ url('/admin/opd/berita') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ $isActive ? $activeClass : $inactiveClass }}">
            <img src="{{ asset('vector/BeritaInstansi' . ($isActive ? 'aktif' : 'nonaktif') . '.svg') }}" 
                 alt="Berita" class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:scale-110">
            <span class="font-bold text-base">Berita Instansi</span>
        </a>

    </nav>
</aside>