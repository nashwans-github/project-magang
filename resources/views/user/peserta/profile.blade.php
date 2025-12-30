@extends('layout.peserta-layout')

@section('title', 'Dashboard Peserta')

@section('content')

<!-- TITLE -->
<h1 class="text-[35px] font-extrabold tracking-wide mb-[25px] mt-[-20px] opacity-70">PROFILE</h1>

<div class="flex flex-col lg:flex-row justify-between gap-14">

    <!-- ===================== -->
    <!--        LEFT SIDE      -->
    <!-- ===================== -->
    <div class="flex-1">

        <!-- PROFILE ROW -->
        <div class="flex items-center gap-10 font-poppins">
            <img src="/vector/user.svg" class="w-28 h-28 bg-[#4c4c4c] shadow-lg">

            <div class="mt-5">
                <div>
                    <h2 class="text-[25px] font-bold">Nashwan Bima Andika</h2>
                    <!-- Tambah margin-top di sini -->
                    <p class="text-[15px] font-normal mt-0.5">
                        peserta01@gmail.com
                    </p>
                </div>
            </div>

        </div>

        <!-- INFO -->
        <div class="mt-10 mb-[-10px] grid grid-cols-1 sm:grid-cols-2 gap-y-5 gap-x-10 text-[16px] text-gray-300 font-poppins">

            <!-- KOLOM KIRI -->
            <div class="space-y-4">

                <!-- Instansi -->
                <div class="flex items-center gap-4">
                    <img src="/vector/kampus.svg" class="w-6 opacity-80">
                    <span>Universitas Negeri Surabaya</span>
                </div>

                <!-- Telepon -->
                <div class="flex items-center gap-4">
                    <img src="/vector/telp.svg" class="w-6 opacity-80">
                    <span>08155142348</span>
                </div>

            </div>

            <!-- KOLOM KANAN -->
            <div class="space-y-4">

                <!-- Bidang -->
                <div class="flex items-center gap-4">
                    <img src="/vector/bidang.svg" class="w-6 opacity-80">
                    <span>Website</span>
                </div>

                <!-- Status -->
                <div class="flex items-center gap-4">
                    <img src="/vector/status.svg" class="w-6 opacity-80">
                    <img src="/vector/aktif.svg" class="h-6 object-contain">
                </div>

            </div>

        </div>


        <!-- LINE -->
        <div class="w-full h-[1px] bg-white my-10 opacity-70"></div>

        <!-- ===================== -->
        <!--       STATISTICS      -->
        <!-- ===================== -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 text-center mb-[-15px]">

            <!-- Presensi -->
            <div class="flex flex-col items-center">
                <div class="relative w-44 h-44 rounded-full flex justify-center items-center"
                    style="
                background:#3B3205;
                box-shadow:0 0 30px rgba(165,159,93,0.7);
                border:2px solid white;
             ">
                    <h1 class="text-[32px] font-extrabold text-white">33.33%</h1>
                </div>
                <p class="text-sm text-gray-200 mt-5">Presensi Kehadiran</p>
            </div>

            <!-- Progres -->
            <div class=" flex flex-col items-center">
                <div class="relative w-44 h-44 rounded-full flex justify-center items-center"
                    style="
                background:#05393B;
                box-shadow:0 0 30px rgba(10,96,96,0.7);
                border:2px solid white;
             ">
                    <h1 class="text-[32px] font-extrabold text-white">1</h1>
                </div>
                <p class="text-sm text-gray-200 mt-5">Progres Selesai</p>
            </div>

            <!-- Nilai -->
            <div class="flex flex-col items-center">
                <div class="relative w-44 h-44 rounded-full flex justify-center items-center"
                    style="
                background:#36053B;
                box-shadow:0 0 30px rgba(107,26,109,0.7);
                border:2px solid white;
             ">
                    <h1 class="text-[32px] font-extrabold text-white">3.2</h1>
                </div>
                <p class="text-sm text-gray-200 mt-5">Rata - Rata Nilai</p>
            </div>

        </div>

        <!-- LINE -->
        <div class="w-full h-[1px] bg-white my-12 opacity-70"></div>

        <!-- ===================== -->
        <!-- TANGGAL MULAI/SELESAI -->
        <!-- ===================== -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-[-20px]">

            <div>
                <p class="text-gray-300 text-[17px] font-semibold">Tanggal Mulai</p>
                <div class="bg-[#222] px-4 py-3 rounded-lg mt-2 text-gray-200 text-[15px]">
                    18/08/2025
                </div>
            </div>

            <div>
                <p class="text-gray-300 text-[17px] font-semibold">Tanggal Selesai</p>
                <div class="bg-[#222] px-4 py-3 rounded-lg mt-2 text-gray-200 text-[15px]">
                    19/12/2025
                </div>
            </div>

        </div>
    </div>

    <!-- ===================== -->
    <!--  RIGHT IMAGE SLIDER   -->
    <!-- ===================== -->

    <div
        x-data="{
        current: 0,
        images: ['/vector/w1.svg', '/vector/w2.svg', '/vector/w3.svg'],
        init() {
            setInterval(() => {
                this.current = (this.current + 1) % this.images.length
            }, 3000)
        }
    }">

        <!-- WRAPPER GAMBAR DENGAN EFEK AWAN HITAM -->
        <div class="relative w-[500px] h-[620px] -mt-12 overflow-hidden">

            <!-- Lapisan efek kabut gelap SUPER KUAT -->
            <div class="absolute inset-0 z-[5] pointer-events-none"
                style="
            background:
                radial-gradient(
                    circle at center,
                    rgba(0, 0, 0, 0) 35%,
                    rgba(0, 0, 0, 0.85) 70%,
                    rgba(0, 0, 0, 1) 100%
                );
            mix-blend-mode: multiply;
        ">
            </div>

            <!-- BAYANGAN KABUT DI LUAR GAMBAR -->
            <div class="absolute inset-0 z-[4] pointer-events-none shadow-[0_0_120px_80px_rgba(0,0,0,1)]"></div>

            <!-- Slides -->
            <template x-for="(img, index) in images" :key="index">
                <img
                    :src="img"
                    class="absolute top-0 left-0 w-full h-full object-cover transition-opacity duration-700 z-[1]"
                    :class="current === index ? 'opacity-100' : 'opacity-0'">
            </template>

        </div>

        <!-- DOTS -->
        <div class="flex justify-center gap-3 mt-10">
            <template x-for="(dot, i) in images" :key="i">
                <div
                    @click="current = i"
                    class="w-3 h-3 rounded-full cursor-pointer transition-all duration-300"
                    :class="current === i ? 'bg-white scale-125' : 'bg-gray-500'">
                </div>
            </template>
        </div>

    </div>

    @endsection