@extends('layout.auth-layout')

@section('title', 'Reset Akun')

@section('content')

<div class="flex items-center justify-center min-h-screen px-4 py-20 relative">

    {{-- TOMBOL PANAH DI LUAR CARD --}}
    <a href="/lupa-password" class="absolute top-5 left-5 z-[9999]">
        <img src="{{ asset('vector/back.svg') }}" class="w-8" alt="Back">
    </a>

    {{-- CARD UTAMA (TANPA RELATIVE!) --}}
    <div class="bg-black/90 backdrop-blur-xl w-full max-w-[620px] rounded-3xl p-10 border border-white/10 shadow-[0_0_60px_#FBCD35FF,_0_0_250px_#FBCD3540,_0_0_400px_#FBCD3520]">

        {{-- LOGO --}}
        <div class="flex items-center gap-3 mb-6 mt-4">
            <img src="/images/logo-pemkot.png" class="w-12" alt="Logo">
            <h1 class="text-[16px] text-[#031CFC]/100 font-poppins font-bold uppercase text-[18] tracking-wide">
                Pemerintah Kota Surabaya
            </h1>
        </div>

        {{-- TITLE --}}
        <h2 class="text-[42px] text-[#0554F2] font-poppins font-[799] ">Reset password</h2>
        <div class="mb-1">
        </div>
        <p class="text-[18] font-poppins text-[#FFFFFF]/100 mb-8">Buat password baru</p>

        {{-- FORM --}}
        <form action="#" method="POST" class="space-y-4">
            {{-- BARU: Password Baru --}}
            <div class="relative">
                <label class="text-[#FFFFFF]/100 text-[18] font-poppins">Password Baru</label>
                <input type="password" id="newPassword" name="password"
                    class="w-full mt-1 px-4 py-3 rounded-[11px] bg-white/50 font-poppins font-[500] focus:outline-none pr-10">

                {{-- Ikon Mata (Toggle) Password Baru --}}
                <svg data-password-toggle="newPassword" data-target="newPassword"
                    class="absolute right-3 top-[68%] transform -translate-y-1/2 cursor-pointer w-6 h-6 text-black z-10"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    {{-- Mata Tertutup --}}
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.015 10.015 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.516-2.583" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.824 7.522 5 12 5c2.478 0 4.75 1.155 6.31 2.915M3 3l18 18" />
                </svg>
            </div>

            {{-- BARU: Konfirmasi Password Baru --}}
            <div class="relative">
                <label class="text-[#FFFFFF]/100 text-[18] font-poppins">Konfirmasi Password Baru</label>
                <input type="password" id="confirmPassword" name="password_confirmation"
                    class="w-full mt-1 px-4 py-3 rounded-[11px] bg-white/50 font-poppins font-[500] focus:outline-none pr-10">

                {{-- Ikon Mata (Toggle) Konfirmasi Password --}}
                <svg data-password-toggle="confirmPassword" data-target="confirmPassword"
                    class="absolute right-3 top-[68%] transform -translate-y-1/2 cursor-pointer w-6 h-6 text-black z-10"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    {{-- Mata Tertutup --}}
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.015 10.015 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.516-2.583" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.824 7.522 5 12 5c2.478 0 4.75 1.155 6.31 2.915M3 3l18 18" />
                </svg>
            </div>

            <button type="submit"
                class="w-full !mt-14 px-4 py-3 rounded-[13px] bg-[#0554F2] text-[#FFFFFF] py-3 text-[23px] font-poppins font-[600]">
                Kirim
            </button>
        </form>
    </div>
</div>

@endsection