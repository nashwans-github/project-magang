{{-- File: resources/views/admin/pusat/components/date-filter.blade.php --}}

<form action="{{ $url }}" method="GET" class="flex items-center gap-3">
    
    {{-- Jika ada pencarian yang sedang aktif, kita ikut kirimkan agar tidak reset --}}
    @if(request('search'))
        <input type="hidden" name="search" value="{{ request('search') }}">
    @endif

    {{-- Wrapper Tombol Filter --}}
    <div class="relative group">
        
        {{-- Tampilan Visual Tombol --}}
        <div class="bg-[#C4C4C4]/50 hover:bg-[#555555] cursor-pointer flex items-center gap-2 px-3 py-2.5 rounded-full transition-all duration-300 ease-in-out shadow-sm border border-transparent focus-within:border-[#0066FF]">
            
            {{-- Icon Kalender --}}
            <img src="{{ asset('images/icons/presensi-kalender.svg') }}" alt="Calendar" class="w-4 h-4 object-contain opacity-80 group-hover:opacity-100 transition-opacity duration-300">

            {{-- Icon Panah Bawah --}}
            <img src="{{ asset('images/icons/presensi-bukakalender.svg') }}" alt="Arrow" class="w-3 h-3 object-contain opacity-80 group-hover:opacity-100 transition-opacity duration-300">
        </div>

        {{-- Input Date Asli (Invisible / Transparan menutupi tombol) --}}
        <input type="date" 
               name="date_filter"
               value="{{ request('date_filter') }}"
               onchange="this.form.submit()"
               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
               title="Pilih Tanggal">
    </div>

    {{-- Link Reset Filter (Muncul jika ada filter tanggal) --}}
    @if(request('date_filter'))
        <a href="{{ $url }}" class="text-sm text-[#0066FF] hover:text-blue-400 whitespace-nowrap font-medium transition-colors" title="Hapus Filter">
            Hapus Filter ({{ \Carbon\Carbon::parse(request('date_filter'))->format('d/m/Y') }})
        </a>
    @endif

</form>