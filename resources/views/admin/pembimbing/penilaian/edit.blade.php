@extends('layout.admin-layout')

@section('title', 'Edit Penilaian - ' . $peserta['nama'])
@section('header-title', 'Penilaian')

@section('content')

    {{-- Header --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl mb-8">
        <h1 class="text-[#0066FF] text-3xl font-bold tracking-wide">Edit Nilai</h1>
    </div>

    <div class="space-y-6">
        {{-- Profil --}}
        <div class="bg-[#262626] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden mt-6">
            <div class="absolute inset-0 bg-gradient-to-br from-[#262626] via-[#2a2a2a] to-[#202020] opacity-50 pointer-events-none"></div>
            
            <div class="relative z-10">
                <h2 class="text-white text-3xl font-bold mb-6">{{ $peserta['nama'] }}</h2>
                <hr class="border-white mb-6">

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

        {{-- Form Edit Container --}}
        <div class="bg-[#262626] p-8 shadow-lg border-[3px] border-[#011640]">
            <form action="{{ route('pembimbing.penilaian.update', ['id' => $peserta['id']]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $peserta['id'] }}">

                {{-- Judul Besar Container --}}
                <h3 class="text-white text-2xl font-bold mb-6 tracking-wide">Penilaian Kinerja</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    {{-- Kiri: Aspek Presensi --}}
                    <div class="bg-[#333] p-8 rounded-xl border border-white/5 h-full">
                        <h4 class="text-white font-semibold mb-8 text-xl tracking-wide border-b border-white/10 pb-4">Presensi</h4>
                        
                        {{-- ITEM 1: Kehadiran --}}
                        <div class="mb-10">
                            {{-- Label di atas --}}
                            <label class="text-white/80 text-lg font-medium block mb-3">Kehadiran</label>
                            
                            {{-- Flex Container: Slider Kiri, Kotak Nilai Kanan --}}
                            <div class="flex items-center gap-6">
                                {{-- Slider --}}
                                <input type="range" name="kehadiran" min="0" max="4" step="0.1" 
                                       value="{{ $dataNilai['kehadiran'] }}" 
                                       class="flex-1 h-1 bg-gray-500 rounded-lg appearance-none cursor-pointer accent-white" 
                                       oninput="document.getElementById('val1').innerText = this.value">
                                
                                {{-- Kotak Nilai --}}
                                <span id="val1" class="text-white border border-white/50 font-medium text-lg bg-[#D9D9D9]/20 px-3 py-1 rounded-md shadow-lg min-w-[3.5rem] text-center">
                                    {{ $dataNilai['kehadiran'] }}
                                </span>
                            </div>
                        </div>

                        {{-- ITEM 2: Ketepatan Waktu --}}
                        <div class="mb-2">
                            <label class="text-white/80 text-lg font-medium block mb-3">Ketepatan Waktu</label>
                            <div class="flex items-center gap-6">
                                <input type="range" name="ketepatan_waktu" min="0" max="4" step="0.1" 
                                       value="{{ $dataNilai['ketepatan_waktu'] }}" 
                                       class="flex-1 h-1 bg-gray-500 rounded-lg appearance-none cursor-pointer accent-white" 
                                       oninput="document.getElementById('val2').innerText = this.value">
                                
                                <span id="val2" class="text-white border border-white/50 font-medium text-lg bg-[#D9D9D9]/20 px-3 py-1 rounded-md shadow-lg min-w-[3.5rem] text-center">
                                    {{ $dataNilai['ketepatan_waktu'] }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Kanan: Aspek Progres --}}
                    <div class="bg-[#333] p-8 rounded-xl border border-white/5 h-full">
                        <h4 class="text-white font-semibold mb-8 text-xl tracking-wide border-b border-white/10 pb-4">Progres</h4>
                        
                        {{-- ITEM 3: Tugas Selesai --}}
                        <div class="mb-10">
                            <label class="text-white/80 text-lg font-medium block mb-3">Tugas Selesai</label>
                            <div class="flex items-center gap-6">
                                <input type="range" name="tugas_selesai" min="0" max="4" step="0.1" 
                                       value="{{ $dataNilai['tugas_selesai'] }}" 
                                       class="flex-1 h-1 bg-gray-500 rounded-lg appearance-none cursor-pointer accent-white" 
                                       oninput="document.getElementById('val3').innerText = this.value">
                                
                                <span id="val3" class="text-white border border-white/50 font-medium text-lg bg-[#D9D9D9]/20 px-3 py-1 rounded-md shadow-lg min-w-[3.5rem] text-center">
                                    {{ $dataNilai['tugas_selesai'] }}
                                </span>
                            </div>
                        </div>

                        {{-- ITEM 4: Ketepatan Deadline --}}
                        <div class="mb-10">
                            <label class="text-white/80 text-lg font-medium block mb-3">Ketepatan Deadline</label>
                            <div class="flex items-center gap-6">
                                <input type="range" name="ketepatan_deadline" min="0" max="4" step="0.1" 
                                       value="{{ $dataNilai['ketepatan_deadline'] }}" 
                                       class="flex-1 h-1 bg-gray-500 rounded-lg appearance-none cursor-pointer accent-white" 
                                       oninput="document.getElementById('val4').innerText = this.value">
                                
                                <span id="val4" class="text-white border border-white/50 font-medium text-lg bg-[#D9D9D9]/20 px-3 py-1 rounded-md shadow-lg min-w-[3.5rem] text-center">
                                    {{ $dataNilai['ketepatan_deadline'] }}
                                </span>
                            </div>
                        </div>

                        {{-- ITEM 5: Kemandirian --}}
                        <div class="mb-2">
                            <label class="text-white/80 text-lg font-medium block mb-3">Kemandirian</label>
                            <div class="flex items-center gap-6">
                                <input type="range" name="kemandirian" min="0" max="4" step="0.1" 
                                       value="{{ $dataNilai['kemandirian'] }}" 
                                       class="flex-1 h-1 bg-gray-500 rounded-lg appearance-none cursor-pointer accent-white" 
                                       oninput="document.getElementById('val5').innerText = this.value">
                                
                                <span id="val5" class="text-white border border-white/50 font-medium text-lg bg-[#D9D9D9]/20 px-3 py-1 rounded-md shadow-lg min-w-[3.5rem] text-center">
                                    {{ $dataNilai['kemandirian'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Action --}}
                <div class="mt-10 flex gap-4">
                    <button type="submit" class="bg-[#0055FF] hover:bg-[#0044CC] text-white font-bold py-3 px-8 rounded-lg w-[150px]">Simpan</button>
                    {{-- Link Batal kembali ke Detail dengan membawa ID --}}
                    <a href="{{ route('pembimbing.penilaian.detail', ['id' => $peserta['id']]) }}" class="bg-[#444] hover:bg-[#555] text-white font-bold py-3 px-8 rounded-lg text-center w-[150px]">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection