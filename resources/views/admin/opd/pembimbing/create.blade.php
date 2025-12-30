@extends('layout.admin-layout')

@section('title', 'Tambah Pembimbing - Admin OPD')
@section('header-title', 'Tambah Pembimbing')

@section('content')
<div class="text-white min-h-screen space-y-6">

    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl">
        <h1 class="text-[#0554F2] text-4xl font-bold">Pembimbing</h1>
    </div>

    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl relative">
        <h2 class="text-2xl font-semibold text-white mb-8">Tambah Akun Pembimbing</h2>

        <form action="{{ route('opd.pembimbing.store') }}" method="POST"> 
            @csrf
            <div class="space-y-4">
                {{-- Nama --}}
                <div class="space-y-2">
                    <label class="block text-white font-semibold text-lg">Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required
                           class="w-full bg-white/60 placeholder-black/50 text-black px-4 py-2 rounded-[10px] font-normal focus:outline-none">
                </div>

                {{-- Email --}}
                <div class="space-y-2">
                    <label class="block text-white font-semibold text-lg">Email</label>
                    <input type="email" name="email" placeholder="Masukkan Email" required
                           class="w-full bg-white/60 placeholder-black/50 text-black px-4 py-2 rounded-[10px] font-normal focus:outline-none">
                </div>

                {{-- Password --}}
                <div class="space-y-2">
                    <label class="block text-white font-semibold text-lg">Password</label>
                    <div class="relative w-full">
                        <input type="password" id="inputPassword" name="password" placeholder="Masukkan Password" required
                               class="w-full bg-white/60 placeholder-black/50 text-black px-4 py-2 rounded-[10px] font-normal focus:outline-none pr-12">
                        
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center pr-4 z-10 cursor-pointer">
                            <img id="iconEyeOpen" src="{{ asset('vector/Eye.svg') }}" class="w-6 h-6 block" alt="Show">
                            <img id="iconEyeClose" src="{{ asset('vector/Eye off.svg') }}" class="w-6 h-6 hidden" alt="Hide">
                        </button>
                    </div>
                </div>

                {{-- Bidang --}}
                <div class="space-y-2">
                    <label class="block text-white font-semibold text-lg">Bidang</label>
                    <input type="text" name="bidang" placeholder="Masukkan Bidang" required
                           class="w-full bg-white/60 placeholder-black/50 text-black px-4 py-2 rounded-[10px] font-normal focus:outline-none">
                </div>
            </div>

            {{-- BUTTONS --}}
            <div class="flex justify-end gap-4 mt-8">
                <a href="{{ route('opd.pembimbing.index') }}" 
                   class="px-6 py-2 bg-[#CC0000] text-white w-[135px] text-lg font-semibold rounded-[15px] text-center flex items-center justify-center hover:bg-red-700 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-[#0554F2] text-white w-[135px] text-lg font-semibold rounded-[15px] text-center flex items-center justify-center hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Load JS --}}
@vite(['resources/js/pembimbing-handler.js'])
@endsection