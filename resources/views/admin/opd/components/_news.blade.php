<div class="bg-[#232226] border-[3px] p-6 border-[#011640] flex flex-col shadow-lg">
    {{-- JUDUL: Class tetap mb-10 text-[25px] sesuai asli --}}
    <h3 class="text-[#0554f2] font-bold mb-10 text-[25px] tracking-wide">Pemberitahuan</h3>

    @if(isset($allBerita) && count($allBerita) > 0)
        
        {{-- WRAPPER SLIDER --}}
        <div class="relative" 
            id="news-slider-container" 
            data-berita='@json($allBerita ?? [])' 
            data-edit-route="{{ route('opd.beritainstansi.index') }}">
            
            {{-- CONTAINER GAMBAR: Class tetap mx-10, h-[287px], dll sesuai asli --}}
            <div class="mx-10 h-[287px] bg-[#373737] rounded-[20px] overflow-hidden relative group">
                
                {{-- Looping Gambar --}}
                @foreach($allBerita as $index => $item)
                    <div id="slide-{{ $index }}" class="slide-item w-full h-full relative {{ $index === 0 ? 'block' : 'hidden' }}">
                        @if(!empty($item['file_path']))
                            <img src="{{ asset('images/' . $item['file_path']) }}" class="w-full h-full object-cover" alt="Berita">
                            
                            {{-- Overlay Judul & Tanggal --}}
                            <div class="absolute bottom-0 left-0 right-0 bg-black/60 p-4">
                                <h4 class="text-white font-bold text-lg">{{ $item['judul'] }}</h4>
                                {{-- Penambahan Tanggal di bawah judul --}}
                                <div class="flex items-center gap-2 mt-1">
                                    {{-- Menggunakan text-xs agar rapi di bawah judul --}}
                                    <span class="text-gray-300 text-sm">{{ $item['tanggal'] }}</span>
                                </div>
                            </div>
                        @else
                            {{-- Tampilan jika tidak ada gambar (Placeholder) --}}
                            <div class="w-full h-full flex flex-col items-center justify-center p-6 text-center text-white">
                                <h4 class="text-2xl font-bold mb-2">{{ $item['judul'] }}</h4>
                                <span class="text-xs mt-4 opacity-50">{{ $item['tanggal'] }}</span>
                            </div>
                        @endif
                    </div>
                @endforeach

                {{-- NAVIGASI ARROW KIRI & KANAN (Overlay di atas gambar agar layout tidak bergeser) --}}
                {{-- Arrow Left --}}
                <button onclick="moveSlide(-1)" class="absolute left-2 top-1/2 transform -translate-y-1/2 text-white/70 hover:text-white text-4xl font-bold z-10 px-2">
                    ❮
                </button>
                {{-- Arrow Right --}}
                <button onclick="moveSlide(1)" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-white/70 hover:text-white text-4xl font-bold z-10 px-2">
                    ❯
                </button>
            </div>

            {{-- INDIKATOR TITIK (DOTS) --}}
            {{-- Ditaruh di margin antara gambar dan tombol (di area mt-8) --}}
            <div class="flex justify-center items-center gap-2 mt-4 absolute w-full" style="top: 287px;"> 
                @foreach($allBerita as $index => $item)
                    <button onclick="jumpToSlide({{ $index }})" 
                            id="dot-{{ $index }}"
                            class="dot w-2 h-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white scale-125' : 'bg-gray-600 hover:bg-gray-500' }}">
                    </button>
                @endforeach
            </div>

            {{-- BUTTON EDIT: Class tetap mt-8 mr-10 w-[155px] sesuai asli --}}
            <div class="flex justify-end space-x-3 mt-8 mr-10 relative z-20">
                {{-- Href awal kosong, akan diisi JS saat load --}}
                <a id="edit-btn-link" href="#" class="w-[155px] h-[45px] bg-[#0554F2] hover:bg-[#0554F2] rounded-[15px] text-white text-lg font-bold shadow-lg flex items-center justify-center transition-all duration-300 hover:scale-105">
                    Edit Berita
                </a>
            </div>
        </div>

    @else
        {{-- EMPTY STATE: Class tetap sama --}}
        <div class="mx-10 h-[287px] bg-[#373737] rounded-[20px] flex flex-col items-center justify-center text-white/60 italic">
            <span class="text-xl">Tambahkan pemberitahuan</span>
        </div>
        <div class="flex justify-end mt-8 mr-10">
             <a href="{{ route('opd.beritainstansi.index', ['create' => true]) }}" class="text-[#0554F2] underline hover:text-white">Buat Berita Baru</a>
        </div>
    @endif
</div>