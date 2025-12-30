@extends('layout.admin-layout')

@section('title', 'Detail Progres - ' . $peserta['nama'])
@section('header-title', 'Detail Progres')

@section('content')

    {{-- HEADER JUDUL --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl mb-8 flex justify-between items-center rounded-sm">
        <h1 class="text-[#0066FF] text-3xl font-bold tracking-wide">
            Progres Peserta
        </h1>
    </div>

    {{-- WRAPPER UTAMA --}}
    <div class="space-y-6">

        {{-- 1. CARD PROFIL UTAMA --}}
        <div class="bg-[#262626] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden mt-6 rounded-sm">
            <div class="absolute inset-0 bg-gradient-to-br from-[#262626] via-[#2a2a2a] to-[#202020] opacity-50 pointer-events-none"></div>
            
            <div class="relative z-10">
                {{-- NAMA PESERTA --}}
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

        {{-- 2. TABEL RIWAYAT PROGRES --}}
        <div class="bg-[#262626] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden rounded-sm">
            <div class="overflow-hidden border border-white/5 rounded-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="py-6 text-gray-300 font-bold uppercase text-sm tracking-wider border-b border-white/20 w-[5%] text-center">No.</th>
                            <th class="py-6 text-gray-300 font-bold uppercase text-sm tracking-wider border-b border-white/20 w-[15%] pl-2">Tanggal</th>
                            <th class="py-6 text-gray-300 font-bold uppercase text-sm tracking-wider border-b border-white/20 w-[25%] ">Judul</th>
                            <th class="py-6 text-gray-300 font-bold uppercase text-sm tracking-wider border-b border-white/20 w-[15%] text-center">Status</th>
                            <th class="py-6 text-gray-300 font-bold uppercase text-sm tracking-wider border-b border-white/20 w-[10%] text-center">File</th>
                            <th class="py-6 text-gray-300 font-bold uppercase text-sm tracking-wider border-b border-white/20 w-[25%] text-center pr-4">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="text-white text-sm">
                        @forelse($history as $prog)
                            @php
                                $status = $prog['status'];
                                $statusText = ucfirst($status); 
                                $badgeClass = 'border-gray-500 text-gray-300'; 
                                
                                if ($status === 'approved' || $status === 'disetujui') { 
                                    $badgeClass = 'border-green-500 text-green-400 bg-green-500/10'; 
                                    $statusText = 'Diterima'; 
                                } elseif ($status === 'revisi') { 
                                    $badgeClass = 'border-orange-500 text-orange-400 bg-orange-500/10'; 
                                    $statusText = 'Revisi'; 
                                } elseif ($status === 'pending') { 
                                    $badgeClass = 'border-blue-500 text-blue-400 bg-blue-500/10'; 
                                    $statusText = 'Menunggu'; 
                                }

                                // Ambil File
                                $fileExt = strtolower(pathinfo($prog['file'], PATHINFO_EXTENSION));
                                $folder = in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif', 'webp']) ? 'images/' : 'files/';
                                $fileUrl = asset($folder.$prog['file']); 
                            @endphp

                            <tr class="group hover:bg-white/5 transition-colors border-b border-white/5">
                                <td class="py-5 border-b border-white/10 font-base text-base text-center">{{ $loop->iteration + $history->firstItem() - 1 }}</td>
                                <td class="py-5 border-b border-white/10 text-sm text-gray-300 pl-2">{{ \Carbon\Carbon::parse($prog['tanggal'])->translatedFormat('d F Y') }}</td>
                                <td class="py-5 border-b border-white/10 text-sm text-gray-300 font-medium">{{ $prog['judul'] }}</td>
                                
                                {{-- STATUS --}}
                                <td class="py-6 border-b border-white/10 text-center">
                                    <button onclick="openApprovalModal('{{ $prog['id'] }}', '{{ $status }}', '{{ $prog['catatan'] }}')" 
                                            class="px-4 py-1.5 rounded-full text-xs font-bold border {{ $badgeClass }} hover:scale-105 transition-transform cursor-pointer shadow-sm">
                                        {{ $statusText }}
                                    </button>
                                </td>

                                {{-- FILE --}}
                                <td class="py-6 border-b border-white/10 text-center relative z-20">
                                    <button onclick="showFileModal('{{ $fileUrl }}', '{{ $fileExt }}')" 
                                            class="bg-[#0066FF] hover:bg-blue-600 text-white px-4 py-2 rounded-md text-xs font-medium flex items-center gap-2 mx-auto transition-colors shadow-md border border-blue-400/50">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Lihat File
                                    </button>
                                </td>

                                <td class="py-6 border-b border-white/10 text-sm text-center text-gray-300 pr-2 italic">{{ Str::limit($prog['catatan'] ?? '-', 50) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-12 text-gray-500 italic bg-[#2a2a2a]/30">Belum ada riwayat progres.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- PAGINATION --}}
            <div class="mt-8">
                @include('admin.pembimbing.components.pagination', ['paginator' => $history])
            </div>
        </div>
    </div> 

@endsection