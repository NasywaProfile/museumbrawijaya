<!DOCTYPE html>
<html lang="id" class="h-full overflow-hidden">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Saya - Museum Brawijaya</title>

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
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .hidden-slide { display: none; }
    </style>
</head>

<body class="bg-bg-light font-sans text-gray-900 flex flex-col h-screen overflow-hidden">

    {{-- Navbar Start --}}
    <nav class="bg-bg-light p-4 shadow-xl sticky top-0 z-50 shrink-0">
        <div class="container mx-auto flex justify-between items-center max-w-7xl px-4 sm:px-6 lg:px-12">
            <div class="flex-shrink-0">
                <a href="{{ route('beranda') }}" class="text-xl font-bold text-brand-red tracking-wider">Museum Brawijaya</a>
            </div>
            <div class="flex-1 flex justify-center px-4">
                <div class="flex items-center space-x-1 overflow-x-auto no-scrollbar">
                    <a href="{{ route('beranda') }}" class="flex items-center space-x-1.5 px-3 py-2 text-gray-600 hover:text-brand-red hover:bg-gray-50 rounded-lg font-medium transition-colors whitespace-nowrap text-sm">
                        <i data-lucide="home" class="w-4 h-4"></i><span id="nav-home">Beranda</span>
                    </a>
                    <a href="{{ route('halaman-saya') }}" class="flex items-center space-x-1.5 px-3 py-2 bg-[#FDF6E4] rounded-lg text-brand-red font-semibold transition-colors whitespace-nowrap text-sm">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i><span id="nav-dashboard">Halaman Saya</span>
                    </a>
                    <a href="{{ route('tiket-saya') }}" class="flex items-center space-x-1.5 px-3 py-2 text-gray-600 hover:text-brand-red hover:bg-gray-50 rounded-lg font-medium transition-colors whitespace-nowrap text-sm">
                        <i data-lucide="ticket" class="w-4 h-4"></i><span id="nav-ticket">Tiket Saya</span>
                    </a>
                    <a href="{{ route('virtual-tour') }}" class="flex items-center space-x-1.5 px-3 py-2 text-gray-600 hover:text-brand-red hover:bg-gray-50 rounded-lg font-medium transition-colors whitespace-nowrap text-sm">
                        <i data-lucide="video" class="w-4 h-4"></i><span id="nav-vtour">Virtual Tour</span>
                    </a>
                    <a href="{{ route('riwayat') }}" class="flex items-center space-x-1.5 px-3 py-2 text-gray-600 hover:text-brand-red hover:bg-gray-50 rounded-lg font-medium transition-colors whitespace-nowrap text-sm">
                        <i data-lucide="history" class="w-4 h-4"></i><span id="nav-history">Riwayat</span>
                    </a>
                </div>
            </div>
            <div class="flex items-center space-x-4 flex-shrink-0">
                <a href="{{ route('profil') }}" class="flex items-center space-x-1.5 text-black font-medium hover:text-brand-red transition-colors whitespace-nowrap text-sm">
                    <i data-lucide="user" class="w-4 h-4"></i><span>{{ Auth::user()->name ?? 'Akun' }}</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button 
    type="submit" 
    class="hidden sm:flex items-center space-x-1.5 px-3 py-2 
           border border-gray-300 rounded-lg text-black 
           hover:bg-[#69161d] hover:text-white hover:border-[#69161d]
           transition-colors whitespace-nowrap text-sm">
    <i data-lucide="log-out" class="w-4 h-4"></i>
    <span id="nav-logout">Keluar</span>
</button>

                    <button type="submit" class="sm:hidden flex items-center justify-center p-2 text-red-600 hover:bg-gray-50 rounded-lg transition-colors">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Konten Utama --}}
    <main class="w-full max-w-7xl mx-auto px-6 md:px-10 py-10 flex-grow flex flex-col h-full overflow-hidden">
        <div class="mb-8 shrink-0">
            <h1 class="text-3xl font-bold text-[#69161D]">
                <span id="dashboard-welcome">Selamat Datang</span>, {{ Auth::user()->name ?? 'User' }}!
            </h1>
            <p class="text-gray-500 mt-2" id="dashboard-subtitle">Kelola kunjungan dan nikmati pengalaman Museum Brawijaya</p>
        </div>

        <div class="flex-grow overflow-y-auto pr-2 pb-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                
                {{-- KIRI: TIKET MENDATANG --}}
                <div class="bg-[#FFFFFF] border border-[#F0EAD6] rounded-2xl p-8 shadow-sm min-h-[300px] flex flex-col relative group">
                    <div class="flex items-center gap-2 mb-4 absolute top-8 left-8">
                        <i data-lucide="ticket" class="w-5 h-5 text-[#69161D]"></i>
                        <h2 class="text-lg font-semibold text-[#69161D]" id="dashboard-card-ticket-title">Tiket Mendatang</h2>
                    </div>

