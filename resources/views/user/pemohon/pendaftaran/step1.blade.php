@extends('layout.pendaftaran-layout')

@section('title', 'Pendaftaran Magang')

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
            <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[480px] h-[4px] bg-gray-600 rounded-full"></div>
            <div id="progressLine" class="absolute top-10 left-1/2 -translate-x-1/2 h-[4px] bg-[#0554F2] rounded-full transition-all duration-500" style="width: 0px;"></div>

            <div class="flex justify-center gap-12 relative z-10">
                @php
                $labels = ['Data Diri<br>Pemohon','Data Diri<br>Peserta','Upload<br>Berkas','Review<br>Pengajuan'];
                @endphp

                @foreach ([1,2,3,4] as $i)
                <div class="flex flex-col items-center">
                    <div class="step-circle w-20 h-20 rounded-full flex items-center justify-center shadow-xl 
                        {{ $i === 1 ? 'bg-[#0554F2]' : 'bg-gray-600' }}" data-step="{{ $i }}">
                        <img src="/vector/{{ $i }}.svg" class="max-w-[55%] max-h-[55%] object-contain" />
                    </div>
                    <p class="mt-3 text-sm text-gray-300 text-center leading-tight">{!! $labels[$i-1] !!}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- FORM CONTAINER --}}
        <div class="flex justify-center py-14">
            <div class="bg-black/90 backdrop-blur-xl max-w-[1000px] w-full mx-auto rounded-[40px] pb-20 border border-white/10 shadow-[0_0_60px_#FBCD35,_0_0_250px_#FBCD3540,_0_0_400px_#FBCD3520]">

                <h1 class="text-center text-[36px] font-semibold text-[#0554F2] mt-12 mb-8">
                    Data Diri Pemohon Magang
                </h1>

                <div class="bg-[#222] rounded-xl p-10 pb-16 mx-auto max-w-[780px]">

                    {{-- FIXED FORM ACTION --}}
                    <form id="formPemohon" method="POST" action="{{ route('pendaftaran.step1.store', $instansi['slug']) }}" class="space-y-6">
                        @csrf

                        @php
                        $fieldClass = "w-full mt-2 px-4 py-3 rounded-[11px] bg-white/50 text-black font-semibold placeholder:text-black/50 focus:outline-none focus:ring-0 focus:border-none";
                        @endphp

                        {{-- Nama --}}
                        <div>
                            <label for="nama" class="text-white text-lg">Nama</label>
                            <input type="text" id="nama" name="nama"
                                value="{{ old('nama', $oldData['nama'] ?? '') }}"
                                placeholder="Masukkan nama lengkap"
                                class="{{ $fieldClass }} @error('nama') border-red-500 @enderror"
                                required>
                            @error('nama') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Telepon --}}
                        <div>
                            <label for="telepon" class="text-white text-lg">Nomor Handphone</label>
                            <input type="text" id="telepon" name="telepon"
                                value="{{ old('telepon', $oldData['telepon'] ?? '') }}"
                                placeholder="08xxxxxxxxxx"
                                class="{{ $fieldClass }} @error('telepon') border-red-500 @enderror"
                                required>
                            @error('telepon') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="text-white text-lg">Email</label>
                            <input type="email" id="email" name="email"
                                value="{{ old('email', $oldData['email'] ?? '') }}"
                                placeholder="contoh@email.com"
                                class="{{ $fieldClass }} @error('email') border-red-500 @enderror"
                                required>
                            @error('email') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Instansi --}}
                        <div>
                            <label for="instansi" class="text-white text-lg">Asal Instansi</label>
                            <input type="text" id="instansi" name="instansi"
                                value="{{ old('instansi', $oldData['instansi'] ?? '') }}"
                                placeholder="Nama kampus / sekolah"
                                class="{{ $fieldClass }} @error('instansi') border-red-500 @enderror"
                                required>
                            @error('instansi') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Dinas Tujuan --}}
                        <div>
                            <label for="dinas" class="text-white text-lg">Dinas Tujuan</label>
                            <input type="text" id="dinas" name="dinas" value="{{ $instansi['name'] }}" readonly
                                class="{{ $fieldClass }} pointer-events-none">
                        </div>

                        {{-- Tanggal --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="tanggal_mulai" class="text-white text-lg">Tanggal Mulai</label>
                                <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                    value="{{ old('tanggal_mulai', $oldData['tanggal_mulai'] ?? '') }}"
                                    class="{{ $fieldClass }} {{ old('tanggal_mulai') ? '' : 'empty' }}"
                                    required>
                            </div>

                            <div>
                                <label for="tanggal_selesai" class="text-white text-lg">Tanggal Selesai</label>
                                <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                                    value="{{ old('tanggal_selesai', $oldData['tanggal_selesai'] ?? '') }}"
                                    class="{{ $fieldClass }} {{ old('tanggal_selesai') ? '' : 'empty' }}"
                                    required>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="w-full flex justify-end gap-4 pt-5">
                            <a href="{{ route('user.pemohon.instansi.homeinstansi', $instansi['slug'] ?? $slug) }}" class="px-6 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold">
                                Kembali
                            </a>
                            <button type="submit" class="px-6 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold">
                                Lanjutkan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    input::placeholder,
    select::placeholder {
        color: rgba(0, 0, 0, 0.3);
    }

    select {
        appearance: none;
        background-image: none !important;
    }

    select::-ms-expand {
        display: none;
    }

    input[type="date"].empty {
        color: rgba(0, 0, 0, 0.35);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('input[type="date"]').forEach(function(input) {
            function update() {
                if (!input.value) input.classList.add('empty');
                else input.classList.remove('empty');
            }
            update();
            input.addEventListener('change', update);
        });
    });
</script>

@endsection