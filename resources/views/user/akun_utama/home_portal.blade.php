@extends('layout.portal-layout')

@section('title', 'Portal Akun Utama')

@section('content')

@include('user.akun_utama.component.hero.hero')
@include('user.akun_utama.component.pemberitahuan.pemberitahuan')
@include('user.akun_utama.component.informasi.informasi')
@include('user.akun_utama.component.login.login')

@endsection