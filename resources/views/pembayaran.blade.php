<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Museum Brawijaya</title>

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
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-bg-light min-h-screen text-gray-800 relative">

    {{-- Navigasi Kembali --}}
    <nav class="absolute top-0 left-0 p-6 md:p-8 w-full z-10">
        <a href="{{ $backUrl ?? route('tiket-saya') }}"
            class="flex items-center text-gray-600 hover:text-brand-red transition-colors w-fit">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
            <span class="ml-2 font-medium" id="pay-back">Kembali</span>
        </a>
    </nav>

    {{-- Kontainer Utama --}}
    <main class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-2xl">
            <div class="mb-5 text-center md:text-left">
                <h1 class="text-2xl font-bold text-brand-red" id="pay-title">Konfirmasi Pembayaran</h1>
                <p class="text-sm text-gray-500 mt-1" id="pay-subtitle">Silahkan Mengunggah Bukti Transfer Anda</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 md:p-6">
                {{-- Alert Error --}}
                <div id="error-alert"
                    class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 flex items-center gap-2"
                    role="alert">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                    <span class="block sm:inline font-medium" id="pay-error-text">Harap unggah bukti transfer terlebih
                        dahulu.</span>
                </div>

                <form id="payment-form" action="{{ route('pembayaran.proses') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="relative group">
                        <input type="file" id="file-upload" name="bukti_transfer" class="hidden"
                            accept=".jpg,.jpeg,.png">

                        <label for="file-upload" id="drop-area"
                            class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-[#8C7A6B]/40 rounded-lg cursor-pointer hover:bg-[#FDFBF7] hover:border-brand-red transition-all duration-300">

                            {{-- Ikon (Diberi ID agar bisa diubah warnanya) --}}
                            <div id="upload-icon-wrapper"
                                class="mb-2 text-[#8C7A6B] group-hover:text-brand-red transition-colors">
                                <i data-lucide="upload-cloud" class="w-8 h-8"></i>
                            </div>

                            {{-- Teks Label --}}
                            <span class="text-[#1F1F1F] font-semibold text-sm mb-1" id="file-label">
                                <span id="pay-upload-label">Klik untuk unggah bukti transfer</span>
                            </span>

                            {{-- Teks Hint --}}
                            <span class="text-xs text-gray-400" id="pay-upload-hint">Format: JPG, PNG (Maks. 5MB)</span>
                        </label>
                    </div>

                    <div class="mt-4 bg-[#FDF6E4] rounded-lg p-4 border border-[#F0EAD6]">
                        <h3 class="font-semibold text-[#1F1F1F] mb-2 text-sm" id="pay-info-title">Informasi Rekening
                            Transfer:</h3>
                        <div class="text-sm text-[#5C4D3C] space-y-1">
                            <div class="flex justify-between"><span id="pay-label-bank">Bank:</span><span
                                    class="font-medium">BCA</span></div>
                            <div class="flex justify-between"><span id="pay-label-rekening">No Rekening:</span><span
                                    class="font-medium">1234567890</span></div>
                            <div class="flex justify-between"><span id="pay-label-name">Atas Nama:</span><span
                                    class="font-medium">Museum Brawijaya</span></div>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-museum-dark to-museum-light text-white font-semibold py-3 rounded-xl shadow-md hover:opacity-95 transition-all flex justify-center items-center gap-2 mt-5 transform hover:scale-[1.01]">
                        <span id="pay-btn-submit">Konfirmasi Pembayaran</span>
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </div>
    </main>

    {{-- MODAL SUKSES --}}
    @if(isset($showSuccessModal) && $showSuccessModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-black/50 backdrop-blur-sm">
            <div
                class="bg-white rounded-2xl shadow-2xl p-8 md:p-10 w-full max-w-md text-center border border-gray-100 transform transition-all scale-100">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-24 h-24 bg-[#5F9E3F] rounded-full flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-[#1F1F1F] mb-2 tracking-tight" id="pay-modal-title">Bukti Pembayaran
                    Terkirim</h1>
                <p class="text-[#8C7A6B] text-sm md:text-base mb-8" id="pay-modal-desc">Pembayaran Akan Diverifikasi</p>
                <a href="{{ $redirectUrl ?? route('tiket-saya') }}"
                    class="block w-full bg-[#69161D] hover:bg-[#5a1218] text-white font-semibold py-3.5 rounded-xl shadow-md transition-colors duration-300">
                    <span id="pay-modal-close">Tutup</span>
                </a>
            </div>
        </div>
    @endif

    <script src="{{ asset('js/translation.js') }}"></script>
    <script>
        lucide.createIcons();
        document.addEventListener('DOMContentLoaded', () => {
            const fileInput = document.getElementById('file-upload');
            const fileLabel = document.getElementById('file-label');
            const dropArea = document.getElementById('drop-area');
            const iconWrapper = document.getElementById('upload-icon-wrapper'); // Ambil container ikon
            const form = document.getElementById('payment-form');
            const errorAlert = document.getElementById('error-alert');

            // --- LOGIKA SAAT FILE DIPILIH ---
            fileInput.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const fileName = this.files[0].name;

                    // 1. Ubah Teks Label (File Terpilih: nama_file.jpg)
                    const currentLang = localStorage.getItem('preferred_lang') || 'id';
                    let prefixText = 'File Terpilih: ';
                    if (typeof translations !== 'undefined' && translations[currentLang] && translations[currentLang]['js-file-selected']) {
                        prefixText = translations[currentLang]['js-file-selected'];
                    }
                    fileLabel.innerHTML = `<span class="text-green-700 font-bold">${prefixText} ${fileName}</span>`;

                    // 2. Ubah Border & Background jadi HIJAU
                    dropArea.classList.remove('border-dashed', 'border-[#8C7A6B]/40', 'hover:bg-[#FDFBF7]', 'hover:border-brand-red');
                    dropArea.classList.add('border-solid', 'border-green-500', 'bg-green-50');

                    // 3. Ubah Ikon jadi Centang Hijau
                    iconWrapper.classList.remove('text-[#8C7A6B]', 'group-hover:text-brand-red');
                    iconWrapper.classList.add('text-green-600');
                    iconWrapper.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>';

                    // Sembunyikan pesan error jika ada
                    errorAlert.classList.add('hidden');
                }
            });

            // --- VALIDASI SAAT SUBMIT ---
            form.addEventListener('submit', function (e) {
                if (!fileInput.value) {
                    e.preventDefault();
                    errorAlert.classList.remove('hidden');

                    // Efek error merah
                    dropArea.classList.add('border-red-500', 'bg-red-50');
                    dropArea.classList.remove('border-green-500', 'bg-green-50'); // Hapus hijau jika ada

                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        });
    </script>

</body>

</html>