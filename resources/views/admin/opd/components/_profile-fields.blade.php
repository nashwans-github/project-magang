{{-- JUDUL --}}
<div class="flex justify-between items-center mb-10">
    <p class="text-white/60 text-lg font-semibold">Bidang</p>
</div>

{{-- WRAPPER UTAMA --}}
<div class="flex flex-wrap justify-center gap-x-12 gap-y-10 max-w-6xl mx-auto relative" id="fields-wrapper">
    @foreach($bidangs as $bidang)
    <div class="field-item flex flex-col items-center group cursor-pointer w-[100px] relative">
        {{-- DROPDOWN --}}
        <div class="absolute -top-2 -right-4 z-30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 edit-only hidden">
            <div class="relative">
                <button type="button" onclick="toggleDropdown(event, this)" class="p-1 rounded-full hover:bg-black/20 transition">
                    <img src="{{ asset('vector/Titik Tiga.svg') }}" class="w-7 h-7" alt="More">
                </button>
                <div class="dropdown-menu hidden absolute top-full left-0 mt-1 w-32 bg-white rounded-lg shadow-xl border border-gray-200 overflow-hidden z-40">
                    <button type="button" onclick="openRenameModal(event, this)" class="w-full text-left px-4 py-3 text-sm text-black hover:bg-[#E5E5E5] flex items-center gap-2 transition">
                        <img src="{{ asset('vector/Rename.svg') }}" class="w-4 h-4" alt="Rename">
                        <span>Rename</span>
                    </button>
                    <button type="button" onclick="removeField(event, this)" class="w-full text-left px-4 py-3 text-sm text-red-500 hover:bg-[#E5E5E5] flex items-center gap-2 transition">
                        <img src="{{ asset('vector/Remove.svg') }}" class="w-4 h-4" alt="Remove">
                        <span>Remove</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- IKON --}}
        <div class="relative w-[56px] h-[56px] flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
            <div class="absolute inset-0 rounded-[20px] bg-gradient-to-br from-[{{ $bidang['gradient_end'] }}] to-[{{ $bidang['gradient_start'] }}] rotate-[11deg] shadow-lg"></div>
            <img src="{{ asset('images/icons/' . $bidang['icon']) }}" class="relative z-10 w-7 h-7" alt="Icon">
        </div>

        {{-- TEXT --}}
        <span class="field-name mt-5 text-white text-base font-medium text-center leading-tight">
            {!! $bidang['name'] !!}
        </span>
    </div>
    @endforeach

    {{-- TOMBOL TAMBAH --}}
    <div onclick="openAddModal(event)" class="flex flex-col items-center group cursor-pointer w-[100px] relative edit-only hidden">
        <div class="relative w-[56px] h-[56px] flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
            <div class="absolute inset-0 rounded-[20px] bg-[#939393] rotate-[11deg] shadow-lg"></div>
            <img src="{{ asset('vector/Tambah.svg') }}" class="relative z-10 w-5 h-5" alt="Tambah">
        </div>
        <span class="mt-5 text-white text-base font-medium text-center leading-tight">Tambah</span>
    </div>
</div>