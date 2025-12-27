@extends('layout.admin-layout')

{{-- Judul Halaman Dinamis --}}
@section('title', 'Detail Peserta - ' . $peserta['nama'])
@section('header-title', 'Detail Peserta')

@section('content')

    {{-- HEADER JUDUL --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl mb-8 rounded-sm">
        <h1 class="text-[#0066FF] text-3xl font-bold tracking-wide">
            Detail Peserta
        </h1>
    </div>

    {{-- WRAPPER UTAMA --}}
    <div class="space-y-6">

        {{-- 1. CARD PROFIL UTAMA --}}
        <div class="bg-[#262626] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden mt-6 rounded-sm">
            <div class="absolute inset-0 bg-gradient-to-br from-[#262626] via-[#2a2a2a] to-[#202020] opacity-50 pointer-events-none"></div>
            
            <div class="relative z-10">
                <h2 class="text-white text-3xl font-bold mb-6">{{ $peserta['nama'] }}</h2>
                <hr class="border-white/20 mb-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
                    {{-- Asal Instansi --}}
                    <div class="flex items-start gap-4">
                        <div class="text-[#0066FF] mt-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Asal Instansi</p>
                            <p class="text-white font-semibold">{{ $peserta['asal_instansi'] ?? 'Universitas/Sekolah Terdaftar' }}</p>
                        </div>
                    </div>

                    {{-- Dinas --}}
                    <div class="flex items-start gap-4">
                        <div class="text-[#0066FF] mt-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Dinas</p>
                            <p class="text-white font-semibold">{{ $namaDinas }}</p>
                        </div>
                    </div>

                    {{-- Jurusan --}}
                    <div class="flex items-start gap-4">
                        <div class="text-[#0066FF] mt-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Jurusan</p>
                            <p class="text-white font-semibold">{{ $peserta['jurusan'] }}</p>
                        </div>
                    </div>

                    {{-- Bidang --}}
                    <div class="flex items-start gap-4">
                        <div class="text-[#0066FF] mt-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Bidang</p>
                            <p class="text-white font-semibold">{{ $peserta['bidang'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. GRID INFORMASI --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            {{-- Info Pribadi --}}
            <div class="bg-[#262626] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden rounded-sm">
                <div class="flex items-center gap-3 mb-6">
                    <svg class="w-6 h-6 text-[#0066FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <h3 class="text-white text-xl font-bold">Informasi Pribadi</h3>
                </div>

                <div class="space-y-4">
                    <div class="bg-[#333] p-4 rounded-lg flex items-center gap-4 border border-white/5">
                        <svg class="w-6 h-6 text-[#0066FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Email</p>
                            <p class="text-white font-medium">{{ $peserta['email'] }}</p>
                        </div>
                    </div>
                    <div class="bg-[#333] p-4 rounded-lg flex items-center gap-4 border border-white/5">
                        <svg class="w-6 h-6 text-[#0066FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Nomor Telepon</p>
                            <p class="text-white font-medium">{{ $peserta['no_telp'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Info Magang --}}
            <div class="bg-[#262626] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden rounded-sm">
                <div class="flex items-center gap-3 mb-6">
                    <svg class="w-6 h-6 text-[#0066FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <h3 class="text-white text-xl font-bold">Informasi Magang</h3>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-[#333] p-4 rounded-lg border border-white/5">
                        <p class="text-gray-400 text-sm font-medium mb-1">Tanggal Mulai</p>
                        <p class="text-white font-medium">
                            {{ isset($peserta['tgl_mulai']) ? \Carbon\Carbon::parse($peserta['tgl_mulai'])->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>
                    <div class="bg-[#333] p-4 rounded-lg border border-white/5">
                        <p class="text-gray-400 text-sm font-medium mb-1">Tanggal Selesai</p>
                        <p class="text-white font-medium">
                            {{ isset($peserta['tgl_selesai']) ? \Carbon\Carbon::parse($peserta['tgl_selesai'])->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>
                </div>

                <div class="bg-[#333] p-4 rounded-lg flex items-center gap-4 border border-white/5">
                    <div class="w-8 h-8 rounded-full border-2 border-[#0066FF] flex items-center justify-center text-[#0066FF] font-bold text-lg">
                        ✓
                    </div>

                    <div class="flex flex-col items-start gap-1">
                        <p class="text-gray-400 text-sm font-semibold leading-tight">
                            Status Magang
                        </p>

                        @php
                            // Ambil status (default Nonaktif)
                            $status = $peserta['status_keaktifan'] ?? 'Nonaktif';

                            // Tentukan Warna
                            if ($status === 'Aktif') {
                                $badgeClass = 'bg-[#159645]/40 text-[#26FF00] border border-[#26FF00]/30';
                            } else {
                                $badgeClass = 'bg-[#B20000]/40 text-[#FF0000] border border-[#FF0000]/30';
                            }
                        @endphp

                        <span class="{{ $badgeClass }} px-6 py-1 rounded-full text-sm font-bold mt-1 inline-block tracking-wider">
                            {{ $status }}
                        </span>
                    </div>
                </div>
            </div>

        </div>

        {{-- 3. PROGRES DAN PENILAIAN --}}
        <div class="bg-[#262626] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden rounded-sm">
            
            <div class="flex items-center gap-3 mb-6">
                <svg class="w-6 h-6 text-[#0066FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"/></svg>
                <h3 class="text-white text-xl font-bold">Progres dan Penilaian</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- Kehadiran --}}
                <div class="bg-[#225CE4]/40 border border-[#00B7FF] rounded-xl p-6 shadow-lg hover:scale-105 transition-transform duration-300">
                    <p class="text-white font-semibold text-sm mb-2 tracking-wide">Kehadiran</p>
                    <p class="text-[#00B7FF] text-4xl font-bold">{{ $persentaseKehadiran }}%</p>
                </div>

                {{-- Progres --}}
                <div class="bg-[#159645]/40 border border-[#26FF00] rounded-xl p-6 shadow-lg hover:scale-105 transition-transform duration-300">
                    <p class="text-white font-semibold text-sm mb-2 tracking-wide">Progres Selesai</p>
                    <p class="text-[#26FF00] text-4xl font-bold">{{ $progresSelesai }}</p>
                </div>

                {{-- Nilai --}}
                <div class="bg-[#501288]/40 border border-[#6600FF] rounded-xl p-6 shadow-lg hover:scale-105 transition-transform duration-300">
                    <p class="text-white font-semibold text-sm mb-2 tracking-wide">Nilai Rata-Rata</p>
                    <p class="text-[#6600FF] text-4xl font-bold">{{ $nilaiRataRata }}</p>
                </div>

            </div>
        </div>

    </div>

@endsection