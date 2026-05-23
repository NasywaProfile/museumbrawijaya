<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="beranda-page-title">Beranda - Museum Brawijaya</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Segoe UI"', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'],
                    },
                    colors: {
                        'primary-brown': '#7F1D1D', 'brand-red': '#69161D', 'primary-dark': '#69161D',
                        'bg-light': '#FBFAF9', 'cta-brown': '#92400E', 'tag-bg': '#fef3c7',
                        'tag-text': '#69161D', 'card-bg': '#FBFAF9', 'button-yellow': '#F0C442',
                        'museum-light': '#93501F', 'museum-dark': '#69161D',
                    }
                }
            }
        }
    </script>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

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

<body class="bg-bg-light font-sans text-gray-900 flex flex-col h-screen overflow-hidden">

    {{-- Navbar Start --}}
    <nav class="bg-bg-light p-4 shadow-xl sticky top-0 z-50 shrink-0">
        <div class="container mx-auto flex justify-between items-center max-w-7xl px-4 sm:px-6 lg:px-12">

            <div class="flex-shrink-0">
                <a href="{{ route('beranda') }}" class="text-xl font-bold text-brand-red tracking-wider">Museum
                    Brawijaya</a>
            </div>

            <div class="flex-1 flex justify-center px-4">
                <div class="flex items-center space-x-1 overflow-x-auto no-scrollbar">
                    {{-- Beranda (AKTIF - Kuning) --}}
                    <a href="{{ route('beranda') }}"
                        class="flex items-center space-x-1.5 px-3 py-2 bg-[#FDF6E4] rounded-lg text-brand-red font-semibold transition-colors whitespace-nowrap text-sm">
                        <i data-lucide="home" class="w-4 h-4"></i><span id="nav-home">Beranda</span>
                    </a>

                    <a href="{{ route('halaman-saya') }}"
                        class="flex items-center space-x-1.5 px-3 py-2 text-gray-600 hover:text-brand-red hover:bg-gray-50 rounded-lg font-medium transition-colors whitespace-nowrap text-sm">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i><span id="nav-dashboard">Halaman
                            Saya</span>
                    </a>

                    <a href="{{ route('tiket-saya') }}"
                        class="flex items-center space-x-1.5 px-3 py-2 text-gray-600 hover:text-brand-red hover:bg-gray-50 rounded-lg font-medium transition-colors whitespace-nowrap text-sm">
                        <i data-lucide="ticket" class="w-4 h-4"></i><span id="nav-ticket">Tiket Saya</span>
                    </a>

                    <a href="{{ route('virtual-tour') }}"
                        class="flex items-center space-x-1.5 px-3 py-2 text-gray-600 hover:text-brand-red hover:bg-gray-50 rounded-lg font-medium transition-colors whitespace-nowrap text-sm">
                        <i data-lucide="video" class="w-4 h-4"></i><span id="nav-vtour">Virtual Tour</span>
                    </a>

                    <a href="{{ route('riwayat') }}"
                        class="flex items-center space-x-1.5 px-3 py-2 text-gray-600 hover:text-brand-red hover:bg-gray-50 rounded-lg font-medium transition-colors whitespace-nowrap text-sm"><i
                            data-lucide="history" class="w-4 h-4"></i><span id="nav-history">Riwayat</span></a>

                </div>
            </div>

            <div class="flex items-center space-x-4 flex-shrink-0">
                <a href="{{ route('profil') }}"
                    class="flex items-center space-x-1.5 text-black font-medium hover:text-brand-red transition-colors whitespace-nowrap text-sm">
                    <i data-lucide="user" class="w-4 h-4"></i><span>{{ Auth::user()->name ?? 'Akun' }}</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="hidden sm:flex items-center space-x-1.5 px-3 py-2 
           border border-gray-300 rounded-lg text-black 
           hover:bg-[#69161d] hover:text-white hover:border-[#69161d]
           transition-colors whitespace-nowrap text-sm">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        <span id="nav-logout">Keluar</span>
                    </button>

                    <button type="submit"
                        class="sm:hidden flex items-center justify-center p-2 text-red-600 hover:bg-gray-50 rounded-lg transition-colors">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    {{-- Navbar End --}}

    {{-- CONTAINER SCROLLABLE --}}
    <div class="flex-grow overflow-y-auto">
        <main>
            {{-- Hero Section --}}
            <header class="hero-bg min-h-[600px] flex items-start p-3 md:p-12 lg:p-20">
                <div class="hero-content max-w-3xl text-white mt-4 md:mt-8">
                    <h1
                        class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold mb-6 leading-tight drop-shadow-lg">
                        <span id="hero-title">Jelajahi Sejarah Indonesia di</span> <span class="text-white">Museum
                            Brawijaya</span>
                    </h1>
                    <p class="text-lg md:text-xl mb-10 max-w-2xl font-medium drop-shadow-md" id="hero-description-text">
                        Temukan koleksi bersejarah dan artefak yang menggambarkan perjalanan panjang bangsa Indonesia.
                        Nikmati pengalaman museum yang interaktif dan edukatif.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6">

                        {{-- TOMBOL 1: PESAN TIKET --}}
                        <a href="{{ route('tiket-saya') }}"
                            class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-museum-dark to-museum-light border border-white/40 text-white font-bold rounded-xl shadow-xl hover:opacity-90 transition duration-300 ease-in-out text-base md:text-lg transform hover:scale-[1.02]">
                            <i data-lucide="ticket" class="w-5 h-5 mr-3"></i>
                            <span id="hero-button-1">Pesan Tiket Sekarang</span>
                            <i data-lucide="arrow-right" class="w-5 h-5 ml-3"></i>
                        </a>

                        {{-- TOMBOL 2: VIRTUAL TOUR --}}
                        <a href="{{ route('virtual-tour') }}"
                            class="inline-flex items-center justify-center px-8 py-3 bg-white text-primary-brown font-bold rounded-xl shadow-xl hover:bg-gray-100 transition duration-300 ease-in-out text-base md:text-lg transform hover:scale-[1.02] ring-2 ring-primary-brown focus:outline-none focus:ring-2 focus:ring-primary-brown">
                            <i data-lucide="camera" class="w-5 h-5 mr-3"></i>
                            <span id="hero-button-2">Mulai Virtual Tour</span>
                            <i data-lucide="arrow-right" class="w-5 h-5 ml-3"></i>
                        </a>

                    </div>
                </div>
            </header>

            {{-- About Section --}}
            <section class="pt-12 md:pt-20 pb-6 md:pb-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
                    <div class="w-full bg-bg-light rounded-xl p-8 md:p-12 lg:p-12">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                            <div class="lg:col-span-2">
                                <h1 class="text-xl md:text-3xl font-extrabold text-brand-red mb-6" id="about-title">
                                    Tentang Museum Brawijaya
                                </h1>
                                <p class="text-[#69161D] leading-relaxed mb-8 text-sm md:text-base max-w-2xl"
                                    id="about-description">
                                    Museum Brawijaya adalah museum militer yang didedikasikan untuk melestarikan sejarah
                                    perjuangan kemerdekaan Indonesia. Terletak di jantung kota Malang, museum ini
                                    menampilkan koleksi komprehensif artefak, dokumen, dan memorabilia dari era kolonial
                                    hingga kemerdekaan.
                                </p>
                                <div class="space-y-4 text-gray-700">
                                    <div class="flex items-start text-sm md:text-base">
                                        <i data-lucide="map-pin" class="w-5 h-5 text-primary-brown mr-3 mt-1"></i>
                                        <p>
                                            <span class="font-semibold" id="about-location-label">Lokasi:</span>
                                            <span class="font-normal" id="about-location-description">Jl. Ijen No. 25A,
                                                Malang, Jawa Timur</span>
                                        </p>
                                    </div>
                                    <div class="flex items-start text-sm md:text-base">
                                        <i data-lucide="clock" class="w-5 h-5 text-primary-brown mr-3 mt-1"></i>
                                        <p>
                                            <span class="font-semibold" id="about-hours-label">Jam Buka:</span>
                                            <span id="about-hours-text">Senin - Minggu, 08:00 - 15:00</span>
                                        </p>
                                    </div>
                                    <div class="flex items-start text-sm md:text-base">
                                        <i data-lucide="users" class="w-5 h-5 text-primary-brown mr-3 mt-1"></i>
                                        <p>
                                            <span class="font-semibold" id="about-guide-label">Panduan tersedia
                                                dalam</span>
                                            <span id="about-guide-text">Bahasa Indonesia & Inggris</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="lg:col-span-1 space-y-4 pt-4 md:pt-0">
                                <div
                                    class="flex flex-col items-center justify-center p-6 md:p-8 bg-white border border-stone-200 rounded-lg shadow-sm transition duration-300 hover:shadow-md">
                                    <div class="text-primary-brown mb-3 p-3 bg-detail-bg rounded-full">
                                        <i data-lucide="calendar" class="w-6 h-6"></i>
                                    </div>
                                    <h3 class="font-semibold text-lg text-gray-800 mb-1" id="about-card1-title">Buka
                                        Setiap Hari</h3>
                                    <p class="text-sm text-gray-500" id="about-card1-text">Tidak ada hari libur</p>
                                </div>
                                <div
                                    class="flex flex-col items-center justify-center p-6 md:p-8 bg-white border border-stone-200 rounded-lg shadow-sm transition duration-300 hover:shadow-md">
                                    <div class="text-primary-brown mb-3 p-3 bg-detail-bg rounded-full">
                                        <i data-lucide="camera" class="w-6 h-6"></i>
                                    </div>
                                    <h3 class="font-semibold text-lg text-gray-800 mb-1" id="about-card2-title">Virtual
                                        Tour</h3>
                                    <p class="text-sm text-gray-500" id="about-card2-text">Teknologi 360°</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Koleksi Section --}}
            <section class="pt-6 md:pt-10 pb-12 md:pb-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 space-y-6 md:space-y-10">
                    <header class="text-center mb-12 md:mb-16">
                        <h1 class="text-xl md:text-3xl font-extrabold text-brand-red mb-6" id="collection-title">
                            Koleksi Unggulan
                        </h1>
                        <p class="text-[#69161D] leading-relaxed mb-8 text-sm md:text-base max-w-2xl mx-auto"
                            id="collection-description">
                            Jelajahi koleksi bersejarah berbagai periode penting dalam sejarah Indonesia
                        </p>
                    </header>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                        <a href="{{ route('koleksi.tradisional') }}"
                            class="block bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 overflow-hidden h-[347px]">
                            <div class="w-full h-48 overflow-hidden"><img src="{{ asset('images/lptradisional.webp') }}"
                                    class="w-full h-full object-cover rounded-t-xl transition duration-500 hover:scale-105">
                            </div>
                            <div class="p-6">
                                <span
                                    class="inline-block bg-tag-bg text-tag-text text-xs font-semibold px-3 py-1 rounded-full mb-3"
                                    id="collection-card1-tag">Tradisional</span>
                                <h2 class="text-xl font-bold text-primary-dark mb-2" id="collection-card1-title">Koleksi
                                    Tradisional</h2>
                                <p class="text-brand-red text-xs" id="collection-card1-desc">Artefak Tradisional
                                    Indonesia</p>
                            </div>
                        </a>

                        <a href="{{ route('koleksi.sejarah') }}"
                            class="block bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 overflow-hidden h-[347px]">
                            <div class="w-full h-48 overflow-hidden"><img src="{{ asset('images/lpsejarah.png') }}"
                                    class="w-full h-full object-cover rounded-t-xl transition duration-500 hover:scale-105">
                            </div>
                            <div class="p-6">
                                <span
                                    class="inline-block bg-tag-bg text-tag-text text-xs font-semibold px-3 py-1 rounded-full mb-3"
                                    id="collection-card2-tag">Sejarah</span>
                                <h2 class="text-xl font-bold text-brand-red mb-2" id="collection-card2-title">Koleksi
                                    Sejarah</h2>
                                <p class="text-brand-red text-xs" id="collection-card2-desc">Dokumentasi perjuangan
                                    Indonesia</p>
                            </div>
                        </a>

                        <a href="{{ route('koleksi.militer') }}"
                            class="block bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 overflow-hidden h-[347px]">
                            <div class="w-full h-48 overflow-hidden"><img src="{{ asset('images/lpmiliter.png') }}"
                                    class="w-full h-full object-cover rounded-t-xl transition duration-500 hover:scale-105">
                            </div>
                            <div class="p-6">
                                <span
                                    class="inline-block bg-tag-bg text-tag-text text-xs font-semibold px-3 py-1 rounded-full mb-3"
                                    id="collection-card3-tag">Militer</span>
                                <h2 class="text-xl font-bold text-brand-red mb-2" id="collection-card3-title">Koleksi
                                    Militer</h2>
                                <p class="text-brand-red text-xs" id="collection-card3-desc">Seragam dan peralatan
                                    militer bersejarah</p>
                            </div>
                        </a>

                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="{{ asset('js/translation.js') }}"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>