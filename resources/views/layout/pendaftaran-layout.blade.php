<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Form Pendaftaran')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-black text-white">

    @yield('content')

    @stack('scripts')

</body>

</html>