<div class="flex-1 flex flex-col justify-start h-full pt-[70px] relative">
                        @if($activeTickets->isNotEmpty())
                            <div class="relative w-full flex items-center justify-center h-full">
                                <button id="prevTicket" class="absolute left-0 p-2 text-gray-400 hover:text-[#69161D] transition-colors hidden z-10"><i data-lucide="chevron-left" class="w-8 h-8"></i></button>

                                @foreach($activeTickets as $index => $ticket)
                                    <div class="ticket-slide w-full h-full flex flex-col items-center justify-start gap-1 transition-all duration-300 {{ $index > 0 ? 'hidden-slide' : '' }}" data-index="{{ $index }}">
                                        <p class="text-xs font-bold text-[#69161D] bg-[#FEF3C7] px-4 py-1 rounded-full tracking-wide mt-4 mb-3 inline-block">
                                            <span class="translatable" data-key="ticket-unit-label">TIKET</span> {{ $index + 1 }} / {{ $activeTickets->count() }}
                                        </p>
                                        
                                        {{-- TANGGAL DINAMIS --}}
                                        <h3 class="text-[#69161D] font-bold text-2xl tracking-tight leading-tight mb-4 dynamic-date" data-date="{{ $ticket->visit_date }}">
                                            {{ \Carbon\Carbon::parse($ticket->visit_date)->isoFormat('dddd, D MMMM Y') }}
                                        </h3>

                                        <div class="mt-4">
    <a href="/tiket-saya" 
       class="bg-button-yellow hover:bg-[#d99f2e] text-[#4A3B2A] text-sm font-bold h-10 w-[150px] 
              flex items-center justify-center rounded-xl transition-colors shadow-sm">
        <span class="translatable" data-key="view-qr-button" >Lihat Tiket</span>
    </a>
</div>

                                    </div>
                                @endforeach

                                <button id="nextTicket" class="absolute right-0 p-2 text-gray-400 hover:text-[#69161D] transition-colors {{ $activeTickets->count() <= 1 ? 'hidden' : '' }} z-10"><i data-lucide="chevron-right" class="w-8 h-8"></i></button>
                            </div>
                        @else
                            <div class="flex flex-col items-center text-center justify-center h-full pb-8">
                                <div class="mb-3 text-[#69161D] bg-[#FDF6E4] p-3 rounded-full"><i data-lucide="clock" class="w-8 h-8"></i></div>
                                <p class="text-[#796B5F] mb-6 text-sm" id="dashboard-card-ticket-empty">Belum ada tiket aktif</p>
                                
                                {{-- ARAHKAN KE TIKET SAYA --}}
                                <a href="{{ route('tiket-saya') }}" class="bg-button-yellow hover:bg-[#d99f2e] text-[#69161D] font-semibold px-6 py-2.5 rounded-lg transition-colors inline-block w-fit">
                                    <span id="dashboard-btn-book">Pesan Tiket</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- KANAN: VIRTUAL TOUR --}}
                <div class="bg-[#FFFFFF] border border-[#F0EAD6] rounded-2xl p-8 shadow-sm min-h-[300px] flex flex-col relative">
                    <div class="flex items-center gap-2 mb-4 absolute top-8 left-8">
                        <i data-lucide="video" class="w-5 h-5 text-[#69161D]"></i>
                        <h2 class="text-lg font-semibold text-[#69161D]" id="dashboard-card-vtour-title">Virtual Tour</h2>
                    </div>

