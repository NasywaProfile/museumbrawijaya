<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Virtual Tour - Museum Brawijaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Segoe UI"', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'] },
                    colors: {
                        'primary-brown': '#7F1D1D', 'brand-red': '#69161D', 'bg-light': '#FBFAF9',
                        'cta-brown': '#92400E', 'tag-bg': '#fef3c7', 'tag-text': '#69161D',
                        'card-bg': '#FBFAF9', 'button-yellow': '#F0C442', 'museum-light': '#93501F', 'museum-dark': '#69161D',
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
            background-color: #69161D;
            color: white;
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

    <div class="flex-grow overflow-y-auto px-6 md:px-10 py-10">
        <main class="max-w-7xl mx-auto">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-brand-red" id="player-title">Virtual Tour Museum</h1>
                <p class="text-gray-500 mt-2" id="player-subtitle">Selamat menikmati pengalaman virtual tour yang
                    interaktif.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- PLAYER VIDEO --}}
                <div class="lg:col-span-2 order-1">
                    <div class="w-full h-[250px] md:h-[350px] bg-black rounded-xl overflow-hidden shadow-lg mb-6">
                        <iframe id="main-video-frame" class="w-full h-full"
                            src="https://www.youtube.com/embed/kxRykPMfbTQ?si=A0f7ePd0nKvsgpKO"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-[#E5E0D8] shadow-sm">
                        {{-- Judul Video Aktif  --}}
                        <h2 id="active-video-title" class="text-2xl font-bold text-brand-red mb-3 translatable"
                            data-key="video-title-1">Jelajah Brawijaya - 1</h2>

                        <p class="text-gray-600 leading-relaxed mb-6 text-sm md:text-base" id="player-video-desc">
                            Nikmati pengalaman 360 derajat mengelilingi Museum Brawijaya. Anda dapat menggeser video
                            untuk melihat sekeliling ruangan seolah-olah Anda berada di sana. Gunakan mouse atau
                            sentuhan jari untuk navigasi.
                        </p>

                        <div class="flex flex-wrap items-center gap-6 text-sm text-[#8C7A6B] font-medium">
                            <div class="flex items-center gap-2">
                                <i data-lucide="video" class="w-5 h-5"></i>
                                <span id="label-video-hd">Video 360° HD</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="headphones" class="w-5 h-5"></i>
                                <span id="label-audio-guide">Audio Guide</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PLAYLIST --}}
                <div class="lg:col-span-1 order-2">
                    <div
                        class="bg-[#FFFFFF] border border-[#F0EAD6] rounded-xl p-6 h-[600px] flex flex-col shadow-sm sticky top-4">

                        <div class="mb-4 shrink-0 border-b border-dashed border-[#D4C5B0] pb-4">
                            <h2 class="font-bold text-[#69161D] text-lg" id="playlist-title">Daftar Virtual Tour</h2>
                            <p class="text-xs text-gray-500 mt-1" id="playlist-count">5 video tersedia</p>
                        </div>

                        <div class="space-y-3 overflow-y-auto custom-scrollbar pr-2 flex-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <div onclick="changeVideo({{ $i - 1 }})" id="item-{{ $i - 1 }}"
                                    class="playlist-item {{ $i == 1 ? 'active' : 'bg-white border border-gray-200' }} rounded-lg p-3 cursor-pointer flex items-center gap-3 transition-all hover:shadow-sm">
                                    <div
                                        class="play-icon flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center transition-colors {{ $i == 1 ? '' : 'font-bold text-sm' }}">
                                        @if($i == 1) <i data-lucide="play" class="w-4 h-4"></i> @else {{ $i }} @endif
                                    </div>
                                    
                                    <div>
                                        <h3 class="font-bold text-[#1F1F1F] text-sm leading-tight translatable"
                                            data-key="video-title-{{ $i }}">
                                            Jelajah Brawijaya - {{ $i }}
                                        </h3>
                                        <p class="text-xs text-gray-500 mt-0.5 translatable" data-key="video-desc-{{ $i }}">
                                            Deskripsi Video {{ $i }}
                                        </p>
                                    </div>
                                </div>
                            @endfor
                        </div>
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
            { id: 1, url: "https://www.youtube.com/embed/kxRykPMfbTQ?si=A0f7ePd0nKvsgpKO" },
            { id: 2, url: "https://www.youtube.com/embed/-Ys7FRPQir0?si=AnMj5gQLsCxsd3yB" },
            { id: 3, url: "https://www.youtube.com/embed/xWsKYzMtsz4?si=gGkE7i6ctDJ6HusC" },
            { id: 4, url: "https://www.youtube.com/embed/IlixJ0cmJxk?si=K6sbBv127_I0K3ur" },
            { id: 5, url: "https://www.youtube.com/embed/Kc7k8gZWNuo?si=jDqggPrSHAYzZyO0" }
        ];

        function changeVideo(index) {
            const frame = document.getElementById('main-video-frame');
            const titleEl = document.getElementById('active-video-title');
            const items = document.querySelectorAll('.playlist-item');

            // Ganti URL Video
            frame.src = videos[index].url + "?autoplay=1";

            // Update Judul Utama 
            const clickedTitle = items[index].querySelector('h3').getAttribute('data-key');
            titleEl.setAttribute('data-key', clickedTitle); 

            // Trigger translasi ulang untuk judul utama agar teksnya berubah sesuai bahasa aktif
            const currentLang = localStorage.getItem('preferred_lang') || 'id';
            if (translations[currentLang][clickedTitle]) {
                titleEl.textContent = translations[currentLang][clickedTitle];
            }

            // Update Style Active
            items.forEach((item, i) => {
                const iconContainer = item.querySelector('.play-icon');
                if (i === index) {
                    item.classList.add('active', 'bg-[#FDF6E4]', 'border-[#ECAE36]');
                    item.classList.remove('bg-white', 'border-gray-200');
                    iconContainer.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>';
                } else {
                    item.classList.remove('active', 'bg-[#FDF6E4]', 'border-[#ECAE36]');
                    item.classList.add('bg-white', 'border-gray-200');
                    iconContainer.innerHTML = `<span class="font-bold text-sm">${i + 1}</span>`;
                }
            });
        }

        // --- LOGIKA TRANSLASI DINAMIS ---
        document.addEventListener('DOMContentLoaded', () => {
            function updateDynamicTranslations(lang) {
                if (!translations[lang]) return;
                document.querySelectorAll('.translatable').forEach(el => {
                    const key = el.getAttribute('data-key');
                    if (translations[lang][key]) {
                        el.textContent = translations[lang][key];
                    }
                });
            }

            const savedLang = localStorage.getItem('preferred_lang') || 'id';
            updateDynamicTranslations(savedLang);
        });
    </script>

</body>

</html>