@extends('layout.admin-layout')

@section('content')
<div class="text-white min-h-screen">

    {{-- HEADER JUDUL --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl mb-8">
        <h1 class="text-[#0554F2] text-4xl font-bold tracking-wide">
            Peserta
        </h1>
    </div>

    {{-- WRAPPER UTAMA --}}
    <div class="space-y-6">

        {{-- 1. CARD PROFIL UTAMA --}}
        <div class="bg-[#232226] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-white text-3xl font-bold mb-6 -mt-2">{{ $peserta['nama'] }}</h2>
                <hr class="border-white mb-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
                    {{-- Asal Instansi --}}
                    <div class="flex items-start gap-4">
                        <div class="mt-1">
                            <img src="{{ asset('vector/Instansi.svg') }}" alt="Icon Instansi" class="w-8 h-8 object-contain">
                        </div>
                        <div>
                            <p class="text-white/60 text-base font-semibold">Asal Instansi</p>
                            <p class="text-white text-xl font-semibold">{{ $peserta['asal_instansi'] }}</p>
                        </div>
                    </div>

                    {{-- Dinas --}}
                    <div class="flex items-start gap-4">
                        <div class="mt-1">
                            <img src="{{ asset('vector/Dinas.svg') }}" alt="Icon Dinas" class="w-8 h-8 object-contain">
                        </div>
                        <div>
                            <p class="text-white/60 text-base font-semibold">Dinas</p>
                            <p class="text-white text-xl font-semibold">{{ $peserta['instansi_slug'] }}</p>
                        </div>
                    </div>

                    {{-- Jurusan --}}
                    <div class="flex items-start gap-4">
                        <div class="mt-1">
                            <img src="{{ asset('vector/Jurusan.svg') }}" alt="Icon Jurusan" class="w-8 h-8 object-contain">
                        </div>
                        <div>
                            <p class="text-white/60 text-base font-semibold">Jurusan</p>
                            <p class="text-white text-xl font-semibold">{{ $peserta['jurusan'] }}</p>
                        </div>
                    </div>

                    {{-- Bidang --}}
                    <div class="flex items-start gap-4">
                        <div class="mt-1">
                            <img src="{{ asset('vector/Bidang.svg') }}" alt="Icon Bidang" class="w-8 h-8 object-contain">
                        </div>
                        <div>
                            <p class="text-white/60 text-base font-semibold">Bidang</p>
                            <p class="text-white text-xl font-semibold">{{ $peserta['bidang'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. GRID INFORMASI (PRIBADI & MAGANG) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            {{-- Informasi Pribadi --}}
            <div class="bg-[#232226] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden">
                <div class="flex items-center gap-3 mb-6">
                    <img src="{{ asset('vector/Informasi Pribadi.svg') }}" alt="Icon User" class="w-8 h-8 object-contain">
                    <h3 class="text-white text-2xl font-semibold">Informasi Pribadi</h3>
                </div>

                <div class="space-y-4">
                    <div class="bg-[#2D2D2D] p-4 rounded-[10px] flex items-center gap-4">
                        <img src="{{ asset('vector/Email.svg') }}" alt="Icon Email" class="w-[34px] h-[34px] object-contain">
                        <div>
                            <p class="text-white/60 text-base font-semibold">Email</p>
                            <p class="text-white text-xl font-semibold">{{ $peserta['email'] }}</p>
                        </div>
                    </div>
                    <div class="bg-[#2D2D2D] p-4 rounded-[10px] flex items-center gap-4">
                        <img src="{{ asset('vector/Telfon.svg') }}" alt="Icon Phone" class="w-[34px] h-[34px] object-contain">
                        <div>
                            <p class="text-white/60 text-base font-semibold">Nomor Telepon</p>
                            <p class="text-white text-xl font-semibold">{{ $peserta['no_telp'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Informasi Magang --}}
            <div class="bg-[#232226] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden">
                <div class="flex items-center gap-3 mb-6">
                    <img src="{{ asset('vector/Informasi Magang.svg') }}" alt="Icon Magang" class="w-8 h-8 object-contain">
                    <h3 class="text-white text-xl font-bold">Informasi Magang</h3>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-[#2D2D2D] p-4 rounded-[10px]">
                        <p class="text-white/60 text-base font-semibold mb-1">Tanggal Mulai</p>
                        <p class="text-white text-xl font-semibold">{{ $peserta['tgl_mulai'] }}</p>
                    </div>
                    <div class="bg-[#2D2D2D] p-4 rounded-[10px]">
                        <p class="text-white/60 text-base font-semibold mb-1">Tanggal Selesai</p>
                        <p class="text-white text-xl font-semibold">{{ $peserta['tgl_selesai'] }}</p>
                    </div>
                </div>

                <div class="bg-[#2D2D2D] p-4 rounded-[10px] flex items-center gap-3">
                    <img src="{{ asset('vector/Status.svg') }}" alt="Status Icon" class="w-9 h-9 object-contain">
                    <div class="flex flex-col items-start gap-1">
                        <p class="text-white/60 text-base font-semibold leading-tight">Status Magang</p>
                        <span class="w-full text-center bg-[#009639]/45 text-[#00FF5F] py-1 rounded-full text-[13px] font-semibold mt-1 block uppercase">
                            {{ $peserta['status_keaktifan'] }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. PROGRES DAN PENILAIAN --}}
        <div class="bg-[#232226] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden">
            <div class="flex items-center gap-3 mb-6">
                <img src="{{ asset('vector/Progress.svg') }}" alt="Icon Chart" class="w-8 h-8 object-contain">
                <h3 class="text-white text-2xl font-semibold">Progres dan Penilaian</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Kehadiran --}}
                <div class="bg-[#225CE4]/60 border border-[#00B7FF] rounded-[10px] p-6 shadow-lg hover:scale-105 transition-transform duration-300">
                    <p class="text-white/60 font-semibold text-base mb-2 -mt-2 tracking-wide">Kehadiran</p>
                    <p class="text-[#00B7FF] text-[40px] font-bold">{{ $peserta['attendance'] }}</p>
                </div>

                {{-- Progres --}}
                <div class="bg-[#159645]/40 border border-[#26FF00] rounded-[10px] p-6 shadow-lg hover:scale-105 transition-transform duration-300">
                    <p class="text-white/60 font-semibold text-base mb-2 -mt-2 tracking-wide">Progres Selesai</p>
                    <p class="text-[#26FF00] text-[40px] font-bold">{{ $peserta['progress_count'] }}</p>
                </div>

                {{-- Nilai --}}
                <div class="bg-[#8B2DE0]/60 border border-[#A971FE] rounded-[10px] p-6 shadow-lg hover:scale-105 transition-transform duration-300">
                    <p class="text-white/60 font-semibold text-base mb-2 -mt-2 tracking-wide">Nilai Rata-Rata</p>
                    <p class="text-[#A971FE] text-[40px] font-bold">{{ $peserta['average_score'] }}</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection