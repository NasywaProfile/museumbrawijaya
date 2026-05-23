<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

$user = Auth::user();

// Setup locale untuk Carbon agar tanggal bisa terjemah server-side
$locale = Session::get('locale', 'id');
\Carbon\Carbon::setLocale($locale);

// Ambil Semua Transaksi (KECUALI YANG BELUM BAYAR)
$transactions = Transaction::where('user_id', $user->id)
    ->where('status', '!=', 'unpaid') // Filter: Hapus yang belum bayar
    ->latest()
    ->get();

// Hitung Ringkasan
$totalTransaksi = $transactions->count();

// Hitung pengeluaran 
$totalPengeluaran = $transactions->whereIn('status', ['active', 'used'])->sum('total_price');
?>

<!DOCTYPE html>
<html lang="id" class="h-full overflow-hidden">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="history-page-title">Riwayat Transaksi - Museum Brawijaya</title>

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

                    {{-- AKTIF --}}
                    <a href="{{ route('riwayat') }}"
                        class="flex items-center space-x-1.5 px-3 py-2 bg-[#FDF6E4] rounded-lg text-brand-red font-semibold transition-colors whitespace-nowrap text-sm"><i
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


    {{-- Konten Utama  --}}
    <main class="w-full max-w-7xl mx-auto px-6 md:px-10 py-10 flex-grow flex flex-col h-full overflow-hidden">

        {{-- Header --}}
        <div class="mb-8 shrink-0">
            <h1 class="text-3xl font-bold text-[#69161D]" id="history-main-title">Riwayat Transaksi</h1>
            <p class="text-gray-500 mt-2" id="history-main-subtitle">Lihat semua transaksi pembelian tiket dan layanan
                museum</p>
        </div>

        {{-- Area Scrollable --}}
        <div class="flex-grow overflow-y-auto pr-2 pb-20">

            {{-- Ringkasan Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                {{-- Total Transaksi --}}
                <div
                    class="bg-[#FFFFFF] border border-[#F0EAD6] rounded-xl p-6 flex justify-between items-center shadow-sm">
                    <div>
                        <p class="text-xl font-bold text-[#69161D] mb-1" id="total-trx-label">Total Transaksi</p>
                        <p class="text-xl font-bold text-[#69161D]">{{ $totalTransaksi }}</p>
                    </div>
                    <div class="text-[#69161D] bg-[#FDF6E4] p-3 rounded-full">
                        <i data-lucide="history" class="w-6 h-6"></i>
                    </div>
                </div>

                {{-- Total Pengeluaran --}}
                <div
                    class="bg-[#FFFFFF] border border-[#F0EAD6] rounded-xl p-6 flex justify-between items-center shadow-sm">
                    <div>
                        <p class="text-xl font-bold text-[#ECAE36] mb-1" id="total-spending-label">Total Pengeluaran</p>
                        <p class="text-xl font-bold text-[#ECAE36]">Rp
                            {{ number_format($totalPengeluaran, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="text-[#ECAE36] bg-[#FFFBEB] p-3 rounded-full">
                        <i data-lucide="wallet" class="w-6 h-6"></i>
                    </div>
                </div>

            </div>

            {{-- Daftar Semua Transaksi --}}
            <div class="bg-[#FFFFFF] border border-[#F0EAD6] rounded-xl p-8 min-h-[400px] flex flex-col shadow-sm">

                <div class="mb-6 pb-4 border-b border-dashed border-gray-200">
                    <h2 class="text-xl font-bold text-[#69161D]" id="all-transactions-title">Semua Transaksi</h2>
                    <p class="text-sm text-gray-500 mt-1" id="all-transactions-subtitle">Riwayat lengkap pembelian tiket
                        dan layanan</p>
                </div>

                @if($transactions->isEmpty())
                    {{-- EMPTY STATE --}}
                    <div class="flex-1 flex flex-col items-center justify-center text-center py-10">
                        <div class="mb-2 text-gray-300"><i data-lucide="shopping-bag" class="w-8 h-8"></i></div>
                        <p class="text-xs text-gray-500 mt-2" id="history-empty-desc">Riwayat transaksi Anda kosong</p>
                    </div>
                @else
                    {{-- LIST DATA --}}
                    <div class="space-y-3">
                        @foreach($transactions as $trx)
                            <div class="bg-[#FFFFFF] border border-[#E5E0D8] rounded-lg 
                            p-4 flex flex-col sm:flex-row justify-between 
                            items-start sm:items-center gap-4 
                            hover:bg-[#FFFDF5] transition-colors shadow-sm">

                                <div class="flex items-center gap-4">

                                    <div class="p-2 bg-[#FDF6E4] rounded-full text-[#69161D]">
                                        @if($trx->category == 'Virtual Tour')
                                            <i data-lucide="video" class="w-5 h-5"></i>
                                        @else
                                            <i data-lucide="ticket" class="w-5 h-5"></i>
                                        @endif
                                    </div>

                                    <div>
                                        <p class="font-bold text-[#1F1F1F] text-base">
@php
    $label = $trx->category == 'Umum' ? 'Tiket Kunjungan' : $trx->category;
    $key = 'category-' . strtolower(str_replace(' ', '-', $label));
@endphp

<span class="translatable" data-key="{{ $key }}">
    {{ $label }}
</span>

                                        </p>

                                        <p class="text-sm text-[#8C7A6B] font-medium mt-1 dynamic-date"
   data-date="{{ $trx->visit_date ?? $trx->created_at }}">
    {{ \Carbon\Carbon::parse($trx->visit_date ?? $trx->created_at)->isoFormat('dddd, D MMMM Y') }}
</p>

                                    </div>
                                </div>

                                <div class="flex items-center gap-4 w-full sm:w-auto justify-between sm:justify-end">
                                    <span class="font-bold text-[#1F1F1F] text-base">
                                        Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                    </span>

                                    @if($trx->status == 'pending')
    <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-4 py-1.5 
        rounded-lg shadow-sm translatable" data-key="status-pending-small">
        Menunggu
    </span>

@elseif($trx->status == 'active')
    <span class="bg-[#69161D] text-white text-xs font-bold px-4 py-1.5 
        rounded-lg shadow-sm translatable" data-key="status-active-small">
        Aktif
    </span>

@elseif($trx->status == 'used')
    <span class="bg-gray-200 text-gray-500 text-xs font-bold px-4 py-1.5 
        rounded-lg shadow-sm translatable" data-key="status-used-small">
        Selesai
    </span>
@endif

                                </div>

                            </div>
                        @endforeach
                    </div>

                @endif

            </div>

        </div>
    </main>

    <script src="{{ asset('js/translation.js') }}"></script>
    <script>
        lucide.createIcons();
    </script>
    <script>
document.addEventListener("DOMContentLoaded", () => {

    function updateDates(lang) {
        const locale = lang === "id" ? "id-ID" : "en-US";

        const options = {
            weekday: "long",
            day: "numeric",
            month: "long",
            year: "numeric"
        };

        document.querySelectorAll(".dynamic-date").forEach(el => {
            const raw = el.getAttribute("data-date");
            if (!raw) return;

            const dt = new Date(raw);
            el.textContent = dt.toLocaleDateString(locale, options);
        });
    }

    const savedLang = localStorage.getItem("preferred_lang") || "id";
    updateDates(savedLang);

    // listen perubahan bahasa seperti Halaman Saya
    const langLinks = document.querySelectorAll("#language-menu a");
    langLinks.forEach(a => {
        a.addEventListener("click", () => {
            const selected = a.getAttribute("data-lang");
            setTimeout(() => updateDates(selected), 50);
        });
    });
});
</script>

</body>

</html>