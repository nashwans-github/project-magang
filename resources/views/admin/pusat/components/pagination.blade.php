{{-- File: resources/views/admin/pusat/components/pagination.blade.php --}}

@if ($paginator->hasPages())
    <div class="mt-8 flex flex-col md:flex-row justify-between items-center border-t border-white/10 pt-4 gap-4">
        
        {{-- INFO HALAMAN (Kiri) --}}
        <div class="text-gray-400 text-sm order-2 md:order-1">
            Menampilkan 
            <span>{{ $paginator->firstItem() ?? 0 }}</span> 
            - 
            <span>{{ $paginator->lastItem() ?? 0 }}</span> 
            dari 
            <span>{{ $paginator->total() }}</span> 
            data
        </div>

        {{-- TOMBOL NAVIGASI (Kanan) --}}
        <div class="flex items-center gap-1 order-1 md:order-2">
            
            {{-- 1. Tombol Previous (<) --}}
            @if ($paginator->onFirstPage())
                <span class="w-8 h-8 flex items-center justify-center rounded bg-[#1F2937] border border-[#0554F2]/30 text-gray-500 cursor-not-allowed">
                    &lt;
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded border border-[#0554F2] text-white bg-[#0554F2] hover:bg-blue-600 transition-colors font-semibold">
                    &lt;
                </a>
            @endif

            {{-- 2. Loop Nomor Halaman --}}
            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                @if ($page == $paginator->currentPage())
                    {{-- Halaman Aktif --}}
                    <span class="w-8 h-8 flex items-center bg-[#1F2937] justify-center rounded text-white border border-[#0554F2] text-sm font-bold shadow-[0_0_10px_rgba(5,84,242,0.5)]">
                        {{ $page }}
                    </span>
                @else
                    {{-- Halaman Tidak Aktif --}}
                    <a href="{{ $url }}" class="w-8 h-8 flex items-center bg-transparent justify-center rounded border border-[#0554F2]/30 text-gray-400 hover:border-[#0554F2] hover:text-[#0554F2] transition-colors text-sm">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            {{-- 3. Tombol Next (>) --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded border border-[#0554F2] text-white bg-[#0554F2] hover:bg-blue-600 transition-colors font-semibold">
                    &gt;
                </a>
            @else
                <span class="w-8 h-8 flex items-center justify-center rounded bg-[#1F2937] border border-[#0554F2]/30 text-gray-500 cursor-not-allowed">
                    &gt;
                </span>
            @endif

        </div>
    </div>
@endif