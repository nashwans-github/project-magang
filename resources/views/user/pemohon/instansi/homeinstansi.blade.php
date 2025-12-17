@extends('layout.instansi-layout')

@section('title', $instansi['name'])

@section('content')

<div class="w-full pt-32 mb-20">
    <div class="max-w-7xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-[40px] font-bold mb-8 leading-[60px]">
                {{ $instansi['name'] }}
            </h1>

            <div class="w-[200px] h-1 bg-blue-600 mx-auto mb-8 rounded-full"></div>

            <p class="text-white max-w-6xl mx-auto leading-relaxed text-[20px] mb-8">
                {{ $instansi['deskripsi'] ?? '-' }}
            </p>

            {{-- Tombol Daftar diubah jadi link --}}
            @php
            $slug = is_array($instansi)
            ? ($instansi['slug'] ?? Str::slug($instansi['name']))
            : ($instansi->slug ?? Str::slug($instansi->name));
            @endphp

            <a href="#"
                class="bg-[#0554F2] hover:bg-blue-700 text-white font-semibold py-3 
                w-[198px] text-lg rounded-lg transition-colors shadow-[0_0_20px_rgba(5,84,242,0.5)]
                inline-block text-center">
                Daftar
            </a>

        </div>

        {{-- GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

            {{-- FOTO --}}
            <div class="lg:col-span-4 flex flex-col gap-8 mt-36">
                @foreach(($instansi['gallery'] ?? []) as $img)
                <div class="overflow-hidden rounded-2xl max-h-[425px] w-full lg:w-[400px] aspect-[4/5]">
                    <img src="{{ asset($img) }}"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                </div>
                @endforeach
            </div>

            {{-- DETAIL / INFO --}}
            <div class="lg:col-span-8 flex flex-col items-end gap-20">

                {{-- Kirim seluruh $instansi supaya komponen bisa akses semua field --}}
                @include('user.pemohon.instansi.component.info', ['instansi' => $instansi])
                @include('user.pemohon.instansi.component.bidang', ['instansi' => $instansi])

            </div>

        </div>
    </div>
</div>

@endsection