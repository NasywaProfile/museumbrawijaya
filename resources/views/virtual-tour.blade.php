<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="vtour-page-title">Virtual Tour - Museum Brawijaya</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Segoe UI"', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'] },
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

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #FDFBF7;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #D4C5B0;
            border-radius: 10px;
        }

        .playlist-item.active {
            background-color: #FDF6E4;
            border-color: #ECAE36;
        }

        .playlist-item.active .play-icon {
            background-color: #69161D;
            color: white;
        }

        .playlist-item:not(.active) .play-icon {
            background-color: #E5E5E5;
            color: #666;
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
                    <a href="{{ route('beranda') }}"
                        class="flex items-center space-x-1.5 px-3 py-2 text-gray-600 hover:text-brand-red hover:bg-gray-50 rounded-lg font-medium transition-colors whitespace-nowrap text-sm">
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
                        class="flex items-center space-x-1.5 px-3 py-2 bg-[#FDF6E4] rounded-lg text-brand-red font-semibold transition-colors whitespace-nowrap text-sm">
                        <i data-lucide="video" class="w-4 h-4"></i><span id="nav-vtour">Virtual Tour</span>
                    </a>
                    <a href="{{ route('riwayat') }}"
                        class="flex items-center space-x-1.5 px-3 py-2 text-gray-600 hover:text-brand-red hover:bg-gray-50 rounded-lg font-medium transition-colors whitespace-nowrap text-sm">
                        <i data-lucide="history" class="w-4 h-4"></i><span id="nav-history">Riwayat</span>
                    </a>
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

    {{-- Konten Utama --}}
    <div class="flex-grow overflow-y-auto px-6 md:px-10 py-10">
        <main class="max-w-7xl mx-auto">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-brand-red" id="vtour-main-title">Virtual Tour Museum Brawijaya</h1>
                <p class="text-gray-500 mt-2" id="vtour-main-subtitle">Jelajahi koleksi museum dengan teknologi 360°
                    dari rumah</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- KOLOM KIRI --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- FRAME VIDEO --}}
                    <div
                        class="w-full h-[250px] md:h-[350px] bg-black rounded-xl overflow-hidden shadow-sm relative bg-gray-200 group">
                        <img src="{{ asset('images/Background.png') }}"
                            onerror="this.onerror=null;this.src='https://placehold.co/800x400/D4C5B0/69161D?text=Museum+Brawijaya'"
                            alt="Museum Brawijaya Virtual Tour"
                            class="w-full h-full object-cover filter blur-[2px] group-hover:blur-none transition-all duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>

                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <div class="bg-white/20 backdrop-blur-md p-3 rounded-full border border-white/50 shadow-lg">
                                <i data-lucide="play" class="w-6 h-6 text-white fill-white ml-1"></i>
                            </div>
                        </div>

                        {{-- Iframe --}}
                        <iframe id="main-video-frame"
                            class="w-full h-full absolute inset-0 opacity-0 pointer-events-none transition-opacity duration-500"
                            src="" title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                    </div>

                    {{-- DETAIL VIDEO --}}
                    <div class="bg-[#FFFFFF] border border-[#F0EAD6] rounded-xl p-6 md:p-8">
                        <h2 id="video-title-1" class="text-xl font-bold text-[#69161D] mb-2">Jelajah Brawijaya - 1</h2>
                        {{-- ID TRANSLATE: video-subtitle --}}
                        <p class="text-sm text-gray-500 mb-6 leading-relaxed" id="video-subtitle">Nikmati pengalaman 360
                            derajat mengelilingi Museum Brawijaya.</p>

                        <h2 class="text-xm font-bold text-[#69161D] mb-6" id="benefits-title">Yang Akan Anda Dapatkan:
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4">
                            <div class="flex items-start gap-3">
                                <div class="mt-1 text-green-600"><i data-lucide="check" class="w-5 h-5"></i></div>
                                <div>
                                    <h3 class="font-semibold text-[#69161D]" id="benefit1-title">Akses Seumur Hidup</h3>
                                    <p class="text-sm text-gray-500" id="benefit1-desc">Nikmati kapan saja tanpa batas
                                        waktu</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="mt-1 text-green-600"><i data-lucide="check" class="w-5 h-5"></i></div>
                                <div>
                                    <h3 class="font-semibold text-[#69161D]" id="benefit2-title">Video 360° HD</h3>
                                    <p class="text-sm text-gray-500" id="benefit2-desc">Kualitas tinggi dan detail</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="mt-1 text-green-600"><i data-lucide="check" class="w-5 h-5"></i></div>
                                <div>
                                    <h3 class="font-semibold text-[#69161D]" id="benefit3-title">Audio Guide</h3>
                                    <p class="text-sm text-gray-500" id="benefit3-desc">Narasi professional</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="mt-1 text-green-600"><i data-lucide="check" class="w-5 h-5"></i></div>
                                <div>
                                    <h3 class="font-semibold text-[#69161D]" id="benefit4-title">Semua Koleksi</h3>
                                    <p class="text-sm text-gray-500" id="benefit4-desc">Akses ke seluruh ruang pameran
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Info Mobile --}}
                        <div class="lg:hidden mt-8 bg-[#FDF6E4] rounded-lg p-6 border border-[#F0EAD6]">
                            <h3 class="font-semibold text-[#1F1F1F] mb-2 text-sm" id="mobile-info-title">Informasi
                                Rekening Transfer:</h3>
                            <div class="text-sm text-[#5C4D3C] space-y-1">
                                <p id="mobile-bank-info">Bank: <span class="font-medium">BCA</span></p>
                                <p id="mobile-rekening-info">No. Rekening: <span class="font-medium">1234567890</span>
                                </p>
                                <p id="mobile-an-info">Atas Nama: <span class="font-medium">Museum Brawijaya</span></p>
                            </div>
                        </div>

                        {{-- TOMBOL MOBILE --}}
                        <div class="lg:hidden mt-6">
                            @if(isset($transaction))
                                @if($transaction->status == 'active')
                                    {{-- SUDAH AKTIF --}}
                                    <button
                                        class="w-full bg-green-600 text-white font-bold py-4 rounded-xl shadow-md flex justify-center items-center gap-2"
                                        id="mobile-start-tour-button">
                                        <i data-lucide="play-circle" class="w-5 h-5"></i> <span id="btn-text-start-mobile">Mulai
                                            Tour</span>
                                    </button>
                                @elseif($transaction->status == 'pending')
                                    {{-- MENUNGGU KONFIRMASI --}}
                                    <button disabled
                                        class="w-full bg-yellow-100 text-yellow-700 font-bold py-4 rounded-xl shadow-sm flex justify-center items-center gap-2 cursor-not-allowed border border-yellow-200">
                                        <i data-lucide="clock" class="w-5 h-5"></i> <span id="btn-text-pending-mobile">Menunggu
                                            Konfirmasi</span>
                                    </button>
                                @else
                                    {{-- BELUM BAYAR (Unpaid) --}}
                                    <form action="{{ route('virtual-tour.beli') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full bg-gradient-to-r from-museum-dark to-museum-light text-white font-semibold py-4 rounded-xl shadow-md hover:opacity-95 transition-all flex justify-center items-center gap-2">
                                            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                                            <span id="mobile-pay-button">Lanjutkan ke Pembayaran</span>
                                        </button>
                                    </form>
                                @endif
                            @else
                                {{-- BELUM ADA TRANSAKSI --}}
                                <form action="{{ route('virtual-tour.beli') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-gradient-to-r from-museum-dark to-museum-light text-white font-semibold py-4 rounded-xl shadow-md hover:opacity-95 transition-all flex justify-center items-center gap-2">
                                        <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                                        <span id="mobile-pay-button">Lanjutkan ke Pembayaran</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN (DESKTOP) --}}
                <div class="hidden lg:block lg:col-span-1">
                    <div class="bg-[#FFFFFF] border border-[#F0EAD6] rounded-xl p-6 shadow-sm sticky top-4">
                        <div class="flex items-center gap-2 mb-6">
                            <i data-lucide="lock" class="w-5 h-5 text-brand-red"></i>
                            <h2 class="text-lg font-bold text-[#69161D]" id="access-status-title">Status Akses</h2>
                        </div>
                        <div class="flex flex-col items-center justify-center text-center mb-6">
                            @if(isset($transaction))
                                @if($transaction->status == 'active')
                                    <span class="bg-green-100 text-green-800 text-xs font-bold px-4 py-1.5 rounded-full mb-3"
                                        id="access-status-active">Akses Aktif</span>
                                @elseif($transaction->status == 'pending')
                                    <span class="bg-yellow-100 text-[#69161D] text-xs font-bold px-4 py-1.5 rounded-full mb-3"
                                        id="access-status-pending">Menunggu Konfirmasi</span>
                                @else
                                    <span class="bg-[#FEF3C7] text-[#69161D] text-xs font-bold px-4 py-1.5 rounded-full mb-3"
                                        id="access-status-inactive">Belum Memiliki Akses</span>
                                @endif
                            @else
                                <span class="bg-[#FEF3C7] text-[#69161D] text-xs font-bold px-4 py-1.5 rounded-full mb-3"
                                    id="access-status-inactive">Belum Memiliki Akses</span>
                            @endif

                            <p class="text-2xl font-bold text-brand-red mb-1">Rp 25.000,00</p>
                            <p class="text-xs text-gray-500" id="access-price-desc">Sekali bayar, akses seumur hidup</p>
                        </div>

                        <div class="bg-white/50 rounded-lg p-5 border border-[#F0EAD6] mb-8 flex-grow">
                            <h3 class="font-bold text-[#69161D] text-sm mb-4 flex items-center gap-2"
                                id="why-vtour-title">
                                <i data-lucide="help-circle" class="w-4 h-4"></i> Mengapa Virtual Tour?
                            </h3>
                            <ul class="space-y-3">
                                <li class="flex items-start gap-3 text-sm text-[#69161D]">
                                    <i data-lucide="check-circle-2"
                                        class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0"></i>
                                    <span id="why1">Hemat waktu dan biaya perjalanan</span>
                                </li>
                                <li class="flex items-start gap-3 text-sm text-[#69161D]">
                                    <i data-lucide="check-circle-2"
                                        class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0"></i>
                                    <span id="why2">Akses kapan saja dari rumah</span>
                                </li>
                                <li class="flex items-start gap-3 text-sm text-[#69161D]">
                                    <i data-lucide="check-circle-2"
                                        class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0"></i>
                                    <span id="why3">Pengalaman interaktif 360°</span>
                                </li>
                                <li class="flex items-start gap-3 text-sm text-[#69161D]">
                                    <i data-lucide="check-circle-2"
                                        class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0"></i>
                                    <span id="why4">Audio guide yang informatif</span>
                                </li>
                            </ul>
                        </div>

                        {{-- TOMBOL DESKTOP --}}
                        @if(isset($transaction))
                            @if($transaction->status == 'active')
                                {{-- AKTIF --}}
                                <button
                                    class="w-full bg-green-600 text-white font-bold py-3 rounded-lg shadow-sm hover:bg-green-700 transition-all flex justify-center items-center gap-2 text-sm"
                                    id="desktop-start-tour-button">
                                    <i data-lucide="play-circle" class="w-4 h-4"></i> <span id="btn-text-start-desktop">Mulai
                                        Tour Sekarang</span>
                                </button>
                            @elseif($transaction->status == 'pending')
                                {{-- MENUNGGU --}}
                                <button disabled
                                    class="w-full bg-yellow-100 text-yellow-700 font-bold py-3 rounded-lg shadow-sm flex justify-center items-center gap-2 text-sm cursor-not-allowed border border-yellow-200">
                                    <i data-lucide="clock" class="w-4 h-4"></i> <span id="btn-text-pending-desktop">Menunggu
                                        Konfirmasi</span>
                                </button>
                            @else
                                {{-- UNPAID --}}
                                <form action="{{ route('virtual-tour.beli') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-gradient-to-r from-museum-dark to-museum-light text-white font-bold py-3 rounded-lg shadow-sm hover:opacity-90 transition-all flex justify-center items-center gap-2 text-sm">
                                        <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                                        <span id="desktop-pay-button">Lanjutkan ke Pembayaran</span>
                                    </button>
                                </form>
                            @endif
                        @else
                            {{-- BELUM ADA TRANSAKSI --}}
                            <form action="{{ route('virtual-tour.beli') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-museum-dark to-museum-light text-white font-bold py-3 rounded-lg shadow-sm hover:opacity-90 transition-all flex justify-center items-center gap-2 text-sm">
                                    <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                                    <span id="desktop-pay-button">Lanjutkan ke Pembayaran</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script src="{{ asset('js/translation.js') }}"></script>
    <script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        const videos = [
            { title: "Jelajah Brawijaya - 1", subtitle: "Bagian Depan", url: "https://www.youtube.com/embed/kxRykPMfbTQ?si=A0f7ePd0nKvsgpKO" },
            { title: "Jelajah Brawijaya - 2", subtitle: "Koleksi Senjata", url: "https://www.youtube.com/embed/-Ys7FRPQir0?si=AnMj5gQLsCxsd3yB" },
            { title: "Jelajah Brawijaya - 3", subtitle: "Ruang Sejarah", url: "https://www.youtube.com/embed/xWsKYzMtsz4?si=gGkE7i6ctDJ6HusC" },
            { title: "Jelajah Brawijaya - 4", subtitle: "Gerbong Maut", url: "https://www.youtube.com/embed/IlixJ0cmJxk?si=K6sbBv127_I0K3ur" },
            { title: "Jelajah Brawijaya - 5", subtitle: "Perahu Segigir", url: "https://www.youtube.com/embed/Kc7k8gZWNuo?si=jDqggPrSHAYzZyO0" }
        ];

        function changeVideo(index) {
            const frame = document.getElementById('main-video-frame');
            const titleEl = document.getElementById('video-title');

        }
    </script>

</body>

</html>