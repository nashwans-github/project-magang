@extends('layout.auth-layout')

@section('title', 'Verifikasi Akun')

@section('content')

<div class="flex items-center justify-center min-h-screen px-4 py-20 relative">

    {{-- TOMBOL PANAH DI LUAR CARD --}}
    <a href="/login" class="absolute top-5 left-5 z-[9999]">
        <img src="{{ asset('vector/back.svg') }}" class="w-8" alt="Back">
    </a>

    {{-- CARD UTAMA (MENGGUNAKAN max-w UNTUK KONSISTENSI LEBAR) --}}
    <div class="bg-black/90 backdrop-blur-xl w-full max-w-[620px] rounded-3xl p-10 border border-white/10 shadow-[0_0_60px_#FBCD35FF,_0_0_250px_#FBCD3540,_0_0_400px_#FBCD3520]">

        {{-- LOGO dan TITLE (Tidak Berubah) --}}
        <div class="flex items-center gap-3 mb-6 mt-4">
            <img src="/images/logo-pemkot.png" class="w-12" alt="Logo">
            <h1 class="text-[16px] text-[#031CFC]/100 font-poppins font-bold uppercase text-[18] tracking-wide">
                Pemerintah Kota Surabaya
            </h1>
        </div>
        <h2 class="text-[42px] text-[#0554F2] font-poppins font-[799] ">Verifikasi Reset Password</h2>
        <div class="mb-1"></div>
        <p class="text-[18] font-poppins text-[#FFFFFF]/100 mb-8">Masukkan email untuk dikirim kode OTP</p>

        {{-- FORM --}}
        <form action="#" method="POST" class="space-y-4">
            @csrf {{-- Tambahkan CSRF Token --}}

            {{-- Input Email --}}
            <div>
                <label class="text-[#FFFFFF]/100 text-[18] font-poppins">Email</label>
                <input type="text"
                    class="w-full mt-1 px-4 py-3 rounded-[11px] bg-white/50 font-poppins font-[600] focus:outline-none">
            </div>

            {{-- Kode OTP (Layout Dibongkar untuk Proporsi yang Benar) --}}
            <div>
                <label class="text-[#FFFFFF]/100 text-[18] font-poppins">Kode OTP</label>

                <div class="flex items-center gap-3 mt-1">
                    <input type="text"
                        {{-- **TAMBAH:** flex-grow agar input mengisi sisa ruang --}}
                        class="w-full flex-grow px-4 py-3 rounded-[11px] bg-white/50 font-poppins font-[600] focus:outline-none">

                    <button type="button"
                        {{-- **TAMBAH:** flex-shrink-0 agar tombol mempertahankan lebar yang ditentukan (px-9) --}}
                        class="flex-shrink-0 px-9 py-3 rounded-[11px] bg-[#0554F2]/60 text-white font-poppins font-[600] text-[18px]">
                        Kirim
                    </button>
                </div>
            </div>

            <a href="/reset-password"
                class="block text-center w-full !mt-14 px-4 py-3 rounded-[13px] bg-[#0554F2] text-[#FFFFFF] text-[23px] font-poppins font-[600]">
                Lanjutkan
            </a>
        </form>
        </form>
    </div>
</div>

@endsection