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

<div id="toast-auth"
     class="fixed top-[95px] right-[145px] z-[9999]
            bg-[#222] text-white px-5 py-4 rounded-xl shadow-lg
            hidden items-center gap-4">

    <span id="toast-message" class="text-sm"></span>

    <a href="{{ route('login') }}"
       class="text-sm font-semibold underline text-blue-400 hover:text-blue-300">
        Login sekarang
    </a>
</div>

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

<script>
    window.IS_LOCAL = {{ app()->isLocal() ? 'true' : 'false' }};
    window.IS_AUTH  = {{ auth()->check() ? 'true' : 'false' }};
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const toast = document.getElementById('toast-auth');
    const toastMsg = document.getElementById('toast-message');
    let toastTimeout = null;

    function showToast(message) {
        toastMsg.textContent = message;
        toast.classList.remove('hidden');
        toast.classList.add('flex');

        clearTimeout(toastTimeout);
        toastTimeout = setTimeout(() => {
            toast.classList.add('hidden');
            toast.classList.remove('flex');
        }, 3000);
    }

    document.querySelectorAll('.instansi-link').forEach(link => {
        link.addEventListener('click', function (e) {

            // DEV MODE — BEBAS MASUK
            if (window.IS_LOCAL === true) {
                return;
            }

            // user belum login
            if (!window.IS_AUTH) {
                e.preventDefault();

                // simpan intended URL (client-side)
                sessionStorage.setItem(
                    'intended_instansi',
                    this.getAttribute('href')
                );

                showToast('Silakan login untuk melihat detail instansi.');
            }
        });
    });
});
</script>