@extends('layout.admin-layout')

@section('title', 'Tambah OPD Baru')
@section('header-title', 'Manajemen OPD')

@section('content')

{{-- CONTAINER UTAMA (Style Asli Dipertahankan) --}}
<div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-2xl rounded-sm min-h-[600px]">

    {{-- JUDUL --}}
    <h2 class="text-[#0066FF] text-3xl font-bold tracking-wide mb-4">
        Manajemen OPD
    </h2>
    <div class="border-b border-white/70 mb-6"></div>

    {{-- SUB-JUDUL --}}
    <h3 class="text-white text-2xl font-semibold mb-4">Tambah OPD Baru</h3>

    {{-- FORM INPUT --}}
    <form action="{{ route('pusat.manajemen-opd.store') }}" method="POST" class="max-w-full">
        @csrf

        {{-- Input Nama Instansi --}}
        <div class="mb-4">
            <label for="nama_instansi" class="block text-white text-base font-medium mb-2">
                Nama Instansi
            </label>
            <input type="text" 
                   id="nama_instansi" 
                   name="nama_instansi" 
                   class="w-full bg-[#8F8F8F] text-black px-4 py-1 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0066FF] placeholder-gray-700"
                   required>
        </div>

        {{-- Input Email --}}
        <div class="mb-4">
            <label for="email" class="block text-white text-base font-medium mb-2">
                Email
            </label>
            <input type="email" 
                   id="email" 
                   name="email" 
                   class="w-full bg-[#8F8F8F] text-black px-4 py-1 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0066FF] placeholder-gray-700"
                   required>
        </div>

        {{-- Input Password --}}
        <div class="mb-6">
            <label for="password" class="block text-white text-base font-medium mb-2">
                Password
            </label>
            <input type="password" 
                   id="password" 
                   name="password" 
                   class="w-full bg-[#8F8F8F] text-black px-4 py-1 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0066FF] placeholder-gray-700"
                   required>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end gap-4">
            {{-- Tombol Batal --}}
            {{-- PERBAIKAN: Route disesuaikan dengan web.php project baru (.index) --}}
            <a href="{{ route('pusat.manajemen-opd.index') }}" class="mt-4 md:mt-0 bg-[#FF0000] hover:bg-red-700 text-white font-bold py-2 px-8 rounded-lg transition-colors">
                Batal
            </a>

            {{-- Tombol Simpan --}}
            <button type="submit" class="mt-4 md:mt-0 bg-[#0066FF] hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition-colors">
                Simpan
            </button>
        </div>

    </form>

</div>

@endsection