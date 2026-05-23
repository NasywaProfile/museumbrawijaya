<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket - Museum Brawijaya</title>
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
        input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
            opacity: 0.6;
        }

        input[type="date"]::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }
    </style>
</head>

<body class="bg-bg-light min-h-screen text-gray-800">

    <nav class="pt-8 px-6 md:px-10 max-w-7xl mx-auto">
        {{-- TOMBOL KEMBALI KE HALAMAN SEBELUMNYA --}}
        <a href="javascript:history.back()"
            class="flex items-center text-gray-600 hover:text-brand-red transition-colors w-fit">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
            <span class="ml-2 font-medium" id="page-back">Kembali</span>
        </a>
    </nav>

    <main class="max-w-7xl mx-auto px-6 md:px-10 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-brand-red" id="booking-title">Pesan Tiket Kunjungan</h1>
            <p class="text-gray-500 mt-2" id="booking-subtitle">Pilih tanggal kunjungan Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 relative">
            <div class="lg:col-span-2">
                <div class="bg-[#FFFFFF] border border-[#F0EAD6] rounded-xl p-6 md:p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-2">
                        <i data-lucide="clipboard-list" class="w-6 h-6 text-brand-red"></i>
                        <h2 class="text-xl font-bold text-[#69161D]" id="booking-details-title">Detail Kunjungan</h2>
                    </div>
                    <p class="text-gray-500 text-sm mb-6 ml-1" id="booking-details-desc">Lengkapi informasi kunjungan
                        Anda</p>

                    <form action="{{ route('pesan-tiket.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2"
                                id="label-ticket-category">Kategori Tiket</label>
                            <div
                                class="flex justify-between items-center bg-[#FDF6E4] border border-[#ECAE36] rounded-lg p-4 cursor-pointer ring-1 ring-[#ECAE36]">
                                <div>
                                    <span class="block font-semibold text-[#1F1F1F]"
                                        id="ticket-type-general">Umum</span>
                                    <span class="text-xs text-gray-500" id="ticket-desc-general">Tiket standar untuk
                                        pengunjung</span>
                                </div>
                                <span class="font-bold text-brand-red">Rp 10.000,00</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2" id="label-visit-date">Tanggal
                                Kunjungan</label>
                            <div class="relative">
                                <input type="date" name="visit_date" id="date-input" value="{{ date('Y-m-d') }}"
                                    class="w-full bg-white border border-gray-300 text-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-brand-red focus:border-transparent cursor-pointer"
                                    required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2" id="label-ticket-qty">Jumlah
                                Tiket</label>
                            <div class="flex items-center space-x-4">
                                <button type="button" id="btn-minus" class="w-10 h-10 flex items-center justify-center rounded-lg border border-[#69161D] text-white bg-[#69161D] 
        hover:bg-transparent hover:text-[#69161D] transition-all duration-200">
                                    <i data-lucide="minus" class="w-4 h-4"></i>
                                </button>

                                <span id="qty-display"
                                    class="text-xl font-semibold w-8 text-center text-[#1F1F1F]">1</span>
                                <input type="hidden" name="quantity" id="qty-input" value="1">

                                <button type="button" id="btn-plus" class="w-10 h-10 flex items-center justify-center rounded-lg border border-[#69161D] text-white bg-[#69161D] 
        hover:bg-transparent hover:text-[#69161D] transition-all duration-200">
                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                </button>
                            </div>

                        </div>
                        <div class="bg-[#FDF6E4] rounded-lg p-5 border border-[#F0EAD6]">
                            <h3 class="font-semibold text-[#60161D] mb-2 text-sm" id="label-transfer-info">Informasi
                                Rekening Transfer:</h3>
                            <div class="text-sm text-[#5C4D3C] space-y-1">
                                <p><span id="label-bank">Bank:</span> <span class="font-medium">BCA</span></p>
                                <p><span id="label-account-no">No Rekening:</span> <span
                                        class="font-medium">1234567890</span></p>
                                <p><span id="label-account-name">Atas Nama:</span> <span class="font-medium">Museum
                                        Brawijaya</span></p>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-museum-dark to-museum-light border border-white/40 text-white font-bold py-4 rounded-xl shadow-md hover:opacity-95 transition-all flex justify-center items-center gap-2 mt-4 transform hover:scale-[1.01]">
                            <span id="btn-submit-text">Lanjutkan ke Pembayaran - Rp 10.000,00</span>
                            <i data-lucide="arrow-right" class="w-5 h-5"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-[#FFFFFF] border border-[#F0EAD6] rounded-xl p-6 shadow-sm sticky top-8">
                    <div class="flex items-center gap-3 mb-6">
                        <i data-lucide="shopping-bag" class="w-5 h-5 text-brand-red"></i>
                        <h2 class="text-lg font-bold text-[#69161D]" id="summary-title">Ringkasan Pesanan</h2>
                    </div>
                    <div class="space-y-4 text-sm text-gray-600 mb-6">
                        <div class="flex justify-between items-start">
                            <span id="summary-label-category">Kategori</span>
                            <span class="font-medium text-black text-right" id="summary-category-value">Umum</span>
                        </div>
                        <div class="flex justify-between items-start">
                            <span id="summary-label-date">Tanggal</span>
                            <span id="summary-date" class="font-medium text-black text-right">{{ date('d/m/Y') }}</span>
                        </div>
                        <div class="flex justify-between items-start">
                            <span id="summary-label-qty">Jumlah</span>
                            <span class="font-medium text-black text-right">
                                <span id="summary-qty-num">1</span>
                                <span id="summary-unit-ticket">tiket</span>
                            </span>
                        </div>
                        <div class="flex justify-between items-start">
                            <span id="summary-label-price">Harga per tiket</span>
                            <span class="font-medium text-black text-right">Rp 10.000,00</span>
                        </div>
                    </div>
                    <hr class="border-dashed border-gray-300 my-4">
                    <div class="flex justify-between items-end mb-6">
                        <span class="text-lg font-bold text-[#69161D]" id="summary-label-total">Total</span>
                        <span id="summary-total" class="text-xl font-bold text-black text-brand-red">Rp 10.000,00</span>
                    </div>
                    <div class="bg-[#F5F5F5] rounded-lg p-4 border border-gray-200">
                        <h3 class="font-semibold text-gray-700 text-xs mb-2 uppercase tracking-wide"
                            id="important-info-title">Informasi Penting:</h3>
                        <ul class="text-xs text-gray-500 space-y-2 list-disc pl-4 leading-relaxed">
                            <li id="important-info-1">Tiket berlaku hanya untuk tanggal yang dipilih</li>
                            <li id="important-info-2">Mohon datang 15 menit sebelum jam buka</li>
                            <li id="important-info-3">QR Code akan dikirim setelah pembayaran</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('js/translation.js') }}"></script>
    <script>
        lucide.createIcons();

        document.addEventListener('DOMContentLoaded', () => {
            // --- LOGIC CALCULATOR ---
            const btnMinus = document.getElementById('btn-minus');
            const btnPlus = document.getElementById('btn-plus');
            const qtyDisplay = document.getElementById('qty-display');
            const qtyInput = document.getElementById('qty-input');
            const summaryQtyNum = document.getElementById('summary-qty-num');
            const summaryTotal = document.getElementById('summary-total');
            const btnSubmitText = document.getElementById('btn-submit-text');
            const dateInput = document.getElementById('date-input');
            const summaryDate = document.getElementById('summary-date');

            const ticketPrice = 10000;
            let currentQty = 1;

            function formatRupiah(amount) { return 'Rp ' + amount.toLocaleString('id-ID') + ',00'; }

            function updatePriceUI() {
                // Update Logika Angka
                qtyDisplay.innerText = currentQty;
                qtyInput.value = currentQty;
                summaryQtyNum.innerText = currentQty; // Update angka di ringkasan

                const totalPrice = currentQty * ticketPrice;
                const formattedPrice = formatRupiah(totalPrice);

                summaryTotal.innerText = formattedPrice;

                // Update Teks Tombol (Memperhatikan Bahasa Aktif)
                const currentLang = localStorage.getItem('preferred_lang') || 'id';
                let prefix = 'Lanjutkan ke Pembayaran - ';

                // Pastikan translations object ada dan terload
                if (typeof translations !== 'undefined' && translations[currentLang] && translations[currentLang]['btn-submit-prefix']) {
                    prefix = translations[currentLang]['btn-submit-prefix'];
                }

                btnSubmitText.innerText = prefix + formattedPrice;
            }

            function formatDate(dateString) {
                const [year, month, day] = dateString.split('-');
                return `${day}/${month}/${year}`;
            }

            btnMinus.addEventListener('click', () => { if (currentQty > 1) { currentQty--; updatePriceUI(); } });
            btnPlus.addEventListener('click', () => { currentQty++; updatePriceUI(); });
            dateInput.addEventListener('change', (e) => { summaryDate.innerText = formatDate(e.target.value); });

            summaryDate.innerText = formatDate(dateInput.value);

            updatePriceUI();
        });
    </script>
</body>

</html>