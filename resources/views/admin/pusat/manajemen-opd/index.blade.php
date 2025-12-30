@extends('layout.admin-layout')

@section('title', 'Manajemen OPD - Admin Pusat')
@section('header-title', 'Manajemen OPD')

@section('content')

{{-- CONTAINER UTAMA --}}
<div class="bg-[#262626] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden rounded-sm min-h-[600px]">

    {{-- BACKGROUND GRADIENT --}}
    <div class="absolute inset-0 bg-gradient-to-br from-[#262626] via-[#2a2a2a] to-[#202020] opacity-50 pointer-events-none"></div>

    <div class="relative z-10">

        {{-- JUDUL HALAMAN --}}
        <div class="mb-8">
            <h2 class="text-[#0066FF] text-3xl font-bold tracking-wide mb-4">
                Manajemen OPD
            </h2>
            <div class="w-full border-b border-white/70"></div>
        </div>

        {{-- TOOLBAR: TOMBOL TAMBAH & SEARCH --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">

            {{-- 1. TOMBOL TAMBAH OPD (Kiri) --}}
            <a href="{{ route('pusat.manajemen-opd.create') }}" 
               class="flex items-center gap-2 bg-[#0066FF] hover:bg-blue-600 text-white px-6 py-2.5 rounded-[10px] font-medium transition-colors shadow-lg group">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah OPD
            </a>

            {{-- 2. SEARCH BAR (Kanan) --}}
            {{-- Menggunakan Component Search Bar --}}
            <div class="w-full md:w-auto">
                @include('admin.pusat.components.search-bar', [
                    'url' => route('pusat.manajemen-opd.index'),
                    'placeholder' => 'Cari Nama Dinas...'
                ])
            </div>

        </div>

        {{-- GRID KARTU OPD --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 auto-rows-fr">
            
            {{-- LOOPING DATA INSTANSI --}}
            @forelse($opd_list as $opd)
                <div class="bg-[#333333] border border-white/5 p-6 rounded-xl hover:bg-[#3a3a3a] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group relative overflow-hidden flex flex-col h-full">
                    
                    {{-- Judul Dinas --}}
                    <div class="min-h-[60px]">
                        <h3 class="text-white text-lg font-semibold mb-1 leading-tight group-hover:text-[#0066FF] transition-colors line-clamp-2">
                            {{ $opd['nama'] ?? $opd['name'] }}
                        </h3>
                    </div>

                    {{-- Singkatan --}}
                    <p class="text-gray-400 text-base uppercase font-medium">
                        {{ $opd['singkatan'] ?? '-' }}
                    </p>

                    <hr class="border-white/50 my-4">

                    {{-- Statistik Kecil --}}
                    <div class="grid grid-cols-2 gap-3 mb-6">
                        {{-- Badge Pembimbing --}}
                        <div class="bg-[#1E3162] py-2.5 rounded-2xl flex flex-row items-center justify-center gap-1.5">
                            <span class="text-[#93C5E4] font-medium text-sm">{{ $opd['jumlah_pembimbing'] ?? 0 }}</span>
                            <span class="text-[#93C5E4] text-sm font-medium">Pembimbing</span>
                        </div>
                        {{-- Badge Peserta --}}
                        <div class="bg-[#264D36] py-2.5 rounded-2xl flex flex-row items-center justify-center gap-1.5">
                            <span class="text-[#4EFD68] font-medium text-sm">{{ $opd['jumlah_peserta'] ?? 0 }}</span>
                            <span class="text-[#4EFD68] text-sm font-medium">Peserta</span>
                        </div>
                    </div>

                    {{-- Tombol Detail --}}
                    <a href="{{ route('pusat.manajemen-opd.detail', $opd['slug']) }}" 
                       class="mt-auto block w-full text-center py-2.5 rounded-[10px] bg-[#0900FF]/50 text-white font-semibold text-sm hover:bg-[#0900FF]/70 transition-all border border-[#0900FF]/30">
                        Lihat Detail
                    </a>

                </div>
            @empty
                {{-- TAMPILAN JIKA DATA KOSONG --}}
                <div class="col-span-full py-12 text-center">
                    <div class="bg-[#333]/50 rounded-lg p-8 inline-block">
                        <svg class="w-12 h-12 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <p class="text-gray-400 text-lg">Data OPD tidak ditemukan.</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION COMPONENT (Sudah Modular) --}}
        <div class="mt-4">
            {{-- Kita kirim data $opd_list sebagai variabel 'paginator' ke dalam komponen --}}
            @include('admin.pusat.components.pagination', ['paginator' => $opd_list])
        </div>
        
        {{-- MODAL SUKSES --}}
        @if(session('success'))
            <div id="success-modal" class="fixed inset-0 z-[999] flex items-start justify-center pt-20 bg-black/60 backdrop-blur-sm transition-opacity duration-300">
                <div class="bg-black border-2 border-[#0066FF]/30 rounded-xl p-8 w-[400px] text-center shadow-2xl transform scale-100 transition-transform duration-300">
                    <div class="mx-auto w-20 h-20 bg-[#0066FF] rounded-full flex items-center justify-center mb-6 shadow-[0_0_20px_rgba(0,102,255,0.6)]">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-[#0066FF] text-3xl font-bold mb-2">Berhasil!</h3>
                    <p class="text-white text-lg font-medium mb-8">{{ session('success') }}</p>
                    <button onclick="document.getElementById('success-modal').style.display='none'" class="bg-[#8F8F8F] hover:bg-gray-500 text-white font-bold py-2 px-10 rounded-lg text-lg transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        @endif

    </div>
</div>

@endsection