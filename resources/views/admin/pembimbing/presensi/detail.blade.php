@extends('layout.admin-layout')

@section('title', 'Detail Presensi - ' . $peserta['nama'])
@section('header-title', 'Detail Presensi')

@section('content')

    {{-- HEADER --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl mb-8 flex justify-between items-center rounded-sm">
        <h1 class="text-[#0066FF] text-3xl font-bold tracking-wide">
            Detail Presensi Peserta
        </h1>
    </div>

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

        {{-- TABEL RIWAYAT --}}
        <div class="bg-[#262626] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden rounded-sm">
            <div class="overflow-hidden border border-white/5 rounded-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[10%] text-center">No.</th>
                            <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[20%] pl-6">Tanggal</th>
                            <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[15%] text-center">Jam Masuk</th>
                            <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[20%] text-center">Status</th>
                            <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[15%] text-center">Bukti Hadir</th>
                            <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[20%] text-center pr-4">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="text-white text-sm">
                        @forelse($history as $absen)
                            <tr class="group hover:bg-white/5 transition-colors border-b border-white/5">
                                <td class="py-6 border-b border-white/10 font-medium text-base text-center">{{ $loop->iteration + $history->firstItem() - 1 }}</td>
                                <td class="py-6 border-b border-white/10 text-base text-gray-300 pl-6">{{ \Carbon\Carbon::parse($absen['tanggal'])->translatedFormat('d F Y') }}</td>
                                <td class="py-6 border-b border-white/10 text-base text-center text-gray-300">{{ !empty($absen['jam_masuk']) ? \Carbon\Carbon::parse($absen['jam_masuk'])->format('H:i') : '-' }}</td>
                                
                                {{-- STATUS --}}
                                @php
                                    $status = $absen['status'];
                                    $statusText = ucfirst(str_replace('_', ' ', $status)); 
                                    $colorClass = 'text-gray-300'; 
                                    if ($status === 'tepat_waktu' || $status === 'Hadir') { $colorClass = 'text-[#22C55E]'; $statusText = 'Hadir'; }
                                    elseif ($status === 'terlambat' || $status === 'Terlambat' || $status === 'Hadir - Terlambat') { $colorClass = 'text-orange-500'; $statusText = 'Hadir - Terlambat'; }
                                    elseif ($status === 'izin' || $status === 'sakit') { $colorClass = 'text-[#0066FF]'; }
                                    elseif ($status === 'Tidak Hadir' || $status === 'alpha') { $colorClass = 'text-[#FF0000]'; }
                                @endphp
                                <td class="py-6 border-b border-white/10 {{ $colorClass }} text-base text-center font-medium">{{ $statusText }}</td>

                                {{-- BUKTI HADIR --}}
                                <td class="py-6 border-b border-white/10 text-center">
                                    @if(!empty($absen['bukti_foto']))
                                        @php
                                            $fileExt = strtolower(pathinfo($absen['bukti_foto'], PATHINFO_EXTENSION));
                                            $fileUrl = asset('images/'.$absen['bukti_foto']); 
                                        @endphp
                                        <button onclick="showFileModal('{{ $fileUrl }}', '{{ $fileExt }}')" class="bg-[#0066FF] hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm flex items-center gap-1 mx-auto transition-colors shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Lihat File
                                        </button>
                                    @else
                                        <span class="text-gray-500 italic">-</span>
                                    @endif
                                </td>

                                <td class="py-6 border-b border-white/10 text-sm text-center text-gray-300 pr-4">{{ $absen['keterangan'] ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-12 text-gray-500 italic bg-[#2a2a2a]/30">Belum ada riwayat presensi.</td>
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