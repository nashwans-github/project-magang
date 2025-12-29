@extends('layout.peserta-layout')

@section('title', 'Presensi Kehadiran')

@section('content')

<h1 class="text-[35px] font-extrabold tracking-wide mb-8 mt-[-20px] opacity-70">
    PRESENSI KEHADIRAN
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

        <!-- ABSENSI -->
        <div class="flex items-center justify-center text-white font-semibold text-[20px] ml-[-70px]"
            style="
                background-image: url('/vector/kotakireng2.svg');
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;
                width: 220px;     
                height: 55px;     
             ">
            Absensi
        </div>

    </div>
</div>


{{-- ====== TABEL KONTAINER ====== --}}
<div class="w-full bg-[#3F3F3F] p-10 mt-8">

    {{-- HEADER GARIS ATAS --}}
    <div class="w-full h-[1px] bg-white mb-5"></div>

    {{-- HEADER TABEL --}}
    <div
        class="grid text-[18px] font-semibold text-gray-200 pb-5 border-b-2 border-white"
        style="grid-template-columns: 230px 260px 150px 210px 150px;">

        <p></p> {{-- Kosong untuk kolom Hari Ke --}}
        <p class="text-center">Tanggal/Waktu</p>
        <p class="text-center">Kehadiran</p>
        <p class="text-center">Bukti</p>
        <p class="text-right pr-4">Keterangan</p>
    </div>


    {{-- ===================== ROW 1 ===================== --}}
    <div class="py-5 border-b border-[#555] bg-black">
        <div class="grid items-center text-[17px]"
            style="grid-template-columns: 230px 260px 150px 210px 150px;">

            <p class="font-bold pl-4">
                Hari ke - <span class="font-normal ml-2">1</span>
            </p>

            <p class="text-center">11/09/2025 08:15</p>

            <p class="text-green-400 font-semibold text-center">Hadir</p>

            <div class="flex justify-center">
                <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-1 rounded-lg flex items-center gap-2">
                    <img src="/vector/documen.svg" class="w-5"> Lihat Bukti
                </button>
            </div>

            <p class="text-right pr-4"></p>
        </div>
    </div>


    {{-- ===================== ROW 2 ===================== --}}
    <div class="py-5 border-b border-[#555]">
        <div class="grid items-center text-[17px]"
            style="grid-template-columns: 230px 260px 150px 210px 150px;">

            <p class="font-bold pl-4">
                Hari ke - <span class="font-normal ml-2">2</span>
            </p>

            <p class="text-center">12/09/2025 08:15</p>

            <p class="text-yellow-300 font-semibold text-center">Izin</p>

            <div class="flex justify-center">
                <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-1 rounded-lg flex items-center gap-2">
                    <img src="/vector/documen.svg" class="w-5"> Lihat Bukti
                </button>
            </div>

            <p class="text-right pr-4 text-gray-200">Penak Bubuk</p>
        </div>
    </div>


    {{-- ===================== ROW 3 (GANJIL) ===================== --}}
    <div class="py-5 border-b border-[#555] bg-black">
        <div class="grid items-center text-[17px]"
            style="grid-template-columns: 230px 260px 150px 210px 150px;">

            <p class="font-bold pl-4">
                Hari ke - <span class="font-normal ml-2">3</span>
            </p>

            <p class="text-center text-gray-400">--/--/---- --:--</p>

            <!-- Submit di kolom Kehadiran -->
            <a href="#" class="text-blue-400 underline hover:text-blue-300 text-center">
                Submit
            </a>

            <div class="flex justify-center">
                <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-7 py-1 rounded-lg flex items-center gap-2">
                    <img src="/vector/plus.svg" class="w-3"> Tambah
                </button>
            </div>

            <!-- Submit di kolom Keterangan (sama seperti di Kehadiran) -->
            <p class="text-right pr-9">
                <a href="#" class="text-blue-400 underline hover:text-blue-300">
                    Submit
                </a>
            </p>
        </div>
    </div>


    {{-- GARIS BAWAH --}}
    <div class="w-full h-[1px] bg-white mb-5"></div>

    {{-- ====== SUMMARY ====== --}}
    <div class="text-white text-[17px] leading-[30px]">
        <p>Jumlah Kehadiran : <strong>1/3</strong></p>
        <p>Presentase Kehadiran : <strong>33,3%</strong></p>
    </div>

</div>

@endsection