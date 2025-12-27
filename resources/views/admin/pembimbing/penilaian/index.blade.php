@extends('layout.admin-layout')

@section('title', 'Penilaian Peserta Magang')
@section('header-title', 'Penilaian')

@section('content')

<div class="bg-[#262626] p-8 border-[#011640] border-[3px] shadow-2xl w-full relative overflow-hidden rounded-sm min-h-[600px]">

    <div class="absolute inset-0 bg-gradient-to-br from-[#262626] via-[#2a2a2a] to-[#202020] opacity-50 pointer-events-none"></div>

    <div class="relative z-10">

        {{-- 1. HEADER JUDUL --}}
        <div class="mb-8">
            <h2 class="text-[#0066FF] text-3xl font-bold tracking-wide mb-4">
                Penilaian Peserta
            </h2>
            <div class="w-full border-b border-white/70"></div>
        </div>

        {{-- 2. TOOLBAR (SEARCH ONLY) --}}
        <div class="flex flex-col md:flex-row justify-end items-end md:items-center mb-6 gap-4">
            
            {{-- SEARCH BAR COMPONENT --}}
            <div class="w-full md:w-auto">
                @include('admin.pembimbing.components.search-bar', [
                    'url' => route('pembimbing.penilaian.index'),
                    'placeholder' => 'Cari Nama Peserta...'
                ])
            </div>
        </div>

        {{-- 3. TABEL PENILAIAN --}}
        <div class="overflow-hidden border border-white/5 rounded-sm mb-6">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[30%] pl-6">Nama Peserta</th>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[15%] text-center">Presensi</th>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[15%] text-center">Progres</th>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[20%] text-center">Rata-Rata</th>
                        <th class="py-6 text-gray-300 font-bold uppercase text-base tracking-wider border-b border-white/20 w-[20%] text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-white text-base">
                    @forelse($penilaianPaginated as $data)
                        <tr class="group border-b border-white/5 transition-all duration-300 hover:bg-[#333] hover:scale-[1.002] cursor-pointer relative hover:z-10">
                            
                            {{-- Nama --}}
                            <td class="py-5 border-b border-white/10 font-medium text-white/90 pl-6">
                                <a href="{{ route('pembimbing.penilaian.detail', array_merge(request()->query(), ['id' => $data['id']])) }}"
                                   class="hover:text-[#0066FF] transition-colors relative z-20">
                                    {{ $data['nama'] }}
                                </a>
                            </td>

                            {{-- Nilai Presensi --}}
                            <td class="py-5 border-b border-white/10 text-gray-300 text-center">
                                {{ $data['rata_presensi'] }}
                            </td>

                            {{-- Nilai Progres --}}
                            <td class="py-5 border-b border-white/10 text-gray-300 text-center">
                                {{ $data['rata_progres'] }}
                            </td>

                            {{-- Rata-Rata Akhir --}}
                            <td class="py-5 border-b border-white/10 text-gray-300 text-center">
                                <span class="font-semibold {{ $data['nilai_akhir'] >= 3.0 ? 'text-[#22C55E]' : 'text-[#FF5100]' }}">
                                    {{ $data['nilai_akhir'] }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="py-6 border-b border-white/10 text-center relative z-20">
                                <a href="{{ route('pembimbing.penilaian.detail', array_merge(request()->query(), ['id' => $data['id']])) }}"
                                   class="bg-[#FF8126] hover:bg-orange-500 text-white w-9 h-9 rounded-md flex items-center justify-center mx-auto transition-all shadow-md group-hover:scale-110 transform duration-200 border border-orange-400/30" 
                                   title="Edit Nilai">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-500 italic bg-[#2a2a2a]/30">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-10 h-10 text-gray-600 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>Tidak ada peserta nagang.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- 4. PAGINATION COMPONENT --}}
        <div>
            @include('admin.pembimbing.components.pagination', ['paginator' => $penilaianPaginated])
        </div>

    </div>
</div>

@endsection