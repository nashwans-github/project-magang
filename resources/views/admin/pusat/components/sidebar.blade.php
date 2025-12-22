<aside class="w-64 h-screen bg-[#1A1A1A] flex flex-col fixed left-0 top-0 z-50 overflow-y-auto font-sans">
    
    <div class="px-6 pt-8 pb-4 flex items-center gap-3">
        <img src="{{ asset('images/logo-pemkot.png') }}" alt="Logo" class="w-12 h-12 object-contain">
        <h1 class="text-lg font-bold text-[#0066FF] tracking-wide">
            Admin Pusat
        </h1>
    </div>

    <div class="mx-4 border-b border-white mb-6"></div>

    @php
        $activeClass = 'bg-[#2C2C2C] text-white shadow-lg';
        $inactiveClass = 'text-[#0066FF] hover:bg-[#2C2C2C]';
    @endphp

    <div class="px-4 mb-2">
        {{-- Update: Cek URL 'pusat/dashboard' --}}
        @php $isActive = request()->is('admin/pusat/dashboard'); @endphp
        
        <a href="{{ url('/admin/pusat/dashboard') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ $isActive ? $activeClass : $inactiveClass }}">
            
            <img src="{{ asset('images/icons_sidebar/pembimbing-dashboard_' . ($isActive ? 'aktif' : 'nonaktif') . '.svg') }}" 
                 alt="Dashboard" 
                 class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:scale-110">
            
            <span class="font-bold text-lg">Dasboard</span>
        </a>
    </div>

    <div class="px-8 mt-2 mb-2">
        <span class="text-[#0066FF] text-xs font-bold uppercase tracking-wider">
            MASTER
        </span>
    </div>

    <nav class="flex-1 px-4 space-y-2">

        @php $isActive = request()->is('admin/pusat/pendaftar*'); @endphp
        <a href="{{ url('/admin/pusat/pendaftar') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ $isActive ? $activeClass : $inactiveClass }}">
            
            <img src="{{ asset('images/icons_sidebar/PUSAT-pendaftar_' . ($isActive ? 'aktif' : 'nonaktif') . '.svg') }}" 
                 alt="Pendaftar" 
                 class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:scale-110">
                 
            <span class="font-bold text-base">Pendaftar</span>
        </a>

        @php $isActive = request()->is('admin/pusat/manajemen-opd*'); @endphp
        <a href="{{ url('/admin/pusat/manajemen-opd') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ $isActive ? $activeClass : $inactiveClass }}">
            
            <img src="{{ asset('images/icons_sidebar/PUSAT-manajemenOPD_' . ($isActive ? 'aktif' : 'nonaktif') . '.svg') }}" 
                 alt="Manajemen OPD" 
                 class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:scale-110">
                 
            <span class="font-bold text-base">Manajemen OPD</span>
        </a>

    </nav>
</aside>