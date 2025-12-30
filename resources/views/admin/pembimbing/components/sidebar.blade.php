<aside class="w-64 h-screen bg-[#1A1A1A] flex flex-col fixed left-0 top-0 z-50 overflow-y-auto font-sans shadow-2xl border-r border-[#333]">
    
    <div class="px-6 pt-8 pb-4 flex items-center gap-3">
        <img src="{{ asset('images/logo-pemkot.png') }}" alt="Logo" class="w-10 h-10 object-contain drop-shadow-md">
        <h1 class="text-lg font-bold text-[#0066FF] tracking-wide leading-none">
            Pembimbing
        </h1>
    </div>

    <div class="mx-4 border-b border-white mb-6"></div>

    @php
        $activeClass = 'bg-[#2C2C2C] text-white shadow-lg';
        $inactiveClass = 'text-[#0066FF] hover:bg-[#2C2C2C]';
    @endphp

    {{-- 1. MENU DASHBOARD --}}
    <div class="px-4 mb-2">
        @php $isActive = request()->is('admin/pembimbing/dashboard*'); @endphp
        
        <a href="{{ route('pembimbing.dashboard', request()->query()) }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ $isActive ? $activeClass : $inactiveClass }}">
            
            <img src="{{ asset('vector/icons_sidebar/pembimbing-dashboard_' . ($isActive ? 'aktif' : 'nonaktif') . '.svg') }}" 
                 alt="Dashboard" 
                 class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:scale-110">
            
            <span class="font-bold text-lg">Dasboard</span>
        </a>
    </div>

    {{-- LABEL MASTER --}}
    <div class="px-8 mt-4 mb-2">
        <span class="text-[#0066FF] text-xs font-bold uppercase tracking-wider">
            MASTER
        </span>
    </div>

    <nav class="flex-1 px-4 space-y-2">

        {{-- 2. MENU DAFTAR PESERTA --}}
        @php $isActive = request()->is('admin/pembimbing/daftar-peserta*'); @endphp
        <a href="{{ route('pembimbing.daftar-peserta.index', request()->query()) }}" 
           class="flex items-center px-4 py-3 rounded-r-xl transition-all duration-300 group {{ $isActive ? $activeClass : $inactiveClass }}">
            
            <img src="{{ asset('vector/icons_sidebar/pembimbing-daftarpeserta_' . ($isActive ? 'aktif' : 'nonaktif') . '.svg') }}" 
                 alt="Peserta" 
                 class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:scale-110">
            
            <span class="font-bold text-base">Daftar Peserta</span>
        </a>

        {{-- 3. MENU PRESENSI --}}
        {{-- Route: admin/pembimbing/presensi --}}
        @php $isActive = request()->is('admin/pembimbing/presensi*'); @endphp
        <a href="{{ route('pembimbing.presensi.index', request()->query()) }}" 
           class="flex items-center px-4 py-3 rounded-r-xl transition-all duration-300 group {{ $isActive ? $activeClass : $inactiveClass }}">
            
            <img src="{{ asset('vector/icons_sidebar/pembimbing-presensi_' . ($isActive ? 'aktif' : 'nonaktif') . '.svg') }}" 
                 alt="Presensi" 
                 class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:scale-110">
            
            <span class="font-bold text-base">Presensi</span>
        </a>

        {{-- 4. MENU PROGRES --}}
        {{-- Route: admin/pembimbing/progres --}}
        @php $isActive = request()->is('admin/pembimbing/progres*'); @endphp
        <a href="{{ route('pembimbing.progres.index', request()->query()) }}" 
           class="flex items-center px-4 py-3 rounded-r-xl transition-all duration-300 group {{ $isActive ? $activeClass : $inactiveClass }}">
            
            <img src="{{ asset('vector/icons_sidebar/pembimbing-progres_' . ($isActive ? 'aktif' : 'nonaktif') . '.svg') }}" 
                 alt="Progres" 
                 class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:scale-110">
            
            <span class="font-bold text-base">Progres</span>
        </a>

        {{-- 5. MENU PENILAIAN --}}
        {{-- Route: admin/pembimbing/penilaian --}}
        @php $isActive = request()->is('admin/pembimbing/penilaian*'); @endphp
        <a href="{{ route('pembimbing.penilaian.index', request()->query()) }}" 
           class="flex items-center px-4 py-3 rounded-r-xl transition-all duration-300 group {{ $isActive ? $activeClass : $inactiveClass }}">
            
            <img src="{{ asset('vector/icons_sidebar/pembimbing-penilaiyan_' . ($isActive ? 'aktif' : 'nonaktif') . '.svg') }}" 
                 alt="Penilaian" 
                 class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:scale-110">
            
            <span class="font-bold text-base">Penilaian</span>
        </a>

    </nav>
</aside>