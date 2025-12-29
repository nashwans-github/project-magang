@extends('layout.pendaftaran-layout')

@section('title', 'Review Pengajuan')

@section('content')
<div class="min-h-screen bg-black text-white">
    <div class="pt-0">

        {{-- HEADER (SAMA SEPERTI STEP 3) --}}
        <header class="w-full bg-white/60 backdrop-blur-md shadow">
            <div class="max-w-7xl mx-auto flex items-center justify-between py-5 px-6">
                <div class="flex items-center space-x-3">
                    <img src="/images/logo-pemkot.png" class="w-10" alt="Logo">
                    <span class="font-bold text-[#031CFC] text-[15px] tracking-wide"
                        style="font-family: 'Poppins', sans-serif;">
                        PEMERINTAH KOTA SURABAYA
                    </span>
                </div>

                <div class="text-[#010D96] text-[19px] font-semibold tracking-wide">
                    Formulir Pendaftaran Magang
                </div>
            </div>
        </header>

        {{-- STEP PROGRESS --}}
        <div class="max-w-6xl mx-auto mt-10 relative">

            {{-- LINE BACKGROUND --}}
            <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[480px] h-[4px] bg-gray-600 rounded-full"></div>

            {{-- LINE FILLED (FULL, 100%) --}}
            <div class="absolute top-10 left-1/2 -translate-x-[240px] h-[4px] bg-[#0554F2] rounded-full transition-all duration-500"
                style="width: 480px;"></div>

            {{-- STEPS --}}
            <div class="flex justify-center gap-12 relative z-10">
                @php
                $labels = ['Data Diri<br>Pemohon','Data Diri<br>Peserta','Upload<br>Berkas','Review<br>Pengajuan'];
                @endphp

                @foreach ([1,2,3,4] as $i)
                <div class="flex flex-col items-center">
                    <div class="step-circle w-20 h-20 rounded-full flex items-center justify-center shadow-xl
                        bg-[#0554F2]">
                        <img src="/vector/{{ $i }}.svg" class="max-w-[55%] max-h-[55%] object-contain" />
                    </div>

                    <p class="mt-3 text-sm text-gray-300 text-center leading-tight">
                        {!! $labels[$i-1] !!}
                    </p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- CONTENT WRAPPER --}}
        <div class="flex justify-center py-14">
            <div class="bg-black/90 backdrop-blur-xl max-w-[1000px] w-full mx-auto rounded-[40px]
                pb-20 border border-white/10 
                shadow-[0_0_60px_#FBCD35,_0_0_250px_#FBCD3540,_0_0_400px_#FBCD3520]">

                <h1 class="text-center text-[36px] font-semibold text-[#0554F2] mt-12 mb-10">
                    Review Data Pengajuan Magang
                </h1>

                @php
                // safety extraction
                $pemohon = $data['pemohon'] ?? [];

                $orderedFields = [
                'nama' => 'Nama',
                'telepon' => 'Nomor Handphone',
                'email' => 'Email',
                'instansi' => 'Asal Instansi',
                'dinas' => 'Dinas Tujuan',
                'tanggal_mulai' => 'Tanggal Mulai',
                'tanggal_selesai' => 'Tanggal Selesai',
                ];

                $pesertaList = $data['peserta'] ?? [];
                $berkas = $data['berkas'] ?? [];
                @endphp

                <div class="space-y-6 max-w-[780px] mx-auto">

                    {{-- DATA PEMOHON --}}
                    <div>
                        <label class="text-[20px] font-semibold text-white px-2 mb-3 block">
                            Data Pemohon
                        </label>

                        <div class="bg-[#222] rounded-2xl px-10 py-8 shadow-md border border-white/5">

                            {{-- HEADER --}}
                            <div class="relative flex items-start cursor-pointer accordion-btn-pemohon">
                                <div class="w-full">
                                    <label class="text-white text-[18px] tracking-wide block mb-2">Nama</label>

                                    <div class="w-full px-4 py-3 rounded-[11px] bg-white/50 
                                        text-black font-poppins font-semibold">
                                        {{ $pemohon['nama'] ?? '-' }}
                                    </div>
                                </div>

                                <svg class="w-6 h-6 text-white absolute right-2 -translate-y-1/2 
                                    transition-transform accordion-arrow-pemohon"
                                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            {{-- DETAIL CONTENT --}}
                            <div class="accordion-content-pemohon hidden mt-5 space-y-5">

                                {{-- FIELD BIASA (Kecuali tanggal & nama) --}}
                                @foreach ($orderedFields as $key => $label)
                                @continue(in_array($key, ['nama', 'tanggal_mulai', 'tanggal_selesai']))

                                <div>
                                    <label class="text-white text-[18px] tracking-wide">{{ $label }}</label>
                                    <div class="w-full mt-2 px-4 py-3 rounded-[11px] bg-white/50 text-black font-semibold">
                                        {{ $pemohon[$key] ?? '-' }}
                                    </div>
                                </div>
                                @endforeach

                                {{-- FIELD TANGGAL – DIBUAT TERPISAH & TETAP DALAM CONTENT --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                    <div>
                                        <label class="text-white text-[18px] tracking-wide">Tanggal Mulai</label>
                                        <div class="w-full mt-2 px-4 py-3 rounded-[11px] bg-white/50 text-black font-semibold">
                                            {{ $pemohon['tanggal_mulai'] ?? '-' }}
                                        </div>
                                    </div>

                                    <div>
                                        <label class="text-white text-[18px] tracking-wide">Tanggal Selesai</label>
                                        <div class="w-full mt-2 px-4 py-3 rounded-[11px] bg-white/50 text-black font-semibold">
                                            {{ $pemohon['tanggal_selesai'] ?? '-' }}
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- DATA PESERTA --}}
                    <div>
                        <label class="text-[20px] font-semibold text-white px-2 font-poppins mb-4 block">
                            Peserta
                        </label>

                        @if(count($pesertaList) === 0)
                        <p class="text-center text-gray-400 text-sm">Tidak ada data peserta.</p>
                        @endif

                        @foreach ($pesertaList as $i => $peserta)
                        @php
                        $p_nama = $peserta['nama'] ?? '-';
                        $p_email = $peserta['email'] ?? '-';
                        $p_no = $peserta['no_hp'] ?? $peserta['nomor'] ?? '-';
                        $p_jurusan = $peserta['jurusan'] ?? '-';
                        $p_bidang = $peserta['bidang_tujuan'] ?? '-';
                        $p_password = $peserta['password'] ?? '********';
                        @endphp

                        <div class="bg-[#222] rounded-2xl px-10 py-8 shadow-md border border-white/5 mb-6">

                            {{-- HEADER ACCORDION --}}
                            <div class="relative flex items-start cursor-pointer accordion-btn-peserta">
                                <div class="w-full">
                                    <label class="text-white text-[18px] tracking-wide block mb-2">
                                        Peserta {{ $i + 1 }} - Nama
                                    </label>

                                    <div class="w-full px-4 py-3 rounded-[11px] bg-white/50 
                                        text-black font-poppins font-semibold">
                                        {{ $p_nama }}
                                    </div>
                                </div>

                                <svg class="w-6 h-6 text-white absolute right-2 -translate-y-1/2 
                                    transition-transform accordion-arrow-peserta"
                                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            {{-- CONTENT --}}
                            <div class="accordion-content-peserta hidden mt-5 space-y-5">

                                <div>
                                    <label class="text-white text-[18px] tracking-wide">Nomor Handphone</label>
                                    <div class="w-full mt-2 px-4 py-3 rounded-[11px] bg-white/50 text-black font-semibold">
                                        {{ $p_no }}
                                    </div>
                                </div>

                                <div>
                                    <label class="text-white text-[18px] tracking-wide">Email</label>
                                    <div class="w-full mt-2 px-4 py-3 rounded-[11px] bg-white/50 text-black font-semibold">
                                        {{ $p_email }}
                                    </div>
                                </div>

                                <div class="relative">
                                    <label class="text-white text-[18px] tracking-wide">Password</label>

                                    <div class="relative mt-2">
                                        {{-- TAMPILAN MASKED (default) --}}
                                        <span id="pw-text-{{ $i }}"
                                            class="w-full block px-4 py-3 rounded-[11px] bg-white/50 text-black font-semibold select-none">
                                            ********
                                        </span>

                                        {{-- Eye Icon (sama persis seperti peserta.blade) --}}
                                        <svg id="togglePassword{{ $i }}"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer w-6 h-6 text-black z-10"
                                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path id="eyePath{{ $i }}-1" stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.875 18.825A10.015 10.015 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.516-2.583" />
                                            <path id="eyePath{{ $i }}-2" stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.824 7.522 5 12 5c2.478 0 4.75 1.155 6.31 2.915M3 3l18 18" />
                                        </svg>
                                    </div>
                                </div>

                                <div>
                                    <label class="text-white text-[18px] tracking-wide">Jurusan</label>
                                    <div class="w-full mt-2 px-4 py-3 rounded-[11px] bg-white/50 text-black font-semibold">
                                        {{ $p_jurusan }}
                                    </div>
                                </div>

                                <div>
                                    <label class="text-white text-[18px] tracking-wide">Bidang Tujuan</label>
                                    <div class="w-full mt-2 px-4 py-3 rounded-[11px] bg-white/50 text-black font-semibold">
                                        {{ $p_bidang }}
                                    </div>
                                </div>

                            </div>

                        </div>
                        @endforeach

                    </div>

                    {{-- BERKAS TERUNGGAH --}}
                    <div>
                        <label class="text-[20px] font-semibold text-white px-2 mb-3 block">
                            Berkas
                        </label>

                        <div class="bg-[#222] rounded-2xl px-10 py-8 shadow-md border border-white/5">

                            @php
                            $firstItem = !empty($berkas) ? reset($berkas) : null;
                            $firstKey = !empty($berkas) ? array_key_first($berkas) : null;
                            @endphp

                            {{-- HEADER ACCORDION --}}
                            <div class="relative flex items-start cursor-pointer accordion-btn-berkas">
                                <div class="w-full">
                                    <label class="text-white text-[18px] tracking-wide block mb-2">
                                        {{ $firstItem['label'] ?? 'Berkas Terunggah' }}
                                    </label>

                                    <div class="w-full px-4 py-3 rounded-[11px] bg-white/50 
                                        text-black font-poppins font-semibold">
                                        {{ $firstItem['file'] ?? 'Belum ada berkas' }}
                                    </div>
                                </div>

                                <svg class="w-6 h-6 text-white absolute right-2 -translate-y-1/2 
                                    transition-transform accordion-arrow-berkas"
                                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            {{-- DETAIL CONTENT --}}
                            <div class="accordion-content-berkas hidden mt-5 space-y-5">

                                @foreach ($berkas as $key => $item)
                                @continue($key === $firstKey)

                                <div>
                                    <label class="text-white text-[18px] tracking-wide">
                                        {{ $item['label'] }}
                                    </label>

                                    <div class="w-full mt-2 px-4 py-3 rounded-[11px] bg-white/50 
                                        text-black font-semibold">
                                        {{ $item['file'] }}
                                    </div>
                                </div>
                                @endforeach

                            </div>

                        </div>
                    </div>

                </div>

                {{-- BUTTONS --}}
                <div class="max-w-[780px] mx-auto mt-11 mb-4 flex justify-end gap-4">
                    <a href="{{ route('pendaftaran.berkas', $slug) }}"
                        class="px-7 py-2 rounded-[10px] bg-red-600 hover:bg-red-700 text-white font-semibold">
                        Kembali
                    </a>

                    <form method="POST" action="{{ route('pendaftaran.finalSubmit', $slug) }}">
                        @csrf
                        <button type="submit"
                            class="px-7 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white
                            font-semibold shadow-lg">
                            Submit
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- JS ACCORDION --}}
@push('scripts')
<script>
    // Peserta
    document.querySelectorAll('.accordion-btn-peserta').forEach((btn) => {
        btn.addEventListener('click', () => {
            const content = btn.nextElementSibling;
            const arrow = btn.querySelector('.accordion-arrow-peserta');

            content.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        });
    });

    // Pemohon
    document.querySelectorAll('.accordion-btn-pemohon').forEach((btn) => {
        btn.addEventListener('click', () => {
            const content = btn.nextElementSibling;
            const arrow = btn.querySelector('.accordion-arrow-pemohon');

            content.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        });
    });

    // Berkas
    document.querySelector('.accordion-btn-berkas')?.addEventListener('click', function() {
        const content = this.nextElementSibling;
        const arrow = this.querySelector('.accordion-arrow-berkas');

        content.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    });

    // Ambil array password asli dari PHP (index sesuai $i)
    const realPasswords = JSON.parse(`{!! json_encode(array_column($pesertaList ?? [], 'password')) !!}`);

    // Pasang listener untuk semua eye icon di review
    document.querySelectorAll('[id^="togglePassword"]').forEach(svg => {
        svg.addEventListener('click', function() {
            const id = this.id; // ex: "togglePassword0"
            const idx = id.replace('togglePassword', ''); // "0"
            const textEl = document.getElementById('pw-text-' + idx);

            const path1 = document.getElementById(`eyePath${idx}-1`);
            const path2 = document.getElementById(`eyePath${idx}-2`);

            if (!textEl) return;

            // Jika sedang ter-mask (tampil ********) -> show real password
            if (textEl.textContent.trim() === '********') {
                // tampilkan password asli (atau '-' jika kosong)
                textEl.textContent = (realPasswords && realPasswords[idx]) ? realPasswords[idx] : '-';

                // ubah icon ke "mata bulat" (show) — sama d-values seperti peserta.blade
                if (path1) path1.setAttribute('d', 'M15 12a3 3 0 11-6 0 3 3 0 016 0z');
                if (path2) path2.setAttribute('d', 'M2.458 12C3.732 7.824 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.076-5.064 7-9.542 7s-8.268-2.924-9.542-7z');
            } else {
                // kembalikan ke masked
                textEl.textContent = '********';

                // restore icon ke keadaan "hide" (garis silang ada)
                if (path1) path1.setAttribute('d', 'M13.875 18.825A10.015 10.015 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.516-2.583');
                if (path2) path2.setAttribute('d', 'M2.458 12C3.732 7.824 7.522 5 12 5c2.478 0 4.75 1.155 6.31 2.915M3 3l18 18');
            }
        });
    });
</script>
@endpush

@endsection