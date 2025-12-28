@extends('layout.admin-layout')

@section('content')
<div class="text-white relative">
    
    {{-- WRAPPER UTAMA --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl relative h-fit">
        
        {{-- HEADER & SEARCH --}}
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <h1 class="text-[#0554F2] text-4xl font-bold tracking-wide">
                Permintaan Surat Magang
            </h1>

            <div class="relative w-full md:w-[30%]">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                    <img src="{{ asset('vector/Search.svg') }}" alt="Search" class="w-[17px] h-[17px] object-contain">
                </span>
                <input type="text" 
                       id="searchSurat"
                       oninput="filterSurat()"
                       placeholder="Cari Nama Pemohon..." 
                       class="w-full py-2 px-5 pl-11 rounded-[20px] focus:outline-none bg-white/60 border border-[#B6B6B6] text-black text-base font-normal placeholder-black">
            </div>
        </div>

        {{-- LOGIKA SORTING --}}
        @php
            $sortedList = collect($list_surat)->sortBy(function ($item) {
                return ($item['status_pengajuan'] ?? 'pending') === 'selesai' ? 1 : 0;
            });
        @endphp

        {{-- LIST DATA CONTAINER --}}
        <div class="space-y-4" id="suratContainer">
            @forelse($sortedList as $item)
            
            {{-- ITEM CARD --}}
            <div class="surat-item bg-[#2D2D2D] p-5 flex flex-col md:flex-row items-center justify-between transition-all duration-300"
                 data-nama="{{ strtolower($item['nama']) }}">
                
                {{-- Tanggal --}}
                <div class="text-[#9B9B9B] font-medium text-xl w-full md:w-1/6">
                    {{ $item['tanggal'] }}
                </div>

                {{-- Nama & Keterangan --}}
                <div class="flex-1 w-full text-center md:text-left">
                    <h3 class="text-white text-xl font-bold">{{ $item['nama'] }}</h3>
                    <p class="text-white/60 text-[13px]">{{ $item['deskripsi'] }}</p>
                </div>

                {{-- Status & Tombol --}}
                <div class="flex items-center gap-4">
                    @if(isset($item['status_pengajuan']) && $item['status_pengajuan'] == 'selesai')
                        <div class="px-5 py-1.5 rounded-[20px] bg-[#00B55A]">
                            <span class="text-[#FFFFFF] text-base font-semibold">Selesai</span>
                        </div>
                    @endif

                    <a href="{{ route('opd.suratmagang.detail', $item['id']) }}" 
                       class="bg-[#0554F2] text-white px-3 py-2 rounded-[10px] font-medium text-[13px] flex items-center gap-2 transition-all hover:bg-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Lihat Detail
                    </a>
                </div>
            </div>
            @empty
            {{-- TAMPILAN JIKA DATABASE KOSONG --}}
            <div class="text-center py-10 text-lg font-light italic text-gray-400">
                Belum ada data surat magang.
            </div>
            @endforelse
            
            {{-- Pesan Empty State --}}
            <div id="noResultSurat" class="hidden text-center text-white py-10 text-lg font-light italic">
                Nama tidak ditemukan
            </div>
        </div>

    </div>
</div>

{{-- Memanggil Script Extern --}}
@vite(['resources/js/surat-magang-handler.js'])
@endsection