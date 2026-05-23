{{-- Simpan sebagai: views/layouts/guest.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Museum Brawijaya')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    {{-- 1. MEMUAT PERPUSTAKAAN IKON (Tetap perlu untuk ikon panah kembali) --}}
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
                        'brand-yellow': '#F4D371', 
                        'brand-yellow-hover': '#EAC96B',
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans bg-white text-text-dark min-h-screen flex flex-col">

    {{-- 
      ===============================================
      ICON BUMI SUDAH DIHAPUS DARI SINI
      ===============================================
    --}}

    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- 2. MEMUAT SCRIPT BAHASA (Tetap perlu untuk 'membaca' localStorage) --}}
    <script src="{{ asset('js/translation.js') }}"></script>

    {{-- 3. MENJALANKAN IKON (Ini akan memunculkan ikon panah kembali) --}}
    <script>
        lucide.createIcons();
    </script>

</body>
</html>