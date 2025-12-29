@extends('layout.peserta-layout')

@section('title', 'Penilaian Peserta')

@section('content')

{{-- TITLE --}}
<h1 class="text-[35px] font-extrabold tracking-wide mb-8 mt-[-20px] opacity-70">
    PENILAIAN PESERTA
</h1>

{{-- BREADCRUMB --}}
<div class="w-full bg-[#3F3F3F] px-8 py-10 mb-8">
    <div class="flex items-center gap-6">

        {{-- BERANDA --}}
        <div class="flex items-center justify-center text-white font-semibold text-[20px] 
                    bg-no-repeat bg-center bg-contain"
            style="background-image:url('/vector/kotakireng.svg'); width:220px; height:55px;">
            Beranda
        </div>

        {{-- PENILAIAN --}}
        <div class="flex items-center justify-center text-white font-semibold text-[20px] -ml-[70px]
                    bg-no-repeat bg-center bg-contain"
            style="background-image:url('/vector/kotakireng2.svg'); width:220px; height:55px;">
            Penilaian
        </div>

    </div>
</div>

{{-- ====== TABEL PENILAIAN ====== --}}
<div class="w-full bg-[#3F3F3F] p-10 mb-16">

    {{-- TITLE --}}
    <h2 class="text-[32px] font-bold text-white">Tabel Penilaian</h2>
    <p class="text-[18px] mb-6" style="color:#0554F2;">Peserta - Nashwan Bima Andika</p>

    <div class="w-full bg-[#363636] p-20">

        {{-- HEADER GARIS ATAS --}}
        <div class="w-full h-[1.5px] bg-white mb-5"></div>

        {{-- HEADER --}}
        <div class="grid text-[18px] font-semibold text-gray-200 pb-5 border-b-2 border-white"
            style="grid-template-columns: 250px 380px 280px;">
            <p class="text-left pl-20">Kategori</p>
            <p class="text-left pl-40">Aspek</p>
            <p class="text-center">Nilai</p>
        </div>

        @php
        $data = [
        'Presensi' => [
        ['Kehadiran', 3.2],
        ['Ketepatan Waktu', 2.4],
        ],
        'Progres' => [
        ['Tugas Selesai', 3.2],
        ['Ketepatan Deadline', 3.2],
        ],
        '' => [
        ['Kemandirian', 4],
        ]
        ];
        @endphp

        {{-- ROWS --}}
        @foreach($data as $kategori => $items)
        @foreach($items as $i => $item)

        <div class="py-5 border-b border-[#555] {{ $loop->odd ? 'bg-[#4F4C4C]' : '' }}">

            <div class="grid items-center text-[17px]"
                style="grid-template-columns: 250px 380px 280px;">

                {{-- Kategori (tampil hanya di baris pertama per grup) --}}
                <p class="font-bold text-left pl-20">
                    {{ $i === 0 ? $kategori : '' }}
                </p>

                {{-- Aspek (lebih ke kiri sedikit dari header, supaya ada indent) --}}
                <p class="text-left pl-24 font-medium">
                    {{ $item[0] }}
                </p>

                {{-- Nilai (tetap center) --}}
                <p class="text-center font-semibold">
                    {{ $item[1] }}
                </p>
            </div>
        </div>

        @endforeach
        @endforeach

        {{-- GARIS BAWAH --}}
        <div class="w-full h-[1.5px] bg-white"></div>

    </div>

</div>

{{-- ====== TABEL PENILAIAN ====== --}}
<div class="w-full bg-[#3F3F3F] p-10 mb-16">
    {{-- TITLE --}}
    <h2 class="text-[32px] font-bold text-white">Statistik Penilaian</h2>
    <p class="text-[18px] mb-6" style="color:#0554F2;">Peserta - Nashwan Bima Andika</p>

</div>

{{-- ====== DIAGRAM BATANG PENILAIAN ====== --}}
@php
    // flatten data aspek -> satu list
    $chartItems = [];
    foreach ($data as $kategori => $items) {
        foreach ($items as $item) {
            $chartItems[] = [
                'label' => $item[0],
                'nilai' => $item[1],
            ];
        }
    }

    $maxScale = 4; // skala penilaian
@endphp

<div class="bg-[#262626] p-8 border-[3px] border-[#011640] shadow-lg w-full relative overflow-hidden mt-16">

    {{-- background glow --}}
    <div class="absolute inset-0 bg-gradient-to-br from-[#262626] via-[#2a2a2a] to-[#202020] opacity-50 pointer-events-none"></div>

    <div class="relative z-10">

        <h3 class="text-[#0066FF] text-xl font-bold mb-10">
            Diagram Penilaian Peserta
        </h3>

        <div class="flex h-[320px]">

            {{-- LABEL Y AXIS --}}
            <div class="w-8 flex items-center justify-center">
                <span class="text-white text-sm font-semibold -rotate-90 whitespace-nowrap">
                    Nilai
                </span>
            </div>

            {{-- ANGKA SKALA --}}
            <div class="flex flex-col justify-between h-full pr-3 text-gray-400 text-sm font-medium">
                @for ($i = $maxScale; $i >= 0; $i--)
                    <span>{{ $i }}</span>
                @endfor
            </div>

            {{-- AREA CHART --}}
            <div class="relative flex-1 h-full">

                {{-- GRID --}}
                <div class="absolute inset-0 flex flex-col justify-between border-l border-b border-gray-600 pointer-events-none">
                    @for ($i = $maxScale; $i >= 0; $i--)
                        <div class="border-t border-gray-700/50 h-0"></div>
                    @endfor
                </div>

                {{-- BAR --}}
                <div class="absolute inset-0 flex items-end justify-around gap-6 px-6 pb-2">

                    @foreach ($chartItems as $item)
                        @php
                            $heightPercent = ($item['nilai'] / $maxScale) * 100;
                        @endphp

                        <div class="group relative flex flex-col items-center w-full max-w-[45px]">

                            {{-- batang --}}
                            @php
                                $maxBarHeight = 240; // tinggi area chart (px)
                                $barHeight = ($item['nilai'] / $maxScale) * $maxBarHeight;
                            @endphp
                            <div
                                class="w-full bg-[#60A5FA] hover:bg-[#3B82F6] transition-all rounded-t-sm"
                                style="height: {{ $barHeight }}px">
                            </div>

                            {{-- tooltip --}}
                            <div class="absolute -top-8 opacity-0 group-hover:opacity-100 transition text-xs bg-black/80 px-2 py-1 rounded text-white">
                                {{ $item['nilai'] }}
                            </div>

                            {{-- label --}}
                            <div class="mt-3 text-center">
                                <span class="block text-white text-xs leading-tight rotate-[-45deg] origin-top-left whitespace-nowrap">
                                    {{ $item['label'] }}
                                </span>
                            </div>

                        </div>
                    @endforeach

                </div>

                {{-- LABEL X --}}
                <div class="absolute -bottom-14 w-full text-center text-white font-semibold text-sm tracking-wide">
                    Aspek Penilaian
                </div>

            </div>
        </div>
    </div>
</div>

@endsection