@extends('layout.admin-layout')

@section('content')
<div class="text-white relative">

    {{-- WRAPPER UTAMA --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-2xl relative">

        <h1 class="text-4xl font-bold text-[#0554F2] mb-8">Verifikasi</h1>

        {{-- 1. CARDS STATISTIK --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            {{-- Card Menunggu --}}
            <div class="relative w-full h-[135px] rounded-[10px] bg-[#A07A00]/45 border border-[#FBCD35] flex justify-between items-center px-6 overflow-hidden transition hover:scale-[1.02]">
                <div class="z-10">
                    <p class="text-base text-[#FFFFFF]/60 font-semibold mb-2 tracking-wide">Menunggu Verifikasi</p>
                    <h3 class="text-[40px] font-semibold text-[#FBCD35] drop-shadow-md">{{ $stats['menunggu'] }}</h3>
                </div>
                <div class="w-16 h-16 rounded-[20px] bg-white/10 flex items-center justify-center backdrop-blur-sm shadow-inner mt-6">
                    <img src="{{ asset('vector/Verifikasi-Menunggu.svg') }}" alt="icon" class="w-11 h-11">
                </div>
            </div>

            {{-- Card Diterima --}}
            <div class="relative w-full h-[135px] rounded-[10px] bg-[#009639]/45 border border-[#00FF5F] flex justify-between items-center px-6 overflow-hidden transition hover:scale-[1.02]">
                <div class="z-10">
                    <p class="text-base text-[#FFFFFF]/60 font-semibold mb-2 tracking-wide">Diterima</p>
                    <h3 class="text-[40px] font-semibold text-[#00FF5F] drop-shadow-md">{{ $stats['diterima'] }}</h3>
                </div>
                <div class="w-16 h-16 rounded-[20px] bg-white/10 flex items-center justify-center backdrop-blur-sm shadow-inner mt-6">
                    <img src="{{ asset('vector/Verifikasi-Diterima.svg') }}" alt="icon" class="w-11 h-11">
                </div>
            </div>

            {{-- Card Ditolak --}}
            <div class="relative w-full h-[135px] rounded-[10px] bg-[#B20000]/45 border border-[#FF0004] flex justify-between items-center px-6 overflow-hidden transition hover:scale-[1.02]">
                <div class="z-10">
                    <p class="text-base text-[#FFFFFF]/60 font-semibold mb-2 tracking-wide">Ditolak</p>
                    <h3 class="text-[40px] font-semibold text-[#FF0000] drop-shadow-md">{{ $stats['ditolak'] }}</h3>
                </div>
                <div class="w-16 h-16 rounded-[20px] bg-white/10 flex items-center justify-center backdrop-blur-sm shadow-inner mt-6">
                    <img src="{{ asset('vector/Verifikasi-Ditolak.svg') }}" alt="icon" class="w-11 h-11">
                </div>
            </div>
        </div>
    
        {{-- 2. BAGIAN DAFTAR PEMOHON --}}
        <h3 class="text-2xl font-semibold text-white mb-6">Daftar Pemohon</h3>

        <div class="flex flex-col md:flex-row gap-4 mb-8">
            {{-- SEARCH BAR --}}
            <div class="relative w-full sm:w-72">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <img src="{{ asset('vector/Search.svg') }}" alt="Search" class="w-4 h-4 object-contain">
                </span>
                <input type="text" id="searchInput" onkeyup="filterVerifikasi()" placeholder="Cari Nama Pemohon..." 
                       class="w-full py-2.5 pl-10 pr-4 rounded-[10px] focus:outline-none bg-white/60 border border-[#B6B6B6] text-black text-base font-medium placeholder-black">
            </div>

            {{-- FILTER STATUS --}}
            <div class="relative w-full sm:w-auto">
                <select id="filterStatus" onchange="filterVerifikasi()"
                class="w-full appearance-none py-2 pl-4 pr-10 rounded-[10px] focus:outline-none cursor-pointer bg-white/60 border border-[#B6B6B6] text-black text-base font-medium">
                    <option value="">Semua</option>
                    <option value="menunggu">Menunggu Verifikasi</option>
                    <option value="diterima">Diterima</option>
                    <option value="ditolak">Ditolak</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center mt-1 pr-2 pointer-events-none">
                    <img src="{{ asset('vector/Arrow Down.svg') }}" alt="Arrow" class="w-8 h-8 object-contain">
                </div>
            </div>
        </div>

        {{-- 3. LIST PESERTA --}}
        <div class="space-y-8" id="verifikasiContainer">
            @forelse($applicants as $item)
            <div class="verifikasi-item bg-[#2D2D2D]/70 rounded-[30px] p-6" 
                data-nama="{{ trim(strtolower($item['nama'])) }}"
                data-status="{{ trim(strtolower($item['status'])) }}">
                 
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-2xl font-semibold text-white">{{ $item['nama'] }}</h2>
                        @php
                            $badgeClass = match($item['status']) {
                                'Menunggu Verifikasi' => 'bg-[#A07A00]/60 text-[#FBCD35] border border-[#B6B6B6]',
                                'Diterima' => 'bg-[#009639]/60 text-[#00FF5F] border border-[#B6B6B6]',
                                'Ditolak'  => 'bg-[#B20000]/60 text-[#FF0000] border border-[#B6B6B6]',
                                default    => 'bg-gray-500/20 text-gray-500'
                            };
                        @endphp
                        <span class="mt-4 inline-flex items-center justify-center w-[201px] h-[33px] rounded-full text-base font-semibold tracking-wider {{ $badgeClass }}">
                            {{ $item['status'] }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 text-base text-white mb-6">
                    <p class="flex"><span class="w-32 inline-block text-[#FFFFFF] font-semibold">Email</span> <span class="text-white text-base font-medium">: {{ $item['email'] }}</span></p>
                    <p class="flex"><span class="w-32 inline-block text-[#FFFFFF] font-semibold">Pendaftaran</span> <span class="text-white text-base font-medium">: {{ $item['tanggal_pendaftaran'] }}</span></p>
                    <p class="flex"><span class="w-32 inline-block text-[#FFFFFF] font-semibold">Instansi</span> <span class="text-white text-base font-medium">: {{ $item['instansi'] }}</span></p>
                    <p class="flex"><span class="w-32 inline-block text-[#FFFFFF] font-semibold">Periode</span> <span class="text-white text-base font-medium">: {{ $item['periode'] }}</span></p>
                    <p class="flex"><span class="w-32 inline-block text-[#FFFFFF] font-semibold">Handphone</span> <span class="text-white text-base font-medium">: {{ $item['no_telfon'] }}</span></p>
                    <p class="flex"><span class="w-32 inline-block text-[#FFFFFF] font-semibold">Anggota</span> <span class="text-white text-base font-medium">: {{ count($item['anggota']) }} Orang</span></p>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('opd.verifikasi.detail', $item['id']) }}" class="bg-[#0554F2] text-white px-6 py-2 rounded-[15px] text-lg font-semibold">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @empty
            <div class="text-center py-10 text-lg font-light italic text-gray-400">
                Belum ada data verifikasi.
            </div>
            @endforelse
            
            <div id="noResult" class="hidden text-center text-white py-10 text-lg font-light italic">
                Nama tidak ditemukan
            </div>
        </div>
    </div> 
</div>

@vite(['resources/js/verifikasi-handler.js'])
@endsection