<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>@yield('title')</title>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

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

<body class="bg-black text-white">

    <div class="flex w-full h-screen overflow-hidden">
        {{-- Sidebar --}}
        <div class="overflow-hidden">
            @include('user.peserta.sidebar')
        </div>

        {{-- Content --}}
        <div class="flex-1 w-full pl-[60px] pr-10 pt-10 overflow-y-auto">
            @yield('content')
        </div>
    </div>

</body>

</html>