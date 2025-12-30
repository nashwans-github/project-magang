{{-- File: resources/views/admin/pusat/components/search-bar.blade.php --}}

<form action="{{ $url }}" method="GET" class="w-full md:w-auto">
    {{-- Jika ada filter tanggal yang sedang aktif, kita ikut kirimkan di form search ini agar tidak hilang --}}
    @if(request('date_filter'))
        <input type="hidden" name="date_filter" value="{{ request('date_filter') }}">
    @endif

    <div class="relative w-full md:w-[350px]">
        
        {{-- Icon Search --}}
        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-black/60">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </span>

        {{-- Input Field --}}
        <input type="text" 
               name="search"
               value="{{ request('search') }}"
               placeholder="{{ $placeholder ?? 'Cari data...' }}" 
               class="w-full py-2.5 pl-12 pr-4 rounded-full bg-[#C4C4C4]/50 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-[#0066FF] transition-all font-medium">
    </div>
</form>