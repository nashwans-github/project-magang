{{-- JUDUL --}}
<p class="text-white/60 text-lg font-semibold mb-6">Dokumentasi</p>
@php
    // Pastikan mengambil dari $instansi jika data sudah digabung
    $gallery = $instansi['gallery'] ?? [];
@endphp


{{-- GRID GAMBAR --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- LOOPING TETAP 3 KALI --}}
    @for ($i = 0; $i < 3; $i++)
        @php
            $loopId = $i + 1;
            // Cek data
            $hasImage = isset($gallery[$i]) && !empty($gallery[$i]);
            $currentImage = $hasImage ? $gallery[$i] : null;
        @endphp

        {{-- 
             CHANGE 1: 
             - Hapus 'cursor-pointer', ganti jadi 'cursor-default' (defaultnya tidak bisa diklik).
             - Tambahkan class identifier 'doc-label'.
        --}}
        <label for="upload-doc-{{ $loopId }}" 
               class="doc-label w-full aspect-[288/313] rounded-lg overflow-hidden relative group cursor-default block bg-[#D9D9D9] transition-colors">
            
            {{-- KONDISI 1: JIKA ADA GAMBAR --}}
            @if($hasImage)
                <img src="{{ asset($currentImage) }}" 
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-105" 
                     alt="Dokumentasi {{ $loopId }}">
                
                {{-- Overlay Edit (Hanya muncul saat hover & mode edit) --}}
                <div class="absolute inset-0 bg-black/60 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px] edit-only hidden">
                    <img src="{{ asset('vector/Edit Foto.svg') }}" class="w-10 h-10 mb-2" alt="Edit">
                    <span class="text-white font-semibold text-lg tracking-wide">Ganti Foto</span>
                </div>

            {{-- KONDISI 2: JIKA KOSONG --}}
            @else
                <div class="w-full h-full flex flex-col items-center justify-center text-[#6C6C6C]">
                    
                    {{-- 
                        CHANGE 2: 
                        Mengganti kode SVG panjang dengan <img>.
                        Pastikan Anda punya file 'Placeholder.svg' atau nama lain di folder public/images.
                    --}}
                    <img src="{{ asset('vector/Tambah Gambar.svg') }}" class="w-16 h-16 mb-2" alt="Tambah">
                    
                    <span class="font-medium">Tambahkan gambar</span>
                </div>
            @endif
            
            {{-- 
                 CHANGE 3: 
                 - Tambahkan attribute 'disabled'. Ini kuncinya agar tidak bisa diklik.
                 - Tambahkan class 'doc-input' untuk dipanggil JS.
            --}}
            <input type="file" id="upload-doc-{{ $loopId }}" name="doc{{ $loopId }}" class="doc-input hidden" accept="image/*" disabled>
        </label>
    @endfor

</div>