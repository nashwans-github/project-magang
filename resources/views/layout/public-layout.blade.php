<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Website Magang - Pemkot Surabaya')</title>

    {{-- Vite Tailwind CSS --}}
    @vite('resources/css/app.css')

    {{-- Font Google (Poppins) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .faq-container-shadow {
            box-shadow: 0 0 100px 30px rgba(120, 204, 231, 0.25);
        }
    </style>
</head>

<body class="bg-black text-white">

    {{-- Navbar --}}
    @include('user.tamu.component.navbar.navbar')

    {{-- Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('user.tamu.component.footer.footer')

    {{-- Scripts --}}
    @vite('resources/js/faq.js')
    @vite('resources/js/navbarScroll.js')
</body>

</html>