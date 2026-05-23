<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

// Set locale untuk Carbon agar tanggal terjemah server-side.
$locale = Session::get('locale', 'id');
\Carbon\Carbon::setLocale($locale);

$user = Auth::user();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="profile-page-title">Profil Saya - Museum Brawijaya</title>

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

        .input-error {
            border-color: #EF4444 !important;
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
                        class="flex items-center space-x-1.5 px-3 py-2 text-gray-600 hover:text-brand-red hover:bg-gray-50 rounded-lg font-medium transition-colors whitespace-nowrap text-sm"><i
                            data-lucide="home" class="w-4 h-4"></i><span id="nav-home">Beranda</span></a>
                    <a href="{{ route('halaman-saya') }}"
                        class="flex items-center space-x-1.5 px-3 py-2 text-gray-600 hover:text-brand-red hover:bg-gray-50 rounded-lg font-medium transition-colors whitespace-nowrap text-sm"><i
                            data-lucide="layout-dashboard" class="w-4 h-4"></i><span id="nav-dashboard">Halaman
                            Saya</span></a>
                    <a href="{{ route('tiket-saya') }}"
                        class="flex items-center space-x-1.5 px-3 py-2 text-gray-600 hover:text-brand-red hover:bg-gray-50 rounded-lg font-medium transition-colors whitespace-nowrap text-sm"><i
                            data-lucide="ticket" class="w-4 h-4"></i><span id="nav-ticket">Tiket Saya</span></a>
                    <a href="{{ route('virtual-tour') }}"
                        class="flex items-center space-x-1.5 px-3 py-2 text-gray-600 hover:text-brand-red hover:bg-gray-50 rounded-lg font-medium transition-colors whitespace-nowrap text-sm"><i
                            data-lucide="video" class="w-4 h-4"></i><span id="nav-vtour">Virtual Tour</span></a>
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


    {{-- Konten Utama --}}
    <main class="w-full max-w-7xl mx-auto px-6 md:px-10 py-10 flex-grow flex flex-col overflow-hidden">

        <div class="mb-8 shrink-0">
            <h1 class="text-3xl font-bold text-brand-red" id="profile-main-title">Profil Saya</h1>
            <p class="text-gray-500 mt-1" id="profile-main-subtitle">Kelola informasi profil dan keamanan akun Anda</p>
        </div>

        {{-- AREA SCROLLABLE --}}
        <div class="flex-grow overflow-y-auto pr-2 pb-20">
            <div class="max-w-6xl mx-auto">

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                {{-- MODAL SUKSES --}}
                @if(session('profile_success') || session('password_success'))
                @endif

                <div class="space-y-6">

                    {{-- FORM INFORMASI PRIBADI --}}
                    <div class="bg-[#FFFFFF] border border-[#F0EAD6] rounded-xl p-6 md:p-8 shadow-sm">

                        <div class="flex items-center gap-2 mb-1">
                            <i data-lucide="user-circle" class="w-5 h-5 text-brand-red"></i>
                            <h2 class="text-xl font-bold text-[#69161D]" id="profile-info-title">Informasi Pribadi</h2>
                        </div>
                        <p class="text-gray-500 text-sm mb-6 ml-1" id="profile-info-subtitle">Perbarui identitas dan
                            kontak Anda</p>

                        <form action="{{ route('profil.update') }}" method="POST" class="space-y-4"
                            id="profile-update-form">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2"
                                        id="profile-label-name">Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name', Auth::user()->name ?? '') }}"
                                        class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-brand-red focus:border-transparent @error('name') input-error @enderror">
                                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2"
                                        id="profile-label-email">Email</label>
                                    <input type="email" name="email"
                                        value="{{ old('email', Auth::user()->email ?? '') }}"
                                        class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-brand-red focus:border-transparent @error('email') input-error @enderror">
                                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2"
                                        id="profile-label-whatsapp">WhatsApp</label>
                                    <input type="tel" name="whatsapp"
                                        value="{{ old('whatsapp', Auth::user()->whatsapp ?? '') }}"
                                        placeholder="08xxxxxxxxxx"
                                        class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-brand-red focus:border-transparent @error('whatsapp') input-error @enderror">
                                    @error('whatsapp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2"
                                        id="profile-label-language">Bahasa</label>
                                    <div class="relative">
                                        <select name="language" id="language-select-input"
                                            class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-brand-red focus:border-transparent">
                                            <option value="id" {{ (old('language') ?? (Auth::user()->language ?? 'id')) == 'id' ? 'selected' : '' }} id="lang-option-id">Indonesia</option>
                                            <option value="en" {{ (old('language') ?? (Auth::user()->language ?? 'id')) == 'en' ? 'selected' : '' }} id="lang-option-en">English</option>
                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                            <i data-lucide="chevron-down" class="h-4 w-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-2">
                                <button type="submit"
                                    class="bg-gradient-to-r from-museum-dark to-museum-light hover:opacity-95 text-white font-semibold py-2.5 px-6 rounded-lg shadow-sm flex items-center gap-2 transition-all">
                                    <i data-lucide="save" class="w-4 h-4"></i>
                                    <span id="profile-button-save">Simpan</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- FORM KEAMANAN (UBAH PASSWORD) --}}
                    <div class="bg-[#FFFFFF] border border-[#F0EAD6] rounded-xl p-6 md:p-8 shadow-sm">

                        <div class="flex items-center gap-2 mb-1">
                            <i data-lucide="lock" class="w-5 h-5 text-brand-red"></i>
                            <h2 class="text-xl font-bold text-[#69161D]" id="profile-security-title">Keamanan</h2>
                        </div>
                        <p class="text-gray-500 text-sm mb-6 ml-1" id="profile-security-subtitle">Ubah password untuk
                            keamanan akun yang lebih baik</p>

                        <form action="{{ route('profil.password') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2"
                                    id="profile-label-new-password">Password Baru</label>
                                <input type="password" name="password_baru" placeholder="•••••"
                                    class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-brand-red focus:border-transparent @error('password_baru') input-error @enderror">
                                @error('password_baru') <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2"
                                    id="profile-label-confirm-password">Konfirmasi Password Baru</label>
                                <input type="password" name="password_baru_confirmation" placeholder="•••••"
                                    class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-brand-red focus:border-transparent">
                            </div>

                            <div class="pt-2">
                                <button type="submit"
                                    class="bg-gradient-to-r from-museum-dark to-museum-light hover:opacity-95 text-white font-semibold py-2.5 px-6 rounded-lg shadow-sm flex items-center gap-2 transition-all">
                                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                                    <span id="profile-button-change-password">Ubah Password</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- INFORMASI AKUN (READ ONLY) --}}
                    <div class="bg-[#FFFFFF] border border-[#F0EAD6] rounded-xl p-6 md:p-8 shadow-sm">

                        <h2 class="text-xl font-bold text-[#69161D]" id="profile-account-info-title">Informasi Akun</h2>
                        <p class="text-gray-500 text-sm mb-6" id="profile-account-info-subtitle">Detail akun dan status
                            keanggotaan</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1"
                                    id="profile-label-email-ro">Email</p>
                                <p class="font-medium text-[#1F1F1F]">{{ Auth::user()->email ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1" id="profile-label-joined">
                                    Bergabung sejak</p>
                                <p class="font-medium text-[#1F1F1F]">
                                    {{ Auth::user()->created_at ? \Carbon\Carbon::parse(Auth::user()->created_at)->isoFormat('D MMMM Y') : '-' }}
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- MODAL SUKSES --}}
        @if(session('profile_success') || session('password_success'))
            <div class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-black/50 backdrop-blur-sm">
                <div
                    class="bg-white rounded-2xl shadow-2xl p-8 md:p-10 w-full max-w-md text-center border border-gray-100 transform transition-all scale-100">

                    <div class="flex items-center justify-center mb-6">
                        <div class="w-20 h-20 bg-green-600 rounded-full flex items-center justify-center shadow-sm">
                            <i data-lucide="check" class="w-10 h-10 text-white stroke-3"></i>
                        </div>
                    </div>

                    <h1 class="text-2xl font-bold text-[#1F1F1F] mb-2 tracking-tight" id="modal-success-title">
                        {{ session('profile_success') ?? session('password_success') }}
                    </h1>

                    <p class="text-[#8C7A6B] text-sm md:text-base mb-8" id="modal-success-desc">
                        Perubahan data profil Anda telah tersimpan.
                    </p>

                    <button onclick="this.closest('.fixed').remove();"
                        class="block w-full bg-[#69161D] hover:bg-[#5a1218] text-white font-semibold py-3.5 rounded-xl shadow-md transition-colors duration-300"
                        id="modal-button-close">
                        Tutup
                    </button>
                </div>
            </div>
        @endif

        <script src="{{ asset('js/translation.js') }}"></script>
        <script>
            lucide.createIcons();

            // --- LOGIKA SAVE LANGUAGE KE LOCAL STORAGE SEBELUM SUBMIT ---
            document.addEventListener('DOMContentLoaded', () => {
                const languageSelect = document.getElementById('language-select-input');
                const form = document.getElementById('profile-update-form');

                if (form && languageSelect) {
                    form.addEventListener('submit', () => {
                        // Simpan bahasa yang dipilih ke Local Storage saat formulir dikirim
                        localStorage.setItem('preferred_lang', languageSelect.value);
                    });
                }
            });
        </script>

</body>

</html>