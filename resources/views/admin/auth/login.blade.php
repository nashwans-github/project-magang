@extends('layout.admin-auth-layout')

@section('title', 'Admin Login')

@section('content')

{{-- Background Image dengan Overlay --}}
<div class="min-h-screen flex flex-col items-center justify-center pt-10 pb-10 relative overflow-hidden bg-cover bg-center"
     style="background-image: url('{{ asset('images/bg-admin-login.png') }}');">

    <h1 class="text-[#0554F2] font-bold font-poppins tracking-wide text-[23px] mb-12 text-center relative z-10 drop-shadow-lg shadow-black">
        SISTEM PENDAFTARAN, MONITORING, DAN PENILAIAN MAGANG
    </h1>

    <div class="w-[1226px] max-w-[95%] h-[648px] rounded-[45px] bg-black/80 backdrop-blur-md border border-white/10 shadow-[0_0_60px_#FBCD35FF,_0_0_100px_#FBCD3540,_0_0_100px_#FBCD3520] flex items-center relative z-10 overflow-hidden">

        {{-- LOGO KIRI --}}
        <div class="w-1/2 hidden md:flex items-center justify-start pl-32">
            <img src="{{ asset('vector/logo-surabaya-hitam.svg') }}" class="w-[300px] max-w-none translate-x-10 drop-shadow-2xl">
        </div>

        {{-- FORM LOGIN --}}
        <form action="{{ route('admin.login.process') }}" method="POST" 
              class="w-full md:w-[600px] h-full md:h-[560px] ml-auto md:mr-10 bg-black rounded-[45px] px-8 md:px-20 py-14 flex flex-col justify-center"
              style="box-shadow: inset 0 0 0 0.5px #2D2D2D, 0 0 20px #2D2D2D, 0 0 70px #2D2D2D, 0 0 10px #2D2D2D;">
            
            @csrf 

            <div class="flex flex-col items-center mb-8">
                <img src="{{ asset('images/logo-pemkot.png') }}" class="w-16 mb-3">
                <h2 class="text-[#0554F2] font-poppins text-[22px] font-bold">Admin Login</h2>
            </div>

            @if(session('error'))
                <div class="bg-red-500/20 border border-red-500 text-red-200 px-4 py-2 rounded-lg mb-4 text-sm text-center font-poppins">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Email --}}
            <div class="mb-5">
                <label class="text-[#FFFFFF] text-[18] font-poppins">Email</label>
                <input type="email" name="email" required class="w-full mt-1 px-4 py-3 text-black rounded-[11px] bg-white/60 font-poppins font-[600] focus:outline-none focus:ring-2 focus:ring-[#0554F2]">
            </div>

            {{-- Password --}}
            <div class="mb-8 relative">
                <label class="text-white text-[18px] font-poppins">Password</label>
                {{-- ID: newPassword --}}
                <input id="newPassword" type="password" name="password" required class="w-full mt-1 px-4 py-3 pr-12 text-black rounded-[11px] bg-white/60 font-poppins font-[600] focus:outline-none focus:ring-2 focus:ring-[#0554F2]">

                {{-- Ikon Mata (Updated untuk JS Reusable) --}}
                {{-- TARGET: newPassword --}}
                <svg data-password-toggle="newPassword" class="absolute right-4 top-[68%] -translate-y-1/2 cursor-pointer w-6 h-6 text-black z-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.015 10.015 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.516-2.583" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.824 7.522 5 12 5c2.478 0 4.75 1.155 6.31 2.915M3 3l18 18" />
                </svg>
            </div>
            
            <button type="submit" class="w-full mt-2 px-4 py-3 rounded-[13px] bg-[#0554F2] hover:bg-blue-700 transition-colors text-white text-[23px] font-poppins font-[600] shadow-lg shadow-blue-500/30">
                Masuk
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
{{-- Import JS Reusable --}}
<script type="module">
    // Pastikan path ini sesuai dengan lokasi file JS Abang
    import { initPasswordToggle } from "{{ Vite::asset('resources/js/auth/password-toggle.js') }}";

    document.addEventListener('DOMContentLoaded', () => {
        initPasswordToggle();
    });
</script>
@endpush