<div class="flex-1 flex flex-col justify-start h-full pt-[70px] relative">
                        @if($hasVirtualTour)
                            <div class="w-full h-full flex flex-col items-center justify-center text-center gap-1">
                                <p class="text-xs font-bold text-[#69161D] bg-[#FEF3C7] px-4 py-1.5 rounded-full tracking-wide mb-3 inline-block" id="vtour-active-label">Tur Virtual</p>
                                <h3 class="text-[#69161D] font-bold text-2xl tracking-tight leading-tight mb-10" id="vtour-ready-text">Akses Tur Virtual</h3>
                                <div class="absolute bottom-2 left-0 right-0 flex justify-center items-center px-6">
                                    <a href="{{ route('virtual-tour') }}" class="bg-button-yellow hover:bg-[#d99f2e] text-[#4A3B2A] text-sm font-bold h-10 w-[150px] flex items-center justify-center rounded-xl transition-colors shadow-sm">
                                        <span id="start-vtour-button">Mulai Tour</span>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="flex flex-col items-center text-center justify-center h-full pb-8">
                                <div class="mb-3 text-[#69161D] bg-[#FDF6E4] p-3 rounded-full"><i data-lucide="camera" class="w-8 h-8"></i></div>
                                <p class="text-[#796B5F] mb-6 text-sm" id="dashboard-card-vtour-empty">Belum memiliki akses</p>
                                
                                {{-- ARAHKAN KE VIRTUAL TOUR (BUKAN LANGSUNG BELI) --}}
                                <a href="{{ route('virtual-tour') }}" class="bg-button-yellow hover:bg-[#d99f2e] text-[#69161D] font-semibold px-6 py-2.5 rounded-lg transition-colors text-sm shadow-sm inline-block">
                                    <span id="dashboard-btn-buy-vtour">Beli Virtual Tour</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- TRANSAKSI TERBARU --}}
            <div class="bg-[#FFFFFF] border border-[#F0EAD6] rounded-2xl p-8 min-h-[250px] flex flex-col shadow-sm">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-[#69161D] tracking-tight" id="dashboard-trans-title">Transaksi Terbaru</h2>
                    <p class="text-sm text-gray-500 mt-1" id="dashboard-trans-subtitle">2 transaksi terakhir Anda</p>
                </div>

                <div class="space-y-3">
                    @forelse($recentTransactions as $trx)
                        <div class="bg-[#FFFFFF] border border-[#E5E0D8] rounded-lg p-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 hover:bg-[#FFFDF5] transition-colors">
                            <div class="flex items-center gap-4">
                            <div class="p-2 bg-[#FDF6E4] hover:bg-[#d99f2e] rounded-full text-[#69161D]">
                                    @if($trx->category == 'Virtual Tour') <i data-lucide="video" class="w-5 h-5"></i>
                                    @else <i data-lucide="ticket" class="w-5 h-5"></i> @endif
                                </div>
                                <div>
                                    <p class="font-bold text-[#1F1F1F] text-base translatable" data-key="{{ $trx->category == 'Virtual Tour' ? 'virtual-tour-title' : 'ticket-visit-title' }}">
                                        {{ $trx->category == 'Umum' ? 'Tiket Kunjungan' : 'Virtual Tour' }}
                                    </p>
                                    
                                    <p class="text-sm text-[#8C7A6B] font-medium mt-1 dynamic-date" data-date="{{ $trx->visit_date ?? $trx->created_at }}">
                                        {{ \Carbon\Carbon::parse($trx->visit_date ?? $trx->created_at)->isoFormat('dddd, D MMMM Y') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 w-full sm:w-auto justify-between sm:justify-end">
                                <span class="font-bold text-[#1F1F1F] text-base">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</span>
                                
                                @if($trx->status == 'pending') 
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-4 py-1.5 rounded-lg lowercase first-letter:uppercase shadow-sm translatable" data-key="status-pending-small">Menunggu</span>
                                @elseif($trx->status == 'active') 
                                    <span class="bg-[#69161D] text-white text-xs font-bold px-4 py-1.5 rounded-lg shadow-sm translatable" data-key="status-active-small">Aktif</span>
                                @elseif($trx->status == 'used') 
                                    <span class="bg-gray-200 text-gray-500 text-xs font-bold px-4 py-1.5 rounded-lg shadow-sm translatable" data-key="status-used-small">Selesai</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="flex-1 flex flex-col items-center justify-center py-10 text-center">
                            <div class="mb-2 text-gray-300"><i data-lucide="shopping-bag" class="w-8 h-8"></i></div>
                            <h3 class="text-xs text-[#919191] mb-2" id="dashboard-trans-empty">Belum Ada Transaksi</h3>
                        </div>
                    @endforelse
                </div>
                @if(!$recentTransactions->isEmpty())
                    <div class="mt-8 text-center border-t border-dashed border-gray-200 pt-6">
                        <a href="{{ route('riwayat') }}" class="text-sm font-medium text-[#1F1F1F] hover:text-brand-red transition-colors flex items-center justify-center gap-1">
                            <span id="view-all-transactions">Lihat Semua Transaksi</span> <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </main>

    {{-- MODAL QR CODE --}}
    <div id="qr-modal" class="fixed inset-0 z-[60] flex items-center justify-center px-4 bg-[#1F1F1F]/90 backdrop-blur-sm hidden transition-opacity duration-300 opacity-0">
        <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-sm text-center relative transform transition-transform duration-300 scale-95" id="qr-modal-content">
            <div class="bg-white border border-[#E5E5E5] rounded-xl p-4 mb-6 inline-block shadow-sm">
                <img id="qr-image" src="" alt="QR Code Tiket" class="w-48 h-48 md:w-56 md:h-56 object-contain">
            </div>
            <p class="text-[#8C7A6B] text-sm md:text-base mb-8 font-medium" id="qr-modal-description">Scan QR code ini di pintu Museum Brawijaya</p>
            <button onclick="closeQrModal()" class="block w-full bg-[#69161D] hover:bg-[#5a1218] text-white font-semibold py-3.5 rounded-xl shadow-md transition-colors duration-300">
                <span id="close-qr-button">Tutup Kode Tiket</span>
            </button>
        </div>
    </div>

    <script src="{{ asset('js/translation.js') }}"></script>
    <script>
        lucide.createIcons();

        // 1. LOGIKA MODAL
        const modal = document.getElementById('qr-modal');
        const modalContent = document.getElementById('qr-modal-content');
        const qrImage = document.getElementById('qr-image');

        function openQrModal(ticketId) {
            let qrData = "Tiket-Museum-" + ticketId;
            qrImage.src = `https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=${qrData}&color=000000&bgcolor=ffffff`;
            modal.classList.remove('hidden');
            setTimeout(() => { modal.classList.remove('opacity-0'); modalContent.classList.remove('scale-95'); modalContent.classList.add('scale-100'); }, 10);
        }

        function closeQrModal() {
            modal.classList.add('opacity-0'); modalContent.classList.remove('scale-100'); modalContent.classList.add('scale-95');
            setTimeout(() => { modal.classList.add('hidden'); }, 300);
        }
        modal.addEventListener('click', function (e) { if (e.target === modal) closeQrModal(); });

        // 2. LOGIKA TRANSLASI DINAMIS
        document.addEventListener('DOMContentLoaded', () => {
            
            function updateDynamicTranslations(lang) {
                if (!translations[lang]) return;
                
                // 1. Update text biasa (Class: translatable)
                document.querySelectorAll('.translatable').forEach(el => {
                    const key = el.getAttribute('data-key');
                    if (translations[lang][key]) {
                        el.textContent = translations[lang][key];
                    }
                });

                // 2. Update Tanggal (Class: dynamic-date)
                const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const locale = lang === 'id' ? 'id-ID' : 'en-US';
                
                document.querySelectorAll('.dynamic-date').forEach(el => {
                    const rawDate = el.getAttribute('data-date'); 
                    if(rawDate) {
                        const dateObj = new Date(rawDate);
                        el.textContent = dateObj.toLocaleDateString(locale, dateOptions);
                    }
                });
            }

            // Jalankan saat load
            const savedLang = localStorage.getItem('preferred_lang') || 'id';
            updateDynamicTranslations(savedLang);

            // Listen perubahan bahasa
            const languageLinks = document.querySelectorAll('#language-menu a');
            languageLinks.forEach(link => {
                link.addEventListener('click', () => {
                    const selectedLang = link.getAttribute('data-lang');
                    setTimeout(() => updateDynamicTranslations(selectedLang), 50);
                });
            });

            // 3. LOGIKA SLIDER
            const slides = document.querySelectorAll('.ticket-slide');
            const prevBtn = document.getElementById('prevTicket');
            const nextBtn = document.getElementById('nextTicket');
            let currentIndex = 0;

            function updateSlider() {
                slides.forEach((slide, index) => {
                    if (index === currentIndex) {
                        slide.classList.remove('hidden-slide');
                        slide.classList.add('flex');
                    } else {
                        slide.classList.add('hidden-slide');
                        slide.classList.remove('flex');
                    }
                });
                if (prevBtn && nextBtn && slides.length > 0) {
                    prevBtn.style.display = currentIndex === 0 ? 'none' : 'block';
                    nextBtn.style.display = currentIndex === slides.length - 1 ? 'none' : 'block';
                }
            }

            if (slides.length > 0) {
                if (prevBtn) prevBtn.addEventListener('click', () => { if (currentIndex > 0) { currentIndex--; updateSlider(); } });
                if (nextBtn) nextBtn.addEventListener('click', () => { if (currentIndex < slides.length - 1) { currentIndex++; updateSlider(); } });
                updateSlider();
            }
        });
    </script>
</body>
</html>