<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>@yield('title')</title>
</head>

<body class="min-h-screen bg-cover bg-center bg-no-repeat body-bg-login">

    <div class="relative z-10">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.2/dist/cdn.min.js" defer></script>
    @stack('scripts')
</body>

</html>