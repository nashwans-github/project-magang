@extends('layout.admin-layout')

@section('content')
{{-- Load CSS Khusus --}}
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<div class="text-white min-h-screen space-y-8 pb-10">

    {{-- HEADER JUDUL --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl">
        <h1 class="text-[#0554F2] text-4xl font-bold tracking-wide">Berita Instansi</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-500/20 border border-green-500 text-green-400 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- BAGIAN 1: PREVIEW SLIDER --}}
    <div class="bg-[#232226] border-[3px] p-8 border-[#011640] flex flex-col shadow-lg rounded-sm">
        <div class="mx-auto w-full max-w-4xl">
            <div class="h-[350px] bg-[#373737] rounded-t-[20px] mt-1 overflow-hidden relative group border-b border-white/10">
                @if($currentNews && $currentNews->file_path)
                    <img id="preview-image-display" 
                        src="{{ asset('images/' . $currentNews->file_path) }}" 
                        class="w-full h-full object-cover" 
                        alt="Preview Berita">
                    <div id="preview-placeholder" class="absolute inset-0 flex items-center justify-center bg-[#373737] -z-10">
                         <span class="text-white/40">Gambar Tidak Ditemukan</span>
                    </div>
                @else
                    <img id="preview-image-display" src="" class="hidden w-full h-full object-cover">
                    <div id="preview-placeholder" class="w-full h-full flex flex-col items-center justify-center text-white/60 italic">
                        <span class="text-xl">Tambahkan pemberitahuan</span>
                    </div>
                @endif
            </div>

            <div class="flex justify-center items-center gap-4 mt-4">
                @if(!$beritaList->onFirstPage())
                    <a href="{{ $beritaList->previousPageUrl() }}">❮</a>
                @else
                    <span class="w-4"></span> 
                @endif

                <div class="flex gap-2">
                    @for ($i = 1; $i <= $beritaList->lastPage(); $i++)
                        <a href="{{ $beritaList->url($i) }}" 
                           class="w-3 h-3 rounded-full transition-colors duration-300 {{ $i == $beritaList->currentPage() ? 'bg-[#BCB7B7]' : 'bg-[#666666] hover:bg-gray-500' }}">
                        </a>
                    @endfor
                </div>

                @if($beritaList->hasMorePages())
                    <a href="{{ $beritaList->nextPageUrl() }}">❯</a>
                @else
                    <span class="w-4"></span>
                @endif
            </div>
        </div>
    </div>

    {{-- BAGIAN 2: FORM INPUT --}}
    @php
        $isExistingData = ($editBerita && $editBerita->id);
        $initialReadOnly = $isExistingData ? 'readonly' : '';
        $initialDisabled = $isExistingData ? 'disabled' : '';
        $pointerEvents   = $isExistingData ? 'pointer-events-none opacity-60' : '';
        $displayTitle = $isExistingData ? 'Detail Berita' : 'Upload Berita';
        $formAction = $isExistingData ? route('opd.beritainstansi.update', $editBerita->id) : route('opd.beritainstansi.store');
        $valJudul   = $isExistingData ? $editBerita->judul : '';
        $valTanggal = $isExistingData ? $editBerita->tanggal : '';
        $valFile    = $isExistingData ? $editBerita->file_path : '';
    @endphp

    <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data" id="main-form">
        @csrf
        @if($isExistingData) @method('PUT') @endif

        <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl min-h-[400px] mb-6">
            <h2 id="form-title-text" class="text-white text-2xl font-semibold mb-6">{{ $displayTitle }}</h2>

            <div class="space-y-6">
                {{-- Judul --}}
                <div class="space-y-2">
                    <label class="block text-white font-semibold text-lg">Judul Berita</label>
                    <input type="text" name="judul" value="{{ $valJudul }}" id="input-judul"
                           placeholder="Masukkan judul berita" {{ $initialReadOnly }}
                           class="w-full bg-[#FFFFFF]/60 placeholder-black/50 text-black px-4 py-3 rounded-[10px] font-normal focus:outline-none transition-all disabled:bg-gray-500/50 disabled:text-white/50" required>
                </div>

                {{-- Tanggal --}}
                <div class="space-y-2">
                    <label class="block text-white font-semibold text-lg">Tanggal Berita</label>
                    <div class="relative w-[180px]"> 
                        <img src="{{ asset('vector/Kalender.svg') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 z-20 pointer-events-none">
                        <input type="date" name="tanggal" value="{{ $valTanggal }}" id="input-tanggal"
                               {{ $initialReadOnly }}
                               class="custom-date-input w-full bg-[#FFFFFF]/60 text-black placeholder-black/50 pl-10 pr-10 py-3 rounded-[10px] font-normal focus:outline-none transition-all disabled:bg-gray-500/50 disabled:text-white/50 cursor-pointer appearance-none">
                        <img src="{{ asset('vector/Arrow Down.svg') }}" class="absolute right-2 top-1/2 transform -translate-y-1/2 w-7 h-7 z-20 pointer-events-none">
                    </div>
                </div>

                {{-- Upload File --}}
                <div class="space-y-2">
                    <label class="block text-white font-semibold text-lg">Upload File</label>
                    <div class="flex items-center gap-4">
                        <label id="btn-upload-label" for="file_upload" class="cursor-pointer bg-[#0554F2] text-white text-lg px-6 py-2 rounded-[10px] font-semibold flex items-center gap-2 w-fit hover:bg-blue-600 transition shadow-lg {{ $pointerEvents }}">
                            <img src="{{ asset('vector/Upload File.svg') }}" alt="Upload" class="w-5 h-5 object-contain filter brightness-0 invert">
                            Upload File
                        </label>
                        <span id="file-name" class="text-white/60 italic text-sm">
                            {{ $valFile ? 'File saat ini: ' . $valFile : 'Silahkan pilih file' }}
                        </span>
                        <input type="file" id="file_upload" name="file_berita" class="hidden" accept="image/*" onchange="previewImage(this)" {{ $initialDisabled }}>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- TOMBOL AKSI --}}
    <div class="flex justify-between items-center">
        @if($isExistingData)
            <div id="action-group-initial" class="flex justify-between w-full">
                <form action="{{ route('opd.beritainstansi.destroy', $editBerita->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-[#F20509] hover:bg-red-700 transition text-white px-8 py-3 rounded-[10px] font-semibold text-lg shadow-lg">Hapus Berita</button>
                </form>
                <button type="button" onclick="enableEditMode()" class="bg-[#0554F2] hover:bg-blue-600 transition text-white px-8 py-3 rounded-[10px] font-semibold text-lg shadow-lg">Edit Berita</button>
            </div>
            <div id="action-group-save" class="hidden justify-end w-full">
                <button type="submit" form="main-form" class="bg-[#00B55A] hover:bg-green-600 transition text-white px-8 py-3 rounded-[10px] font-semibold text-lg shadow-lg">Simpan Perubahan</button>
            </div>
        @else
            <div></div>
            <button type="submit" form="main-form" class="bg-[#00B55A] hover:bg-green-600 transition text-white px-8 py-3 rounded-[10px] font-semibold text-lg shadow-lg">Publish Berita</button>
        @endif
    </div>
</div>

{{-- Load JS Khusus --}}
<script src="{{ asset('js/admin-opd/berita-instansi.js') }}"></script>
@endsection