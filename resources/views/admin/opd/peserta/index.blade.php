@extends('layout.admin-layout')

@section('title', 'Daftar Peserta - Admin OPD')
@section('header-title', 'Peserta')

@section('content')
<div class="text-white relative">
    <div class="bg-[#232226] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden">
        
        <div class="relative z-10">
            {{-- HEADER TITLE --}}
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <h2 class="text-[#0554F2] text-4xl font-bold tracking-wide">Peserta</h2>
            </div>

            {{-- SEARCH & FILTER --}}
            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto mb-8">
                <div class="relative w-full sm:w-72">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <img src="{{ asset('vector/Search.svg') }}" alt="Search" class="w-4 h-4 object-contain">
                    </span>
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari Nama Peserta..." 
                           class="w-full py-2.5 pl-10 pr-4 rounded-[10px] focus:outline-none bg-white/60 border border-[#B6B6B6] text-black text-base font-medium placeholder-black">
                </div>

                <div class="relative w-full sm:w-auto">
                    <select id="filterBidang" onchange="filterTable()"
                            class="w-full appearance-none py-2.5 pl-4 pr-10 rounded-[10px] focus:outline-none cursor-pointer bg-white/60 border border-[#B6B6B6] text-black text-base font-medium">
                        <option value="">Semua Bidang</option>
                        <option value="Jaringan">Jaringan</option>
                        <option value="Broadband Learning Center">Broadband Learning Center</option>
                        <option value="Website">Website</option>
                        <option value="Sosial Media">Sosial Media</option>
                        <option value="Aplikasi">Aplikasi</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center mt-1 pr-2 pointer-events-none">
                        <img src="{{ asset('vector/Arrow Down.svg') }}" alt="Arrow" class="w-8 h-8 object-contain">
                    </div>
                </div>
            </div>

            {{-- TABLE COMPONENT --}}
            @include('admin.opd.components._table-peserta')

            {{-- Pesan Jika Kosong --}}
            <p id="noResult" class="hidden text-center text-gray-400 py-8 italic">
                Peserta tidak ditemukan.
            </p>
        </div>
    </div>
</div>

@vite(['resources/js/peserta-handler.js'])
@endsection