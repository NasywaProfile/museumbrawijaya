<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Saya - Museum Brawijaya</title>
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
                        class="flex items-center space-x-1.5 px-3 py-2 bg-[#FDF6E4] rounded-lg text-brand-red font-semibold transition-colors whitespace-nowrap text-sm">
                        <i data-lucide="ticket" class="w-4 h-4"></i><span id="nav-ticket">Tiket Saya</span>
                    </a>
                    <a href="{{ route('virtual-tour') }}"
                        class="flex items-center space-x-1.5 px-3 py-2 text-gray-600 hover:text-brand-red hover:bg-gray-50 rounded-lg font-medium transition-colors whitespace-nowrap text-sm">
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

    {{-- Konten Utama --}}
    <main class="w-full max-w-7xl mx-auto px-6 md:px-10 py-10 flex-grow flex flex-col h-full overflow-hidden">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 shrink-0">
            <div>
                <h1 class="text-3xl font-bold text-[#69161D]" id="ticket-page-title">Tiket Saya</h1>
                <p class="text-gray-500 mt-2" id="ticket-page-subtitle">Kelola dan unduh tiket kunjungan Anda</p>
            </div>

            <a href="{{ route('pesan-tiket') }}"
                class="inline-flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-museum-dark to-museum-light border border-white/40 text-white font-bold rounded-xl shadow-md hover:opacity-90 transition-all duration-300 transform hover:scale-[1.02] text-sm">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                <span id="book-other-ticket">Pesan Tiket Lainnya</span>
            </a>
        </div>

        @if(session('success'))
            <div
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 w-full text-sm shrink-0">
                {{ session('success') }}
            </div>
        @endif

        {{-- AREA SCROLLABLE --}}
        <div class="flex-grow overflow-y-auto no-scrollbar pb-20">
            @php
                $validTickets = $tickets->filter(function ($ticket) {
                    return $ticket->status != 'unpaid';
                });
            @endphp

            @if($validTickets->isEmpty())
                <div class="h-full flex items-start justify-center pt-4">
                    <div
                        class="bg-[#FFFFFF] border border-[#F0EAD6] rounded-xl p-8 w-full max-w-4xl flex flex-col items-center justify-center text-center shadow-sm min-h-[300px]">
                        <div class="mb-4 text-[#69161D] bg-[#FDF6E4] p-4 rounded-full">
                            <i data-lucide="ticket" class="w-8 h-8"></i>
                        </div>
                        <h2 class="text-xm font-bold text-[#69161D] mb-2" id="ticket-empty-title">Belum Ada Tiket</h2>

                        <p class="text-gray-500 text-xs max-w-md mb-6 text-sm leading-relaxed" id="ticket-desc-title">
                            Anda belum memiliki tiket kunjungan. Pesan tiket pertama Anda sekarang untuk mulai menjelajahi
                            museum!
                        </p>

                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach($validTickets as $ticket)
                        <div
                            class="bg-white border border-[#E5E0D8] rounded-xl shadow-sm p-6 md:p-8 hover:shadow-md transition-shadow w-full flex flex-col gap-4 h-full">
                            <div
                                class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-dashed border-gray-100 pb-4">
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <h2 class="text-xl font-bold text-brand-red">
                                            <span class="translatable" data-key="ticket-type-label">Tiket</span>
                                            <span class="translatable" data-key="category-umum">{{ $ticket->category }}</span>
                                        </h2>

                                        @if($ticket->status == 'pending')
                                            <span
                                                class="bg-yellow-50 text-yellow-700 border border-yellow-200 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider translatable"
                                                data-key="status-pending">Menunggu Konfirmasi</span>
                                        @elseif($ticket->status == 'active')
                                            <span
                                                class="bg-green-50 text-green-700 border border-green-200 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider translatable"
                                                data-key="status-active">Aktif</span>
                                        @elseif($ticket->status == 'used')
                                            <span
                                                class="bg-gray-100 text-gray-600 border border-gray-300 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider translatable"
                                                data-key="status-used">Selesai</span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-400 font-mono">ID: #{{ $ticket->id }}</p>
                                </div>
                                <div class="text-left md:text-right">
                                    <p class="text-[10px] uppercase text-gray-500 mb-0.5 font-semibold translatable"
                                        data-key="total-pay-label">Total Bayar</p>
                                    <span class="text-xl font-bold text-brand-red">Rp
                                        {{ number_format($ticket->total_price, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                <div>
                                    <span class="text-xs text-gray-400 block mb-1 uppercase tracking-wide translatable"
                                        data-key="date-label">Tanggal</span>
                                    <div class="flex items-center gap-2 text-gray-800 font-medium text-base">
                                        <i data-lucide="calendar" class="w-4 h-4 text-brand-red"></i>
                                        {{-- TANGGAL DINAMIS --}}
                                        <span class="dynamic-date" data-date="{{ $ticket->visit_date }}">
                                            {{ \Carbon\Carbon::parse($ticket->visit_date)->isoFormat('D MMM Y') }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-xs text-gray-400 block mb-1 uppercase tracking-wide translatable"
                                        data-key="quantity-label">Jumlah</span>
                                    <div class="flex items-center gap-2 text-gray-800 font-medium text-base">
                                        <i data-lucide="users" class="w-4 h-4 text-brand-red"></i>
                                        {{ $ticket->quantity }}
                                        <span class="translatable" data-key="person-unit">Orang</span>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <span class="text-xs text-gray-400 block mb-1 uppercase tracking-wide translatable"
                                        data-key="location-label">Lokasi</span>
                                    <div class="flex items-center gap-2 text-gray-800 font-medium text-base">
                                        <i data-lucide="map-pin" class="w-4 h-4 text-brand-red"></i>
                                        Museum Brawijaya, Malang
                                    </div>
                                </div>
                            </div>

                            <div class="mt-auto pt-4 border-t border-gray-100">
                                @if($ticket->status == 'pending')
                                    <div
                                        class="bg-gray-50 rounded-lg p-3 text-center text-xs text-gray-500 border border-gray-100 flex items-center justify-center gap-2">
                                        <i data-lucide="clock" class="w-4 h-4 text-yellow-600"></i>
                                        <span class="translatable" data-key="pending-info">Pembayaran sedang diverifikasi.</span>
                                    </div>
                                @elseif($ticket->status == 'active')
                                    <div class="flex flex-col sm:flex-row justify-between items-center gap-3">
                                        <div class="flex items-center gap-2 text-xs text-gray-500">
                                            <i data-lucide="check-circle" class="w-4 h-4 text-green-500"></i>
                                            <span class="translatable" data-key="active-info">Tiket siap digunakan.</span>
                                        </div>
                                        <button onclick="openQrModal('{{ $ticket->id }}', '{{ $ticket->quantity }}')"
                                            class="w-full sm:w-auto bg-white border-2 border-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-bold flex items-center justify-center gap-2 hover:border-brand-red hover:text-brand-red transition-all shadow-sm">
                                            <i data-lucide="maximize" class="w-4 h-4"></i>
                                            <span class="translatable" data-key="view-qr-button">Lihat QR</span>
                                        </button>
                                    </div>
                                @elseif($ticket->status == 'used')
                                    <div
                                        class="bg-gray-50 rounded-lg p-3 text-center text-xs text-gray-500 border border-gray-200 flex items-center justify-center gap-2">
                                        <i data-lucide="check-circle-2" class="w-4 h-4 text-gray-400"></i>
                                        <span class="translatable" data-key="used-info">Terima kasih! Tiket telah digunakan.</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>

    {{-- MODAL QR CODE --}}
    <div id="qr-modal"
        class="fixed inset-0 z-[60] flex items-center justify-center px-4 bg-[#1F1F1F]/90 backdrop-blur-sm hidden transition-opacity duration-300 opacity-0">
        <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-sm text-center relative transform transition-transform duration-300 scale-95"
            id="qr-modal-content">

            <div class="relative w-full flex items-center justify-center mb-6">
                <button id="qrPrev" class="absolute left-0 p-2 text-gray-300 hover:text-brand-red hidden">
                    <i data-lucide="chevron-left" class="w-6 h-6"></i>
                </button>

                <div id="qrSlider" class="w-full flex flex-col items-center"></div>

                <button id="qrNext" class="absolute right-0 p-2 text-gray-300 hover:text-brand-red hidden">
                    <i data-lucide="chevron-right" class="w-6 h-6"></i>
                </button>
            </div>

            <p class="text-[#8C7A6B] text-sm md:text-base mb-8 font-medium" id="qr-modal-description">
                Scan QR code ini di pintu Museum Brawijaya
            </p>

            <button onclick="closeQrModal()"
                class="block w-full bg-[#69161D] hover:bg-[#5a1218] text-white font-semibold py-3.5 rounded-xl shadow-md transition-colors duration-300">
                <span id="close-qr-button">Tutup Kode Tiket</span>
            </button>
        </div>
    </div>

    </div>

    <script src="{{ asset('js/translation.js') }}"></script>
    <script>
        lucide.createIcons();
        const modal = document.getElementById('qr-modal');
        const modalContent = document.getElementById('qr-modal-content');
        const qrImage = document.getElementById('qr-image');

        let currentQR = 0;
        let qrSlides = [];

        function openQrModal(ticketId, quantity) {
            quantity = parseInt(quantity);
            const qrSlider = document.getElementById('qrSlider');

            qrSlider.innerHTML = "";
            qrSlides = [];

            for (let i = 1; i <= quantity; i++) {
                const qrData = `Tiket-Museum-${ticketId}-${i}`;
                const slide = document.createElement('div');

                slide.className = `qr-slide ${i === 1 ? 'flex' : 'hidden'} flex-col items-center`;
                slide.innerHTML = `
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrData}"
                class="w-48 h-48 object-contain mb-2" />
            <p class="text-xs text-gray-500">QR ${i} / ${quantity}</p>
        `;

                qrSlides.push(slide);
                qrSlider.appendChild(slide);
            }

            document.getElementById('qrPrev').style.display = quantity > 1 ? 'block' : 'none';
            document.getElementById('qrNext').style.display = quantity > 1 ? 'block' : 'none';

            currentQR = 0;
            updateQrSlider();

            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }

        function updateQrSlider() {
            qrSlides.forEach((slide, idx) => {
                slide.classList.toggle('hidden', idx !== currentQR);
                slide.classList.toggle('flex', idx === currentQR);
            });
        }

        document.getElementById('qrPrev').onclick = () => {
            if (currentQR > 0) {
                currentQR--;
                updateQrSlider();
            }
        };

        document.getElementById('qrNext').onclick = () => {
            if (currentQR < qrSlides.length - 1) {
                currentQR++;
                updateQrSlider();
            }
        };

        function closeQrModal() {
            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }


        function closeQrModal() {
            modal.classList.add('opacity-0'); modalContent.classList.remove('scale-100'); modalContent.classList.add('scale-95');
            setTimeout(() => { modal.classList.add('hidden'); }, 300);
        }
        modal.addEventListener('click', function (e) { if (e.target === modal) closeQrModal(); });

        document.addEventListener('DOMContentLoaded', () => {

            function updateDynamicTranslations(lang) {
                if (!translations[lang]) return;

                // Update text biasa 
                document.querySelectorAll('.translatable').forEach(el => {
                    const key = el.getAttribute('data-key');
                    if (translations[lang][key]) {
                        el.textContent = translations[lang][key];
                    }
                });

                // Update Tanggal 
                const dateOptions = { day: 'numeric', month: 'short', year: 'numeric' };
                const locale = lang === 'id' ? 'id-ID' : 'en-US';

                document.querySelectorAll('.dynamic-date').forEach(el => {
                    const rawDate = el.getAttribute('data-date');
                    if (rawDate) {
                        const dateObj = new Date(rawDate);
                        el.textContent = dateObj.toLocaleDateString(locale, dateOptions);
                    }
                });
            }

            // Jalankan saat load
            const savedLang = localStorage.getItem('preferred_lang') || 'id';
            updateDynamicTranslations(savedLang);
        });
    </script>
</body>

</html>