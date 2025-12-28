@extends('layout.admin-layout')

@section('title', 'Daftar Pembimbing - Admin OPD')
@section('header-title', 'Pembimbing')

@section('content')
    <div class="w-full"> 
        <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-lg h-fit w-full">
            <h1 class="text-4xl font-bold text-[#0554F2] mb-12">Pembimbing</h1>
            
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
                <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                    {{-- SEARCH BAR --}}
                    <div class="relative w-full sm:w-72">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <img src="{{ asset('vector/Search.svg') }}" alt="Search" class="w-4 h-4 object-contain">
                        </span>
                        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari Nama Pembimbing..." 
                               class="w-full py-2 pl-10 pr-4 rounded-[10px] focus:outline-none bg-white/60 border border-[#B6B6B6] text-black text-base font-medium placeholder-black">
                    </div>

                    {{-- FILTER DROPDOWN --}}
                    <div class="relative w-full sm:w-auto">
                        <select id="filterBidang" onchange="filterTable()"
                                class="w-full appearance-none py-2 pl-4 pr-10 rounded-[10px] focus:outline-none cursor-pointer bg-white/60 border border-[#B6B6B6] text-black text-base font-medium">
                            <option value="">Semua Bidang</option>
                            <option value="Jaringan">Jaringan</option>
                            <option value="Broadband Learning Center">Broadband Learning Center</option>
                            <option value="Website">Website</option>
                            <option value="Sosial Media">Sosial Media</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center mt-1 pr-2 pointer-events-none">
                            <img src="{{ asset('vector/Arrow Down.svg') }}" alt="Arrow" class="w-8 h-8 object-contain">
                        </div>
                    </div>
                </div>

                {{-- TOMBOL TAMBAH --}}
                <a href="{{ route('opd.pembimbing.create') }}" class="w-full md:w-auto bg-[#0554F2] text-white font-medium py-2 px-4 rounded-[10px] flex justify-center items-center gap-2.5 transition shadow-md hover:scale-105">
                    <img src="{{ asset('vector/Tambah.svg') }}" alt="Tambah" class="w-3 h-3 object-contain">
                    Tambah Akun
                </a>
            </div>

            {{-- TABLE PARTIAL --}}
            @include('admin.opd.components._table-pembimbing')

        </div>
    </div>

    {{-- Load JS --}}
@vite(['resources/js/pembimbing-handler.js'])
@endsection