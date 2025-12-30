@extends('layout.admin-layout')

@section('content')
<div class="text-white min-h-screen space-y-6">

    {{-- HEADER JUDUL --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl">
        <h1 class="text-[#0554F2] text-4xl font-bold tracking-wide">
            Permintaan Surat Magang
        </h1>
    </div>

    {{-- CARD PROFIL PESERTA --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl relative">
        <h2 class="text-white text-3xl font-bold mb-6">{{ $peserta['nama'] }}</h2>
        <hr class="border-white pb-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
            {{-- Asal Instansi --}}
            <div class="flex items-start gap-3">
                <img src="{{ asset('vector/Instansi.svg') }}" class="w-7 h-7 object-contain mt-3" alt="Icon">
                <div>
                    <p class="text-white/60 text-base font-semibold mb-1">Asal Instansi</p>
                    <p class="text-white text-xl font-semibold">{{ $peserta['instansi'] }}</p>
                </div>
            </div>

            {{-- Dinas --}}
            <div class="flex items-start gap-3">
                <img src="{{ asset('vector/Dinas.svg') }}" class="w-7 h-7 object-contain mt-3" alt="Icon">
                <div>
                    <p class="text-white/60 text-base font-semibold mb-1">Dinas</p>
                    <p class="text-white text-xl font-semibold">{{ $peserta['dinas'] }}</p>
                </div>
            </div>

            {{-- Jurusan --}}
            <div class="flex items-start gap-3">
                <img src="{{ asset('vector/Jurusan.svg') }}" class="w-7 h-7 object-contain mt-3" alt="Icon">
                <div>
                    <p class="text-white/60 text-base font-semibold mb-1">Jurusan</p>
                    <p class="text-white text-xl font-semibold">{{ $peserta['jurusan'] }}</p>
                </div>
            </div>

            {{-- Bidang --}}
            <div class="flex items-start gap-3">
                <img src="{{ asset('vector/Bidang.svg') }}" class="w-7 h-7 object-contain mt-3" alt="Icon">
                <div>
                    <p class="text-white/60 text-base font-semibold mb-1">Bidang</p>
                    <p class="text-white text-xl font-semibold">{{ $peserta['bidang'] }}</p>
                </div>
            </div>

            {{-- No HP --}}
            <div class="flex items-start gap-3">
                <img src="{{ asset('vector/Telfon.svg') }}" class="w-7 h-7 object-contain mt-3" alt="Icon">
                <div>
                    <p class="text-white/60 text-base font-semibold mb-1">Nomor Handphone</p>
                    <p class="text-white text-xl font-semibold">{{ $peserta['no_telfon'] }}</p>
                </div>
            </div>

            {{-- Periode --}}
            <div class="flex items-start gap-3">
                <img src="{{ asset('vector/Periode Magang.svg') }}" class="w-7 h-7 object-contain mt-3" alt="Icon">
                <div>
                    <p class="text-white/60 text-base font-semibold mb-1">Periode</p>
                    <p class="text-white text-xl font-semibold">{{ $peserta['periode'] }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- CARD DOKUMEN MAGANG --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl mb-8">
        <h3 class="text-white text-2xl font-semibold mb-6">Dokumen Magang</h3>

        <div class="space-y-4">
            @foreach($peserta['dokumen'] as $doc)
            <div class="bg-[#2D2D2D] p-5 rounded-lg flex flex-col md:flex-row items-center justify-between gap-4">
                
                {{-- BAGIAN KIRI: Icon & Info File --}}
                <div class="flex items-center gap-4 w-full">
                    <img src="{{ asset('vector/Surat Magang.svg') }}" 
                         alt="Document Icon" 
                         class="w-10 h-10 object-contain">

                    <div>
                        <p class="text-white/60 text-lg font-medium">{{ $doc['title'] }}</p>
                        
                        @if($doc['status'] == 'uploaded')
                            <a href="#" class="text-[#0554F2] text-[15px] font-semibold">
                                {{ $doc['file'] }}
                            </a>
                        @else
                            <p class="text-[#FBCD35] text-[15px]">Belum ada file yang di upload</p>
                        @endif
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex-shrink-0">
                    @if($doc['status'] == 'uploaded')
                        {{-- Tombol Hapus --}}
                        <button class="bg-[#CC0000] text-white w-[107px] py-2 rounded-[10px] font-medium flex items-center justify-center gap-1">
                            <img src="{{ asset('vector/Hapus Akun.svg') }}" alt="Hapus Icon" class="w-5 h-5 -ml-1">
                            <span>Hapus</span>
                        </button>
                    @else
                        {{-- Tombol Upload --}}
                        <button class="bg-[#0554F2] text-white w-[107px] py-2 rounded-[10px] font-medium flex items-center justify-center gap-1">
                            <img src="{{ asset('vector/Upload.svg') }}" alt="Upload Icon" class="w-5 h-5 -ml-1">
                            <span>Upload</span>
                        </button>
                    @endif
                </div>

            </div>
            @endforeach
        </div>
    </div>

    {{-- TOMBOL SIMPAN --}}
    <div class="mt-8 flex justify-end">
        <button class="bg-[#00B55A] text-white px-8 py-2.5 rounded-[15px] font-bold text-lg shadow-lg flex items-center gap-2">
            Simpan
        </button>
    </div>

</div>
@endsection