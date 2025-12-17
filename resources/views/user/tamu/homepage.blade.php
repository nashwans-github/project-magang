@extends('layout.public-layout')

@section('title', 'Portal Magang Surabaya')

@section('content')

@include('user.tamu.component.hero.hero')
@include('user.tamu.component.instansi.homeinstansi')
@include('user.tamu.component.langkah.homelangkah')
@include('user.tamu.component.faq.homefaq')

@endsection