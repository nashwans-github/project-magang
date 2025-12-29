@extends('layout.peserta-layout')

@section('title', 'Cetak Surat Magang')

@section('content')

<h1 class="text-[35px] font-extrabold tracking-wide mb-8 mt-[-20px] opacity-70">
    CETAK SURAT MAGANG
</h1>

{{-- ====== BREADCRUMB ====== --}}
<div class="w-full bg-[#3F3F3F] px-8 py-10">
    <div class="flex items-center gap-6">

        <!-- BERANDA -->
        <div class="flex items-center justify-center text-white font-semibold text-[20px]"
            style="
                background-image: url('/vector/kotakireng.svg');
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;
                width: 220px;
                height: 55px;
             ">
            Beranda
        </div>

        <!-- CETAK -->
        <div class="flex items-center justify-center text-white font-semibold text-[20px] ml-[-70px]"
            style="
                background-image: url('/vector/kotakireng2.svg');
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;
                width: 220px;
                height: 55px;
             ">
            Cetak
        </div>

    </div>
</div>


{{-- ====== FORM KONTEN ====== --}}
<div class="w-full bg-[#3F3F3F] p-10 mt-8 mb-8">

    {{-- GARIS ATAS --}}
    <div class="w-full h-[1px] bg-white mb-5"></div>

    {{-- JUDUL --}}
    <div class="flex justify-start">
        <p class="text-white text-2xl leading-none font-semibold ml-5">
            Form pengajuan surat magang
        </p>
    </div>


    {{-- GARIS PEMBATAS --}}
    <div class="w-full h-[1px] bg-white mt-[23px] mb-4"></div>

    {{-- ====== DATA USER (MIRIP TABEL PRESENSI) ====== --}}
    <div class="text-white">

        {{-- ROW: NAMA --}}
        <div class="py-4 bg-[#4A4A4A] border-b border-[#555]">
            <div class="grid items-center text-[17px]"
                style="grid-template-columns: 230px auto;">

                <p class="font-bold pl-4">Nama</p>

                <p class="text-left">
                    Nashwan Bima Andika
                </p>

            </div>
        </div>

        {{-- ROW: PERIODE --}}
        <div class="py-4 bg-[#4A4A4A] mt-2">
            <div class="grid items-center text-[17px]"
                style="grid-template-columns: 230px auto;">

                <p class="font-bold pl-4">Periode Magang</p>

                <p class="text-left">
                    18 Agustus 2025 - 19 Desember 2025
                </p>

            </div>
        </div>

    </div>


    {{-- GARIS PEMBATAS --}}
    <div class="w-full h-[1px] bg-white my-4"></div>


    {{-- ====== TABEL SURAT (FORMAT SAMA KAYA PRESENSI) ====== --}}
    <div class="text-white">

        {{-- HEADER --}}
        <div
            class="grid text-[18px] font-semibold text-gray-200 pb-5 border-b-2 border-white"
            style="grid-template-columns: 260px 270px 280px 230px;">

            <p class="text-center">Surat</p>
            <p class="text-center">Tanggal Pengajuan</p>
            <p class="text-center">Status</p>
            <p class="text-center">Aksi</p>

        </div>

        {{-- ROW 1 --}}
        <div class="py-4 border-b border-[#555]">
            <div class="grid items-center text-[17px]"
                style="grid-template-columns: 260px 270px 280px 230px;">

                <p class="font-semibold pl-4">Surat Diterima Magang</p>

                <p class="text-center">20 Agustus 2025</p>

                <p class="text-green-400 font-semibold text-center">
                    Tersedia
                </p>

                <div class="flex justify-center">
                    <button class="bg-green-500 hover:bg-green-600 text-white px-5 py-1 rounded-lg flex items-center gap-2">
                        <img src="/vector/documen.svg" class="w-4"> Cetak
                    </button>
                </div>

            </div>
        </div>

        {{-- ROW 2 --}}
        <div class="py-4">
            <div class="grid items-center text-[17px]"
                style="grid-template-columns: 260px 270px 280px 230px;">

                <p class="font-semibold pl-4">Surat Selesai Magang</p>

                <p class="text-center">—</p>

                <p class="text-red-400 font-semibold text-center">
                    Belum Tersedia
                </p>

                <div class="flex justify-center">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-1 rounded-lg flex items-center gap-2">
                        <img src="/vector/documen.svg" class="w-4"> Ajukan
                    </button>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection