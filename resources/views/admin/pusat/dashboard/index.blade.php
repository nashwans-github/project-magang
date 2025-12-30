@extends('layout.admin-layout')

@section('title', 'Dashboard Pusat')

@section('header-title', 'Dashboard')

@section('content')

    @include('admin.pusat.components._stats-card')
    @include('admin.pusat.components._pemohon-chart')
    @include('admin.pusat.components._peserta-chart')

@endsection