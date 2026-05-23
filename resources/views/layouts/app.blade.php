{{-- Simpan sebagai: views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Museum Brawijaya')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    {{-- 1. MEMUAT PERPUSTAKAAN IKON --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        {{-- Konfigurasi Tailwind kamu (tidak diubah) --}}
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: [
                            'Segoe UI', 'system-ui', '-apple-system', 'BlinkMacSystemFont',
                            'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'
                        ],
                    },
                    colors: {
                        'primary-brown': '#7F1D1D',
                        'secondary-brown': '#993333',
                        'brand-red': '#69161D',
                        'button-yellow': '#F0C442',
                        'accent-orange': '#FBBF24',
                        'cta-brown': '#92400E',
                        'bg-light': '#FBFAF9',
                        'text-dark': '#1F2937',
                        'detail-red': '#76454A',
                        'detail-bg': '#FBFAF9',
                        'primary-dark': '#69161D',
                        'card-bg': '#FBFAF9',
                        'tag-bg': '#fef3c7',
                        'tag-text': '#69161D',
                        'museum-dark': '#69161D',
                        'museum-light': '#93501F',
                    }
                }
            }
        }
    </script>

    <style>
        {{-- Style Hero-mu (tidak diubah) --}}
        .hero-bg {
            background-image: url("{{ asset('images/museumbraw.png') }}");
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .hero-bg::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: rgba(127, 29, 29, 0.65);
            z-index: 10;
        }
        .hero-content {
            position: relative;
            z-index: 20;
        }
    </style>
</head>

<body class="font-sans bg-bg-light text-text-dark min-h-screen flex flex-col">

    {{-- DI SINILAH TOMBOL BUMI KAMU BERADA (di dalam navigasi) --}}
    @include('layouts.navigation')

    <main class="flex-grows">
        @yield('content')
    </main>

    @include('layouts.footer')

    {{-- 2. MEMUAT SCRIPT BAHASA --}}
    <script src="{{ asset('js/translation.js') }}"></script>

    {{-- 3. MENJALANKAN IKON (untuk ikon tiket, kamera, dll) --}}
    <script>
        lucide.createIcons();
    </script>

</body>
</html>