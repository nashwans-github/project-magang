@extends('layout.admin-layout')
@section('title', 'Dashboard - Admin OPD')
@section('header-title', 'Dashboard')

@section('content')
    
    {{-- WRAPPER DASHBOARD --}}
    <div class="text-white">
        
        {{-- 1. Bagian Statistik (4 Kotak Atas) --}}
        {{-- Nama file baru: _stats-card.blade.php di folder components --}}
        @include('admin.opd.components._stats-card')

        {{-- 2. Bagian Bawah (Berita & Aktivitas) --}}
        <div class="flex flex-col gap-6 mt-6">
            
            {{-- Pemberitahuan (News) --}}
            {{-- Nama file baru: _news.blade.php --}}
            <div class="w-full">
                @include('admin.opd.components._news')
            </div>

            {{-- Aktivitas Terbaru --}}
            {{-- Nama file baru: _activity.blade.php --}}
            <div class="w-full">
                @include('admin.opd.components._activity')
            </div>

        </div>
    </div>
@vite(['resources/js/news-slider.js'])
@endsection