@extends('layout.admin-layout')

@section('title', 'Pendaftar Magang - Admin Pusat')
@section('header-title', 'Pendaftar')

@section('content')

{{-- CONTAINER UTAMA --}}
<div class="bg-[#262626] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden rounded-sm min-h-[600px]">

    {{-- Background Gradient --}}
    <div class="absolute inset-0 bg-gradient-to-br from-[#262626] via-[#2a2a2a] to-[#202020] opacity-50 pointer-events-none"></div>

    <div class="relative z-10">

        {{-- JUDUL HALAMAN --}}
        <div class="mb-8">
            <h2 class="text-[#0066FF] text-3xl font-bold tracking-wide mb-4">
                Pendaftar Magang
            </h2>
            <div class="w-full border-b border-white/70"></div>
        </div>

        {{-- TOOLBAR: Search & Filter --}}
        {{-- Kita gunakan Flexbox untuk menata komponen Search dan Date Filter --}}
        <div class="flex flex-col md:flex-row justify-between items-end md:items-center mb-6 gap-4">

            {{-- BAGIAN KIRI: Form Pencarian & Filter Tanggal --}}
            <div class="flex flex-col md:flex-row items-start md:items-center gap-4 w-full md:w-auto">
                
                {{-- 1. SEARCH BAR COMPONENT --}}
                @include('admin.pusat.components.search-bar', [
                    'url' => route('pusat.pendaftar.index'),
                    'placeholder' => 'Cari Nama Pendaftar...'
                ])

                {{-- 2. DATE FILTER COMPONENT --}}
                @include('admin.pusat.components.date-filter', [
                    'url' => route('pusat.pendaftar.index')
                ])

            </div>

            {{-- BAGIAN KANAN: Kosong (Pagination dipindah ke bawah agar rapi) --}}

        </div>

        {{-- TABEL DATA --}}
        <div class="overflow-hidden border border-white/5 rounded-lg">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#333]/30">
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[20%] pl-6">Tanggal/Waktu</th>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[25%]">Nama Pendaftar</th>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[25%]">Email</th>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[15%]">No. Telp</th>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[15%] text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-white text-base">
                    @forelse($pendaftar as $item)
                        <tr class="group border-b border-white/5 transition-all duration-300 hover:bg-[#333] hover:scale-[1.002] hover:shadow-xl relative hover:z-10">
                            
                            {{-- Tanggal/Waktu --}}
                            <td class="py-5 border-b border-white/10 text-gray-300 pl-6">
                                {{ \Carbon\Carbon::parse($item['tanggal'])->format('d/m/Y') }}
                                <span class="text-gray-400 text-sm ml-1 block md:inline">{{ $item['waktu'] }}</span>
                            </td>

                            {{-- Nama --}}
                            <td class="py-5 border-b border-white/10 font-medium text-white/90">
                                {{ $item['nama'] }}
                            </td>

                            {{-- Email --}}
                            <td class="py-5 border-b border-white/10 text-gray-300">
                                {{ $item['email'] }}
                            </td>

                            {{-- No Telp --}}
                            <td class="py-5 border-b border-white/10 text-gray-300">
                                {{ $item['no_telp'] }}
                            </td>

                            {{-- Aksi (Delete Button) --}}
                            <td class="py-5 border-b border-white/10 text-center">
                                <button onclick="alert('Fitur hapus (dummy) untuk ID: {{ $item['id'] }}')" 
                                        class="bg-[#DC2626] hover:bg-red-600 text-white w-8 h-8 rounded-md flex items-center justify-center mx-auto transition-colors shadow-lg border border-red-500/30">
                                    {{-- Icon Sampah --}}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-gray-400 italic bg-[#2a2a2a]/30">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-10 h-10 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Belum ada pendaftar magang.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION COMPONENT (Di Bawah) --}}
        <div class="mt-2">
            @include('admin.pusat.components.pagination', ['paginator' => $pendaftar])
        </div>

    </div>
</div>

@endsection