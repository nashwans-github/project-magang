@extends('layout.admin-layout')

@section('title', 'Detail Penilaian')
@section('header-title', 'Penilaian')

@section('content')
    {{-- Header --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl mb-8 flex justify-between items-center">
        <h1 class="text-[#0066FF] text-3xl font-bold tracking-wide">Detail Penilaian Peserta</h1>
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

        {{-- Tabel Nilai (Read Only) --}}
        <div class="bg-[#262626] p-8 border-[3px] shadow-lg border-[#011640]">
            <h3 class="text-white px-2 text-2xl font-semibold mb-6">Penilaian Kinerja</h3>
            <div class="bg-[#333] py-8 px-24 pb-12 rounded-xl mb-8 border border-white/5">
                <h4 class="text-white font-semibold mb-2 text-xl tracking-wide">Daftar Nilai</h4>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-white"><th class="py-4 text-gray-300 font-bold w-[30%]"></th><th class="py-4 text-gray-300 font-bold w-[45%] text-left pl-8">Aspek Nilai</th><th class="py-4 text-gray-300 font-bold w-[25%] text-center">Nilai</th></tr>
                    </thead>
                    <tbody class="text-white text-base">
                        <tr class="border-b border-white-600/50"><td class="py-4 px-14 text-base font-medium">Presensi</td><td class="py-4 px-8 text-gray-300">Kehadiran</td><td class="py-4 px-14 text-center">{{ $dataNilai['kehadiran'] }}</td></tr>
                        <tr class="border-b border-white-600/50"><td class="py-4 px-14"></td><td class="py-4 px-8 text-gray-300">Ketepatan Waktu</td><td class="py-4 px-14 text-center">{{ $dataNilai['ketepatan_waktu'] }}</td></tr>
                        <tr class="border-b border-white-600/50"><td class="py-4 px-14 text-base font-medium">Progres</td><td class="py-4 px-8 text-gray-300">Tugas Selesai</td><td class="py-4 px-14 text-center">{{ $dataNilai['tugas_selesai'] }}</td></tr>
                        <tr class="border-b border-white-600/50"><td class="py-4 px-14"></td><td class="py-4 px-8 text-gray-300">Ketepatan Deadline</td><td class="py-4 px-14 text-center">{{ $dataNilai['ketepatan_deadline'] }}</td></tr>
                        <tr class="border-b border-white-600/50"><td class="py-4 px-14"></td><td class="py-4 px-8 text-gray-300">Kemandirian</td><td class="py-4 px-14 text-center">{{ $dataNilai['kemandirian'] }}</td></tr>
                    </tbody>
                </table>
            </div>

            {{-- Statistik (Grafik) --}}
            <div class="bg-[#333] py-8 px-24 pb-20 border rounded-xl border-white/5">
                {{-- Catatan: saya ubah pb-16 jadi pb-20 agar ada ruang lebih di bawah --}}
    
                <h3 class="text-white font-semibold mb-8 text-lg tracking-wide">Statistik Nilai</h3>
    
                <div class="flex h-[350px]">
                    {{-- Label Y-Axis (Kiri) --}}
                    <div class="w-8 px-2 h-full flex items-center justify-center pointer-events-none">
                        <span class="text-white font-semibold text-lg -rotate-90 whitespace-nowrap tracking-wider block">Nilai</span>
                    </div>

                    {{-- Area Grafik --}}
                    {{-- Container ini harus 'relative' agar label baru bisa diposisikan absolut terhadapnya --}}
                        <div class="relative flex-1 h-full ml-10">
            
                        {{-- Garis-garis Background (Grid) --}}
                        <div class="absolute inset-0 flex flex-col justify-between pointer-events-none pb-10">
                            @foreach([4, 3.5, 3, 2.5, 2, 1.5, 1, 0.5, 0] as $i)
                                <div class="border-b border-gray-500 w-full h-0 relative">
                                    <span class="text-white/70 text-sm font-normal -mt-2 absolute -left-8">{{ $i }}</span>
                                </div>
                            @endforeach
                        </div>

                        {{-- Batang Grafik & Label per Aspek --}}
                        <div class="absolute inset-0 flex items-end justify-around pb-10 px-2">
                            @foreach([$dataNilai['kehadiran'], $dataNilai['ketepatan_waktu'], $dataNilai['tugas_selesai'], $dataNilai['ketepatan_deadline'], $dataNilai['kemandirian']] as $idx => $val)
                                <div class="relative w-20 bg-[#60A5FA] hover:bg-[#3B82F6] transition-all rounded-t-sm group cursor-pointer" style="height: {{ ($val/4)*100 }}%">
                                    {{-- Angka Nilai --}}
                                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-white text-sm font-medium">{{ $val }}</span>
                                    {{-- Label Nama Aspek --}}
                                        <div class="absolute -bottom-8 w-max whitespace-nowrap text-sm font-normal text-white left-1/2 -translate-x-1/2">
                                            {{ ['Kehadiran', 'Ketepatan Waktu', 'Tugas Selesai', 'Ketepatan Deadline', 'Kemandirian'][$idx] }}
                                        </div>
                                    </div>
                                @endforeach
                        </div>

                        {{-- Label Judul Sumbu X --}}
                        <div class="absolute -bottom-10 left-1/2 -translate-x-1/2 text-white font-semibold text-lg tracking-wide pointer-events-none">
                            Aspek Penilaian
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ringkasan --}}
        <div class="bg-[#262626] p-8 border-[3px] shadow-lg border-[#011640]">
            <h3 class="text-white px-2 text-xl font-bold mb-6">Jumlah dan Rata-Rata Nilai</h3>
            <div class="space-y-6">
                
                {{-- Bagian Presensi --}}
                <div class="bg-[#333] p-6 rounded-xl border border-white/5">
                    <h4 class="text-white font-semibold mb-4 text-lg text-center tracking-wide">Presensi</h4>
                    <div class="grid grid-cols-2 gap-6 pr-16 pl-16">
                        
                        {{-- Kotak Total Nilai --}}
                        <div class="bg-black border-2 border-white/70 rounded-lg text-center h-[120px] flex flex-col justify-center items-center transition-all duration-300 hover:scale-105 hover:border-[#00B7FF] hover:shadow-[0_0_15px_rgba(0,183,255,0.3)] cursor-default">
                            <p class="text-gray-400 text-sm mb-3">Total Nilai</p>
                            <p class="text-white text-4xl font-bold">{{ $dataNilai['total_presensi'] }}</p>
                        </div>

                        {{-- Kotak Rata-Rata --}}
                        <div class="bg-black border-2 border-white/70 rounded-lg text-center h-[120px] flex flex-col justify-center items-center transition-all duration-300 hover:scale-105 hover:border-[#00B7FF] hover:shadow-[0_0_15px_rgba(0,183,255,0.3)] cursor-default">
                            <p class="text-gray-400 text-sm mb-3">Rata - Rata</p>
                            <p class="text-[#00B7FF] text-4xl font-bold">{{ $dataNilai['rata_presensi'] }}</p>
                        </div>

                    </div>
                </div>

                {{-- Bagian Progres --}}
                <div class="bg-[#333] p-6 rounded-xl border border-white/5">
                    <h4 class="text-white font-semibold mb-4 text-lg text-center tracking-wide">Progres</h4>
                    <div class="grid grid-cols-2 gap-6 pr-16 pl-16">
                        
                        {{-- Kotak Total Nilai --}}
                        <div class="bg-black border-2 border-white/70 rounded-lg text-center h-[120px] flex flex-col justify-center items-center transition-all duration-300 hover:scale-105 hover:border-[#00B7FF] hover:shadow-[0_0_15px_rgba(0,183,255,0.3)] cursor-default">
                            <p class="text-gray-400 text-sm mb-3">Total Nilai</p>
                            <p class="text-white text-4xl font-bold">{{ $dataNilai['total_progres'] }}</p>
                        </div>

                        {{-- Kotak Rata-Rata --}}
                        <div class="bg-black border-2 border-white/70 rounded-lg text-center h-[120px] flex flex-col justify-center items-center transition-all duration-300 hover:scale-105 hover:border-[#00B7FF] hover:shadow-[0_0_15px_rgba(0,183,255,0.3)] cursor-default">
                            <p class="text-gray-400 text-sm mb-3">Rata - Rata</p>
                            <p class="text-[#00B7FF] text-4xl font-bold">{{ $dataNilai['rata_progres'] }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Edit --}}
        <div class="pb-8">
            <a href="{{ route('pembimbing.penilaian.edit', array_merge(request()->query(), ['id' => $peserta['id']])) }}"
            class="bg-[#0055FF] hover:bg-[#0044CC] text-white font-bold py-3 px-8 rounded-lg shadow-lg transition-colors text-lg w-[120px] h-[50px] inline-flex items-center justify-center">Edit</a>
        </div>
    </div>
@endsection