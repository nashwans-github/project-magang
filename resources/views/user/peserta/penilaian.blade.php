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

{{-- ====== STATISTIK PENILAIAN ====== --}}
@php
    $chartItems = [];
    foreach ($data as $kategori => $items) {
        foreach ($items as $item) {
            $chartItems[] = [
                'label' => $item[0],
                'nilai' => $item[1],
            ];
        }
    }

    $maxScale    = 4;
    $stepScale   = 0.5;
    $chartHeight = 340;
    $totalSteps  = $maxScale / $stepScale;
@endphp

<div class="w-full bg-[#3F3F3F] p-10 mb-16 shadow-lg relative overflow-hidden">

    {{-- background glow --}}
    <div class="absolute inset-0 bg-gradient-to-br from-[#3f3f3f] via-[#3a3a3a] to-[#2f2f2f] opacity-60 pointer-events-none"></div>

    <div class="relative z-10">

        {{-- TITLE --}}
        <h2 class="text-[32px] font-extrabold text-white tracking-wide">
            Statistik Penilaian
        </h2>

        <p class="text-[18px] font-semibold mb-12 text-[#0554F2]">
            Peserta — Nashwan Bima Andika
        </p>

        {{-- ================= DIAGRAM ================= --}}
        <div class="flex items-start">

            {{-- LABEL Y --}}
            <div class="w-16 mt-[170px] flex justify-center">
                <span class="text-white text-sm font-semibold -rotate-90 tracking-wide whitespace-nowrap">
                    Nilai
                </span>
            </div>

            {{-- ANGKA SKALA --}}
            <div class="relative pr-8" style="height: {{ $chartHeight }}px">
                @for ($i = 0; $i <= $totalSteps; $i++)
                    @php
                        $value  = $i * $stepScale;
                        $bottom = ($i / $totalSteps) * $chartHeight;
                    @endphp
                    <div
                        class="absolute right-0 text-gray-400 text-sm font-medium"
                        style="bottom: {{ $bottom - 8 }}px">
                        {{ number_format($value, 1) }}
                    </div>
                @endfor
            </div>

            {{-- AREA CHART --}}
            <div class="relative flex-1 pl-6">

                {{-- GRID --}}
                <div class="relative" style="height: {{ $chartHeight }}px">

                    @for ($i = 0; $i <= $totalSteps; $i++)
                        @php
                            $bottom = ($i / $totalSteps) * $chartHeight;
                        @endphp
                        <div
                            class="absolute left-0 right-0 border-t border-gray-600/60"
                            style="bottom: {{ $bottom }}px">
                        </div>
                    @endfor

                    {{-- AXIS --}}
                    <div class="absolute inset-0 border-l border-b border-gray-500"></div>

                    {{-- BAR --}}
                    <div
                        class="absolute inset-0 grid gap-5 px-6"
                        style="grid-template-columns: repeat({{ count($chartItems) }}, minmax(0, 1fr)); align-items:end;">

                        @foreach ($chartItems as $item)
                            @php
                                $barHeight = ($item['nilai'] / $maxScale) * $chartHeight;
                            @endphp

                            <div class="relative flex justify-center group">

                                <div
                                    class="w-[56px] bg-[#60A5FA] group-hover:bg-[#3B82F6]
                                           transition-all duration-200 rounded-t-sm"
                                    style="height: {{ $barHeight }}px">
                                </div>

                                {{-- TOOLTIP --}}
                                <div
                                    class="absolute -top-8 px-2 py-1 text-xs font-semibold text-white
                                           bg-black/80 rounded opacity-0 group-hover:opacity-100
                                           transition pointer-events-none">
                                    {{ $item['nilai'] }}
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- LABEL PER ITEM --}}
                <div
                    class="mt-3 grid gap-5 px-6"
                    style="grid-template-columns: repeat({{ count($chartItems) }}, minmax(0, 1fr));">

                    @foreach ($chartItems as $item)
                        <div class="flex justify-center">
                            <span class="text-white text-xs text-center leading-tight">
                                {{ $item['label'] }}
                            </span>
                        </div>
                    @endforeach
                </div>

                {{-- LABEL X --}}
                <div class="mt-5 w-full text-center text-white font-semibold text-sm tracking-wide">
                    Aspek Penilaian
                </div>

            </div>
        </div>
    </div>
</div>

@endsection