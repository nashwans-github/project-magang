<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Website Magang - Pemkot Surabaya')</title>

    {{-- Font Google (Poppins) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Vite Tailwind CSS (WAJIB) --}}
    @vite('resources/css/app.css')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Custom Shadow untuk kotak FAQ & Card Instansi */
        .faq-container-shadow {
            box-shadow: 0 0 100px 30px rgba(120, 204, 231, 0.25);
        }
    </style>
</head>

<body class="bg-black text-white flex flex-col min-h-screen">

    {{-- 1. MEMANGGIL NAVBAR (Menu Atas) --}}
    @include('user.tamu.component.navbar.navbar')

    {{-- 2. AREA KONTEN UTAMA (Isi Halaman) --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- 3. MEMANGGIL FOOTER (Bagian Bawah) --}}
    @include('user.tamu.component.footer.footer')

    @vite('resources/js/navbarScroll.js')

</body>

</html>