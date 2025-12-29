<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Portal Akun Utama')</title>

    {{-- Tailwind via Vite --}}
    @vite('resources/css/app.css')
    
    {{-- Javascript via Vite --}}
    @vite('resources/js/navbarScroll.js')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #000; /* Background hitam sesuai tema */
            color: white; 
        }
    </style>
</head>
<body class="bg-black text-white antialiased">

    @include('user.akun_utama.component.navbar.navbar')

    <main>
        @yield('content')
    </main>

    @include('user.akun_utama.component.footer.footer')

</body>
</html>