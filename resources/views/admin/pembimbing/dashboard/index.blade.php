@extends('layout.admin-layout')

{{-- Ubah Title sesuai user yang login nanti --}}
@section('title', 'Dashboard Pembimbing')
@section('header-title', 'Dashboard')

@section('content')

    {{-- 1. STATISTIK CARD (4 KOTAK) --}}
    @include('admin.pembimbing.components._stats-card')

    {{-- 2. ACTIVITY FEED (AKTIVITAS TERBARU) --}}
    {{-- Kita bungkus dengan grid agar kalau nanti ada widget lain bisa sebelahan --}}
    <div class="grid grid-cols-1 gap-6">
        @include('admin.pembimbing.components._activity')
    </div>

@endsection