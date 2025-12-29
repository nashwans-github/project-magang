@extends('layout.admin-layout')

@section('title', 'Progres Peserta Magang')
@section('header-title', 'Progres')

@section('content')

<div class="bg-[#262626] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden rounded-sm min-h-[600px]">

    <div class="absolute inset-0 bg-gradient-to-br from-[#262626] via-[#2a2a2a] to-[#202020] opacity-50 pointer-events-none"></div>

    <div class="relative z-10">

        {{-- 1. HEADER JUDUL --}}
        <div class="mb-8">
            <h2 class="text-[#0066FF] text-3xl font-bold tracking-wide mb-4">
                Progres Peserta
            </h2>
            <div class="w-full border-b border-white/70"></div>
        </div>

        {{-- 2. TOOLBAR (DATE FILTER & SEARCH) --}}
        <div class="flex flex-col md:flex-row justify-between items-end md:items-center mb-6 gap-4">

            {{-- BAGIAN KIRI: TANGGAL & DATE FILTER --}}
            <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                
                {{-- Judul Tanggal (Dinamis dari Controller) --}}
                <h3 class="text-white text-xl font-bold tracking-wide">
                    {{ $tanggalJudul ?? 'Hari Ini' }}
                </h3>

                {{-- COMPONENT: DATE FILTER --}}
                <div class="flex items-center gap-2">
                    @include('admin.pembimbing.components.date-filter', [
                        'url' => route('pembimbing.progres.index')
                    ])

                    {{-- Link Reset ke Hari Ini --}}
                    @if(request('date_filter') && request('date_filter') !== date('Y-m-d'))
                        <a href="{{ route('pembimbing.progres.index', array_merge(request()->except(['date_filter']), ['date_filter' => date('Y-m-d')])) }}" 
                           class="text-sm text-red-400 hover:text-red-300 underline underline-offset-2 transition-colors">
                            Kembali ke Hari Ini
                        </a>
                    @endif
                </div>
            </div>

            {{-- BAGIAN KANAN: SEARCH BAR COMPONENT --}}
            <div class="w-full md:w-auto">
                @include('admin.pembimbing.components.search-bar', [
                    'url' => route('pembimbing.progres.index'),
                    'placeholder' => 'Cari Nama Peserta...'
                ])
            </div>

        </div>

        {{-- 3. TABEL PROGRES --}}
        <div class="overflow-hidden border border-white/5 rounded-sm mb-6">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[25%] pl-6">Nama Peserta</th>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[20%] text-center">Judul</th>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[15%] text-center">Status</th>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[15%] text-center">File</th>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[25%] text-center pr-4">Catatan</th>
                    </tr>
                </thead>

                <tbody class="text-white text-sm">
                    @forelse($progresPaginated as $progres)
                        @php
                            // LOGIKA UNTUK MENENTUKAN JENIS FILE (PDF/GAMBAR)
                            $fileExt = strtolower(pathinfo($progres['file'], PATHINFO_EXTENSION));
                            
                            // Asumsi file ada di public/files (Default)
                            $folder = 'files/';
                            if(in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                                $folder = 'images/'; 
                            }
                            $fileUrl = asset($folder.$progres['file']); 
                        @endphp

                        <tr class="group border-b border-white/5 transition-all duration-300 hover:bg-[#333] hover:scale-[1.002] cursor-pointer hover:z-10">
                            
                            {{-- Nama --}}
                            <td class="py-5 border-b border-white/10 font-medium text-white/90 pl-6">
                                <a href="{{ route('pembimbing.progres.detail', array_merge(request()->query(), ['id' => $progres['peserta_id']])) }}" 
                                   class="hover:text-[#0066FF] transition-colors relative z-20">
                                    {{ $progres['nama_peserta'] }}
                                </a>
                            </td>

                            {{-- Judul --}}
                            <td class="py-5 border-b border-white/10 text-gray-300 text-center">
                                {{ $progres['judul'] }}
                            </td>
                            
                            {{-- Status & Warna --}}
                            @php
                            $status = $progres['status'];
                            $statusText = ucfirst($status); 
                            $colorClass = 'text-gray-300'; 
                            
                            if ($status === 'approved' || $status === 'disetujui') {
                                $colorClass = 'text-green-500'; 
                                $statusText = 'Diterima';
                            } elseif ($status === 'revisi') {
                                $colorClass = 'text-orange-500';
                                $statusText = 'Revisi';
                            } elseif ($status === 'pending') {
                                $colorClass = 'text-yellow-500';
                                $statusText = 'Menunggu';
                            }
                            @endphp
                            
                            <td class="py-6 border-b border-white/10 {{ $colorClass }} text-base text-center">
                                {{ $statusText }}
                            </td>
                            
                            {{-- File --}}
                            <td class="py-6 border-b border-white/10 text-center relative z-20">
                                <button onclick="showFileModal('{{ $fileUrl }}', '{{ $fileExt }}')" 
                                    class="bg-[#0066FF] hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm flex items-center gap-2 mx-auto transition-colors shadow-md border border-blue-400/50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Lihat File
                                </button>
                            </td>

                            {{-- Catatan --}}
                            <td class="py-6 border-b border-white/10 text-center text-gray-300 pr-4 italic">
                                {{ $progres['catatan'] ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-500 italic bg-[#2a2a2a]/30">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-10 h-10 text-gray-600 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <span>Tidak ada progres pada tanggal ini.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- 4. PAGINATION COMPONENT --}}
        <div>
            @include('admin.pembimbing.components.pagination', ['paginator' => $progresPaginated])
        </div>

    </div>
</div>

@endsection