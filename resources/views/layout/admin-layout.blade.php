<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title', 'Dashboard Admin')</title>

    {{-- Load Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Poppins', sans-serif !important; }
        /* Page Transition Animation */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .page-animate { animation: fadeInUp 0.5s ease-out forwards; }
    </style>
</head>
<body class="bg-black text-white antialiased font-sans"> 
    
    <div class="flex h-screen overflow-hidden">

        {{-- 1. SIDEBAR --}}

        @if(Request::is('admin/pembimbing*'))
            @include('admin.pembimbing.components.sidebar')

        @elseif(Request::is('admin/opd*'))
            @include('admin.opd.components.sidebar')

        @elseif(Request::is('admin/pusat*'))

            @include('admin.pusat.components.sidebar')
        @endif


        <div id="mainContent" class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden ml-64">

            {{-- 2. NAVBAR --}}
            
            @if(Request::is('admin/pembimbing*'))
                @include('admin.pembimbing.components.navbar')

            @elseif(Request::is('admin/opd*'))
                @include('admin.opd.components.navbar')

            @elseif(Request::is('admin/pusat*'))
                @include('admin.pusat.components.navbar')
            @endif


            {{-- 3. KONTEN UTAMA --}}
            <main class="w-full flex-grow p-8 bg-black page-animate">
                @yield('content')
            </main>

        </div>

    </div>

    @include('admin.pembimbing.components.modal-preview')
    @include('admin.pembimbing.components.modal-approval')

</body>
</html>