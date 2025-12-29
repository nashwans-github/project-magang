@extends('layout.peserta-layout')

@section('title', 'Progres Pengerjaan')

@section('content')

<h1 class="text-[35px] font-extrabold tracking-wide mb-8 mt-[-20px] opacity-70">
    PROGRES PENGERJAAN
</h1>

{{-- ====== BREADCRUMB ====== --}}
<div class="w-full bg-[#3F3F3F] px-8 py-10">
    <div class="flex items-center gap-6">

        <!-- PROFILE -->
        <div class="flex items-center justify-center text-white font-semibold text-[20px]"
            style="
                background-image: url('/vector/kotakireng.svg');
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;
                width: 220px;
                height: 55px;
            ">
            Profile
        </div>

        <!-- PROGRES -->
        <div class="flex items-center justify-center text-white font-semibold text-[20px] ml-[-70px]"
            style="
                background-image: url('/vector/kotakireng2.svg');
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;
                width: 220px;
                height: 55px;
            ">
            Progres
        </div>
    </div>
</div>

{{-- ====== TABEL KONTAINER ====== --}}
<div class="w-full mt-10 bg-[#3F3F3F] p-10 mt-8">

    {{-- GARIS ATAS --}}
    <div class="w-full h-[1px] bg-white mb-5"></div>

    {{-- HEADER --}}
    <div class="grid text-[18px] font-semibold text-gray-200 pb-5 border-b-2 border-white
            grid-cols-[200px_210px_160px_230px_190px]">
        <p class="text-center">Tanggal/Waktu</p>
        <p class="text-center">Judul</p>
        <p class="text-center">File</p>
        <p class="text-center">Status</p>
        <p class="text-center">Catatan</p>
    </div>

    {{-- ========= ROW 1 ========= --}}
    <div class="border-b border-[#555] bg-black h-[75px]">
        <div class="grid text-[17px] h-full items-center 
                grid-cols-[200px_210px_160px_230px_190px]">

            <p class="text-center">11/09/2025 08:15</p>

            <p class="font-semibold text-center">Merancang ERD</p>

            <div class="flex justify-center">
                <button class="text-white text-sm px-4 py-1 rounded-lg flex items-center gap-2 bg-blue-700">
                    <img src="/vector/documen.svg" class="w-5"> Lihat File
                </button>
            </div>

            <p class="text-center font-semibold text-red-500">Revisi</p>

            <p class="text-center px-3 text-gray-200 line-clamp-2">
                Terdapat revisi untuk tabel anggota, atribut transaksi bisa dihilangkan.
            </p>
        </div>
    </div>

    {{-- ========= ROW 2 ========= --}}
    <div class="border-b border-[#555] h-[75px]">
        <div class="grid text-[17px] h-full items-center
                grid-cols-[200px_210px_160px_230px_190px]">

            <p class="text-center">12/09/2025 08:15</p>

            <p class="font-semibold text-center">Merancang ERD</p>

            <div class="flex justify-center">
                <button class="text-white text-sm px-4 py-1 rounded-lg flex items-center gap-2 bg-blue-700">
                    <img src="/vector/documen.svg" class="w-5"> Lihat File
                </button>
            </div>

            <p class="text-center font-semibold text-green-400">Approved</p>

            <p class="text-center text-gray-400">-</p>
        </div>
    </div>

    {{-- ========= ROW KOSONG ========= --}}
    <div class="border-b border-[#555] bg-black h-[75px]">
        <div class="grid text-[17px] h-full items-center
                grid-cols-[200px_210px_160px_230px_190px]">

            <p class="text-center text-gray-400">--/--/---- --:--</p>
            <p class="text-center text-gray-400">-</p>
            <p class="text-center text-gray-400">-</p>
            <p class="text-center text-gray-400">-</p>
            <p class="text-center text-gray-400">-</p>
        </div>
    </div>

    {{-- GARIS BAWAH --}}
    <div class="w-full h-[2px] bg-white mb-8"></div>


    {{-- TOMBOL TAMBAH --}}
    <div class="flex justify-end ">
        <button class="bg-[#22C55E] hover:bg-[#1ea24f] text-white text-sm px-7 py-1.5 rounded-lg flex items-center gap-2">
            <img src="/vector/plus.svg" class="w-3"> Tambah
        </button>
    </div>

</div>

@endsection