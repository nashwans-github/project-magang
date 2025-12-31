@extends('layout.pendaftaran-layout')

@section('title', 'Data Diri Peserta')

@section('content')
<div class="min-h-screen bg-black text-white">
    <div class="pt-0">

        {{-- HEADER --}}
        <header id="formHeader" class="w-full bg-white/60 backdrop-blur-md shadow">
            <div class="max-w-7xl mx-auto flex items-center justify-between py-5 px-6">
                <div class="flex items-center space-x-3">
                    <img src="/images/logo-pemkot.png" class="w-10" alt="Logo">
                    <span class="font-bold text-[#031CFC] text-[15px] tracking-wide" style="font-family: 'Poppins', sans-serif;">
                        PEMERINTAH KOTA SURABAYA
                    </span>
                </div>

                <div class="text-[#010D96] text-[19px] font-semibold tracking-wide">
                    Formulir Pendaftaran Magang
                </div>
            </div>
        </header>

        {{-- PROGRESS --}}
        <div class="max-w-6xl mx-auto mt-10 relative">

            {{-- GARIS TOTAL --}}
            <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[480px] h-[4px] bg-gray-600 rounded-full"></div>

            {{-- GARIS BIRU DARI STEP 1 → STEP 2 --}}
            <div class="absolute top-10 left-1/2 -translate-x-[240px] h-[4px] bg-[#0554F2] rounded-full transition-all duration-500"
                style="width: 210px;"></div>

            <div class="flex justify-center gap-12 relative z-10">
                @php
                $labels = ['Data Diri<br>Pemohon','Data Diri<br>Peserta','Upload<br>Berkas','Review<br>Pengajuan'];
                @endphp

                @foreach ([1,2,3,4] as $i)
                <div class="flex flex-col items-center">

                    {{-- LINGKARAN STEP --}}
                    <div class="step-circle w-20 h-20 rounded-full flex items-center justify-center shadow-xl
                    {{ $i <= 2 ? 'bg-[#0554F2]' : 'bg-gray-600' }}"
                        data-step="{{ $i }}">
                        <img src="/vector/{{ $i }}.svg"
                            class="max-w-[55%] max-h-[55%] object-contain" />
                    </div>

                    {{-- LABEL --}}
                    <p class="mt-3 text-sm text-gray-300 text-center leading-tight">
                        {!! $labels[$i-1] !!}
                    </p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- FORM CONTAINER --}}
        <div class="flex justify-center py-14">
            <div class="bg-black/90 backdrop-blur-xl max-w-[1000px] w-full mx-auto rounded-[40px] pb-20 border border-white/10 shadow-[0_0_60px_#FBCD35,_0_0_250px_#FBCD3540,_0_0_400px_#FBCD3520]">

                <h1 class="text-center text-[36px] font-semibold text-[#0554F2] mt-12 mb-8">Data Diri Peserta Magang</h1>

                {{-- Form peserta (POST ke peserta.store) --}}
                <form id="formPeserta" method="POST" action="{{ route('pendaftaran.step2.store', $instansi['slug']) }}">
                    @csrf

                    @php
                    // Ambil data peserta dari session
                    $savedPeserta = session('pendaftaran.step2', []);

                    // Kalau kosong, tampilkan default 1 peserta
                    if (empty($savedPeserta)) {
                    $savedPeserta = [
                    ['nama' => '', 'nomor' => '', 'email' => '', 'jurusan' => '', 'bidang_tujuan' => '', 'password' => '']
                    ];
                    }

                    $fieldClassPeserta = "w-full mt-2 px-4 py-3 rounded-[11px] bg-white/50 text-black font-medium
                    placeholder:text-black/50 focus:outline-none focus:ring-0 border-none";
                    @endphp

                    <div id="pesertaContainer" class="space-y-5">
                        @foreach($savedPeserta as $index => $p)
                        <div class="bg-[#222] rounded-xl p-10 pb-12 mx-auto max-w-[780px] peserta-item" data-index="{{ $index }}">

                            {{-- Header Peserta --}}
                            <div class="flex justify-between items-center cursor-pointer toggle-btn peserta-header">

                                {{-- JUDUL --}}
                                <h2 class="text-[20px] font-poppins font-semibold text-white peserta-title">
                                    Peserta {{ $index + 1 }}
                                </h2>

                                {{-- RIGHT ACTIONS --}}
                                <div class="flex items-center gap-3 peserta-actions">

                                    {{-- TOMBOL HAPUS --}}
                                    <button type="button"
                                        class="delete-btn bg-red-600 hover:bg-red-700
                                        px-4 py-2 rounded-lg
                                        text-white font-semibold
                                        flex items-center justify-center
                                        {{ $index === 0 ? 'invisible' : '' }}">

                                        <img src="/vector/sampah.svg" alt="Hapus" class="w-5 h-5">
                                    </button>

                                    {{-- ARROW --}}
                                    <div class="w-10 h-10 flex items-center justify-center">
                                        <svg class="w-6 h-6 arrow-anim text-white
                                            transform transition-transform
                                            {{ $index === 0 ? 'rotate-180' : '' }}"
                                            fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>

                                </div>
                            </div>

                            <div class="form-content mt-6 space-y-6">

                                {{-- Nama --}}
                                <div>
                                    <label class="text-white text-lg">Nama</label>
                                    <input type="text" name="peserta[{{ $index }}][nama]"
                                        value="{{ $p['nama'] ?? '' }}"
                                        placeholder="Masukkan nama lengkap"
                                        class="{{ $fieldClassPeserta }}">
                                </div>

                                {{-- Nomor Hp --}}
                                <div>
                                    <label class="text-white text-lg">Nomor Handphone</label>
                                    <input type="text" name="peserta[{{ $index }}][nomor]"
                                        value="{{ $p['nomor'] ?? '' }}"
                                        placeholder="08xxxxxxxxxx"
                                        class="{{ $fieldClassPeserta }}">
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label class="text-white text-lg">Email</label>
                                    <input type="email" name="peserta[{{ $index }}][email]"
                                        value="{{ $p['email'] ?? '' }}"
                                        placeholder="contoh@email.com"
                                        class="{{ $fieldClassPeserta }}">
                                </div>

                                {{-- Password --}}
                                <div class="relative">
                                    <label class="text-white text-lg">Password</label>
                                    <input type="password"
                                        id="passwordInput{{ $index }}"
                                        name="peserta[{{ $index }}][password]"
                                        value="{{ $p['password'] ?? '' }}"
                                        placeholder="Masukkan password"
                                        class="{{ $fieldClassPeserta }} pr-12">

                                    {{-- Eye Icon --}}
                                    <svg id="togglePassword{{ $index }}"
                                        class="absolute right-3 top-1/2 mt-[18px] transform -translate-y-1/2 cursor-pointer w-6 h-6 text-black z-10"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path id="eyePath{{ $index }}-1" stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.875 18.825A10.015 10.015 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.516-2.583" />
                                        <path id="eyePath{{ $index }}-2" stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.824 7.522 5 12 5c2.478 0 4.75 1.155 6.31 2.915M3 3l18 18" />
                                    </svg>
                                </div>

                                {{-- Jurusan --}}
                                <div>
                                    <label class="text-white text-lg">Jurusan</label>
                                    <input type="text"
                                        name="peserta[{{ $index }}][jurusan]"
                                        value="{{ $p['jurusan'] ?? '' }}"
                                        placeholder="Masukkan jurusan"
                                        class="{{ $fieldClassPeserta }}">
                                </div>

                                {{-- Bidang Tujuan --}}
                                <div>
                                    <label class="text-white text-lg">Bidang Tujuan</label>
                                    <select name="peserta[{{ $index }}][bidang_tujuan]"
                                        class="{{ $fieldClassPeserta }} bidang-tujuan pr-10" required>

                                        <option value="" disabled hidden {{ empty($p['bidang_tujuan']) ? 'selected' : '' }}>Pilih bidang tujuan</option>

                                        @foreach($bidangOptions as $bidang)
                                        <option value="{{ $bidang }}" {{ ($p['bidang_tujuan'] ?? '') == $bidang ? 'selected' : '' }}>
                                            {{ $bidang }}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>

                    {{-- Tambah peserta --}}
                    <button type="button" id="addPesertaBtn"
                        class="mt-6 mx-auto max-w-[780px] w-full px-4 py-4 rounded-xl 
                        border border-dashed border-white flex items-center 
                        gap-3 text-black bg-[#999999] opacity-60 hover:bg-[#c4c4c4] transition">
                        <img src="/vector/tambah.svg" class="w-6 h-6" alt="Tambah"> Tambah Anggota Magang
                    </button>


                    {{-- Navigation --}}
                    <div class="max-w-3xl mx-auto mt-10 flex justify-end gap-4">
                        <a href="{{ route('pendaftaran.pemohon', $instansi['slug']) }}" class="px-7 py-2 rounded-[10px] bg-red-600 hover:bg-[#F20509] text-white font-semibold">Kembali</a>

                        <button type="submit" class="px-7 py-2 rounded-[10px] bg-blue-600 hover:bg-[#0554F2] text-white font-semibold shadow-lg">
                            Lanjutkan
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

<style>
    input::placeholder,
    select::placeholder {
        color: rgba(0, 0, 0, 0.3);
    }

    .bidang-tujuan {
        color: rgba(0, 0, 0, 0.5);
    }

    .form-content.hidden {
        display: none;
    }

    button#addPesertaBtn {
        width: 100%;
    }
