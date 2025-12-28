<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard Admin')</title>

    {{-- 1. Load Assets (Pilih salah satu: Vite atau Asset Biasa) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- 2. Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- 3. Tailwind CDN (Hanya jika Anda tidak menggunakan Tailwind via Vite) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] } } }
        }
    </script>
</head>
<body class="bg-black text-white antialiased"> 
    
    <div class="flex h-screen overflow-hidden">

        {{-- SIDEBAR DINAMIS --}}
        @if(Request::is('pembimbing*'))
            @include('admin.pembimbing.components.sidebar')
        @elseif(Request::is('admin/opd*'))
            @include('admin.opd.components.sidebar')
        @elseif(Request::is('admin/pusat*'))
            @include('admin.pusat.components.sidebar') {{-- Sesuaikan jika pusat juga pakai underscore --}}
        @endif

        <div class="relative flex flex-1 flex-col overflow-y-auto ml-64 bg-black">
            <nav class="sticky top-0 z-20">
            {{-- NAVBAR DINAMIS --}}
            @if(Request::is('pembimbing*'))
                @include('admin.pembimbing.components.navbar')
            @elseif(Request::is('admin/opd*'))
                @include('admin.opd.components.navbar')
            @elseif(Request::is('admin/pusat*'))
                @include('admin.pusat.components.navbar')
            @endif

            {{-- KONTEN UTAMA --}}
            <main class="w-full flex-grow p-10 bg-black page-animate">
                @yield('content')
            </main>

        </div>
    </div>

    {{-- 4. Load JS di akhir --}}
@vite(['resources/js/news-handler.js'])
</body>
</html>