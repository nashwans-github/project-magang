@extends('layout.admin-layout')

@section('title', 'Daftar Peserta Magang')
@section('header-title', 'Daftar Peserta')

@section('content')

<div class="bg-[#262626] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden rounded-sm min-h-[600px]">

    {{-- Background Gradient (Style Asli Dipertahankan) --}}
    <div class="absolute inset-0 bg-gradient-to-br from-[#262626] via-[#2a2a2a] to-[#202020] opacity-50 pointer-events-none"></div>

    <div class="relative z-10">

        {{-- HEADER JUDUL --}}
        <div class="mb-8">
            <h2 class="text-[#0066FF] text-3xl font-bold tracking-wide mb-4">
                Daftar Peserta
            </h2>
            <div class="w-full border-b border-white/70"></div>
        </div>

        {{-- TOOLBAR (SEARCH BAR) --}}
        {{-- Kita hilangkan flex-between karena pagination pindah ke bawah --}}
        <div class="mb-6">
            <div class="w-full md:w-auto flex flex-col md:flex-row gap-4">
                
                {{-- 1. SEARCH BAR COMPONENT --}}
                {{-- Mengarah ke route index saat ini agar filter berjalan --}}
                @include('admin.pembimbing.components.search-bar', [
                    'url' => route('pembimbing.daftar-peserta.index'),
                    'placeholder' => 'Cari Nama Peserta...'
                ])

            </div>
        </div>

        {{-- TABEL DATA --}}
        <div class="overflow-hidden border border-white/5 rounded-sm mb-6">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[30%] pl-6">Nama Peserta</th>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[20%] text-center">Bidang</th>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[25%] text-center">Tanggal Mulai</th>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[25%] text-center">Tanggal Selesai</th>
                    </tr>
                </thead>

                <tbody class="text-white text-base">
                    @forelse($pesertaSaya as $peserta)
                        <tr class="group border-b border-white/5 transition-all duration-300 hover:bg-[#333] hover:scale-[1.002] hover:shadow-xl cursor-pointer relative hover:z-10">
                            
                            {{-- Nama --}}
                            <td class="py-5 border-b border-white/10 font-medium text-white/90 pl-6">
                                {{-- Link ke Detail (Nanti kita buat route detailnya) --}}
                                <a href="{{ route('pembimbing.daftar-peserta.detail', array_merge(request()->query(), ['id' => $peserta['id']])) }}"
                                   class="hover:text-[#0066FF] transition-colors relative z-20">
                                    {{ $peserta['nama'] }}
                                </a>
                            </td>

                            {{-- Bidang --}}
                            <td class="py-5 border-b border-white/10 text-gray-300 text-center">
                                {{ $peserta['bidang'] }}
                            </td>

                            {{-- Tgl Mulai --}}
                            <td class="py-5 border-b border-white/10 text-gray-300 text-center">
                                {{ isset($peserta['tgl_mulai']) ? \Carbon\Carbon::parse($peserta['tgl_mulai'])->translatedFormat('d F Y') : '-' }}
                            </td>

                            {{-- Tgl Selesai --}}
                            <td class="py-5 border-b border-white/10 text-gray-300 text-center">
                                {{ isset($peserta['tgl_selesai']) ? \Carbon\Carbon::parse($peserta['tgl_selesai'])->translatedFormat('d F Y') : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-gray-400 italic bg-[#2a2a2a]/30">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-10 h-10 mb-2 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Belum ada peserta magang aktif di bidang ini.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION COMPONENT (DI BAWAH) --}}
        <div>
            @include('admin.pembimbing.components.pagination', ['paginator' => $pesertaSaya])
        </div>

    </div>
</div>

@endsection