</style>

<style>
    .peserta-item.collapsed {
        padding-top: 20px !important;
        padding-bottom: 20px !important;
    }

    .peserta-item.collapsed .form-content {
        display: none !important;
        margin-top: 0 !important;
        padding: 0 !important;
    }

    /* default: form TERBUKA → arrow ke atas */
    .peserta-item .arrow-anim {
        transform: rotate(180deg);
        transition: transform 0.3s ease;
    }

    /* saat card CLOSED */
    .peserta-item.collapsed .arrow-anim {
        transform: rotate(0deg);
    }


    select.bidang-tujuan {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: none;
    }
</style>

@push('scripts')

<script>
    window.bidangOptions = JSON.parse(`@json($bidangOptions)`);
</script>

<script>
    (function() {
        // Utilities
        function qs(selector, el = document) {
            return el.querySelector(selector);
        }

        function qsa(selector, el = document) {
            return Array.from(el.querySelectorAll(selector));
        }

        function setToggle(btn) {
            btn.addEventListener('click', function() {
                const card = this.closest('.peserta-item');
                card.classList.toggle('collapsed');
            });
        }

        // Toggle password visibility
        function setupPasswordToggle(inputID, toggleID) {
            const toggle = document.getElementById(toggleID);
            const input = document.getElementById(inputID);
            if (!toggle || !input) return;
            toggle.addEventListener('click', function() {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                const path1 = qs(`#eyePath${toggleID.replace('togglePassword','')}-1`, toggle) || qs(`#eyePath${inputID.slice(-1)}-1`, toggle);
                const path2 = qs(`#eyePath${toggleID.replace('togglePassword','')}-2`, toggle) || qs(`#eyePath${inputID.slice(-1)}-2`, toggle);
                if (type === 'text') {
                    if (path1) path1.setAttribute('d', 'M15 12a3 3 0 11-6 0 3 3 0 016 0z');
                    if (path2) path2.setAttribute('d', 'M2.458 12C3.732 7.824 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.076-5.064 7-9.542 7s-8.268-2.924-9.542-7z');
                } else {
                    if (path1) path1.setAttribute('d', 'M13.875 18.825A10.015 10.015 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.516-2.583');
                    if (path2) path2.setAttribute('d', 'M2.458 12C3.732 7.824 7.522 5 12 5c2.478 0 4.75 1.155 6.31 2.915M3 3l18 18');
                }
            });
        }

        // Placeholder style for select
        function setupPlaceholderStyle(selectEl) {
            // Tambahkan placeholder warna abu-abu di awal
            selectEl.style.color = selectEl.value ? "black" : "rgba(0,0,0,0.5)";

            selectEl.addEventListener("change", () => {
                // Jika user sudah memilih → teks select jadi hitam
                selectEl.style.color = "black";
            });

            // Pastikan semua opsi tetap hitam (override)
            selectEl.querySelectorAll("option").forEach(opt => {
                opt.style.color = "black";
            });
        }

        // Re-number peserta and rename names dynamically
        function reindexPeserta() {
            qsa('.peserta-item').forEach((card, idx) => {
                card.dataset.index = idx;
                const title = qs('.peserta-title', card);
                if (title) title.textContent = `Peserta ${idx + 1}`;

                const del = qs('.delete-btn', card);
                if (del) del.style.display = (idx === 0) ? 'none' : 'inline-block';
            });
        }

        // Init existing peserta
        function initExisting() {
            qsa('.toggle-btn').forEach(setToggle);
            qsa('[id^="togglePassword"]').forEach(el => {
                const id = el.id;
                const num = id.replace('togglePassword', '');
                setupPasswordToggle('passwordInput' + num, id);
            });
            qsa('.bidang-tujuan').forEach(setupPlaceholderStyle);
            qsa('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const card = this.closest('.peserta-item');
                    card.remove();
                    reindexPeserta();
                });
            });
        }

        // Add peserta logic
        const addBtn = document.getElementById('addPesertaBtn');
        addBtn.addEventListener('click', () => {
            const container = document.getElementById('pesertaContainer');
            const newIndex = container.children.length;

            // FIX: gunakan list yang sama seperti Blade
            const ops = window.bidangOptions || [];

            const card = document.createElement('div');
            card.className = 'bg-[#222] rounded-xl p-10 pb-12 mx-auto max-w-[780px] peserta-item';
            card.dataset.index = newIndex;

            // Build inner HTML (use template literals)
            card.innerHTML = `
            <div class="flex justify-between items-center cursor-pointer toggle-btn">

                <h2 class="text-[20px] font-poppins font-semibold text-white peserta-title">
                    Peserta ${newIndex + 1}
                </h2>

                <div class="flex items-center gap-3">
                    <button type="button"
                        class="delete-btn bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-white font-semibold flex items-center gap-2">
                        <img src="/vector/sampah.svg" class="w-5 h-5" alt="Hapus">
                    </button>

                    <div class="cursor-pointer toggle-btn">
                        <svg class="w-6 h-6 transform transition-transform arrow-anim text-white"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>

            </div>

            <div class="form-content mt-6 space-y-6">
        
                <!-- NAMA -->
                <div>
                    <label class="text-white text-lg">Nama</label>
                    <input type="text" name="peserta[${newIndex}][nama]"
                        placeholder="Masukkan nama lengkap"
                        class="w-full mt-2 px-4 py-3 rounded-[11px] bg-white/50
                                text-black font-medium placeholder:text-black/50
                                focus:outline-none focus:ring-0 border-none
                                ${window.fieldClassPeserta}">
                </div>

                <!-- NOMOR HP -->
                <div>
                    <label class="text-white text-lg">Nomor Handphone</label>
                    <input type="text" name="peserta[${newIndex}][nomor]"
                        placeholder="08xxxxxxxxxx"
                        class="w-full mt-2 px-4 py-3 rounded-[11px] bg-white/50
                                text-black font-medium placeholder:text-black/50
                                focus:outline-none focus:ring-0 border-none
                                ${window.fieldClassPeserta}">
                </div>

                <!-- EMAIL -->
                <div>
                    <label class="text-white text-lg">Email</label>
                    <input type="email" name="peserta[${newIndex}][email]"
                        placeholder="contoh@email.com"
                        class="w-full mt-2 px-4 py-3 rounded-[11px] bg-white/50
                                text-black font-medium placeholder:text-black/50
                                focus:outline-none focus:ring-0 border-none
                                ${window.fieldClassPeserta}">
                </div>

                <!-- PASSWORD -->
                <div class="relative">
                    <label class="text-white text-lg">Password</label>

                    <input type="password"
                        id="passwordInput${newIndex+1}"
                        name="peserta[${newIndex}][password]"
                        placeholder="Masukkan password"
                        class="w-full mt-2 px-4 py-3 rounded-[11px] bg-white/50
                            text-black font-medium placeholder:text-black/50
                            focus:outline-none focus:ring-0 border-none pr-12
                            ${window.fieldClassPeserta}">

                    <svg id="togglePassword${newIndex+1}"
                        class="absolute right-3 top-1/2 mt-[18px] transform -translate-y-1/2
                            cursor-pointer w-6 h-6 text-black z-10"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                            <path id="eyePath${newIndex+1}-1"
                                stroke-linecap="round" stroke-linejoin="round"
                                d="M13.875 18.825A10.015 10.015 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.516-2.583"/>
                            <path id="eyePath${newIndex+1}-2"
                                stroke-linecap="round" stroke-linejoin="round"
                                d="M2.458 12C3.732 7.824 7.522 5 12 5c2.478 0 4.75 1.155 6.31 2.915M3 3l18 18"/>
                    </svg>
                </div>

                <!-- JURUSAN -->
                <div>
                    <label class="text-white text-lg">Jurusan</label>
                    <input type="text" name="peserta[${newIndex}][jurusan]"
                        placeholder="Masukkan jurusan"
                        class="w-full mt-2 px-4 py-3 rounded-[11px] bg-white/50
                                text-black font-medium placeholder:text-black/50
                                focus:outline-none focus:ring-0 border-none
                                ${window.fieldClassPeserta}">
                </div>

                <!-- BIDANG TUJUAN -->
                <div>
                    <label class="text-white text-lg">Bidang Tujuan</label>

                    <select name="peserta[${newIndex}][bidang_tujuan]"
                        class="w-full mt-2 px-4 py-3 rounded-[11px] bg-white/50
                            text-black font-medium bidang-tujuan pr-10
                            appearance-none
                            focus:outline-none focus:ring-0 focus:border-transparent border-none
                            ${window.fieldClassPeserta}"
                        required>
                        
                        <option value="" disabled hidden selected>Pilih bidang tujuan</option>

                        ${ops.map(op => `
                            <option value="${op}">${op}</option>
                        `).join('')}
                    </select>
                </div>

            </div>
        `;

            container.appendChild(card);

            reindexPeserta();
            setToggle(qs('.toggle-btn', card));
            setupPasswordToggle('passwordInput' + (newIndex + 1), 'togglePassword' + (newIndex + 1));
            setupPlaceholderStyle(qs('.bidang-tujuan', card));

            qs('.delete-btn', card).addEventListener('click', function() {
                card.remove();
                reindexPeserta();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            initExisting();
            reindexPeserta();
        });

    })();
</script>
@endpush

@endsection