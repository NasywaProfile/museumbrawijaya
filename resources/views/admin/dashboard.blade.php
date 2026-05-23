<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Admin - Museum Brawijaya</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .status-btn {
            @apply px-4 py-1.5 text-xs font-semibold rounded-lg inline-flex items-center justify-center gap-1;
            height: 32px;
            min-width: 110px;
            text-align: center;
        }
    </style>
</head>

<body class="bg-[#FBFAF9] min-h-screen p-4 md:p-8">

    <div class="max-w-[1600px] mx-auto">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-[#69161D]">Beranda Admin</h1>
                <p class="text-gray-500 mt-1">Sistem Manajemen Tiket Museum</p>
            </div>

            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-gray-600">Halo, Admin</span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="hidden sm:flex items-center space-x-1.5 px-3 py-2 
                        border border-gray-300 rounded-lg text-black 
                        hover:bg-[#69161d] hover:text-white hover:border-[#69161d]
                        transition-colors whitespace-nowrap text-sm">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        <span id="nav-logout">Keluar</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- SUMMARY CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

            <div class="bg-white border border-[#F0EAD6] p-6 rounded-xl shadow-sm">
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 text-sm">Total Pengguna</span>
                    <div class="text-[#69161D] bg-[#FDF6E4] p-2 rounded-lg">
                        <i data-lucide="users" class="w-5 h-5"></i>
                    </div>
                </div>
                <div class="text-3xl font-bold text-[#69161D] mt-2">{{ $totalUsers }}</div>
            </div>

            <div class="bg-white border border-[#F0EAD6] p-6 rounded-xl shadow-sm">
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 text-sm">Tiket Terjual</span>
                    <div class="text-[#ECAE36] bg-[#FFF5DA] p-2 rounded-lg">
                        <i data-lucide="ticket" class="w-5 h-5"></i>
                    </div>
                </div>
                <div class="text-3xl font-bold text-[#ECAE36] mt-2">{{ $totalTickets }}</div>
            </div>

            <div class="bg-white border border-[#F0EAD6] p-6 rounded-xl shadow-sm">
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 text-sm">Akses Tur Virtual</span>
                    <div class="text-blue-600 bg-blue-50 p-2 rounded-lg">
                        <i data-lucide="video" class="w-5 h-5"></i>
                    </div>
                </div>
                <div class="text-3xl font-bold text-blue-600 mt-2">{{ $totalVirtualTour }}</div>
            </div>

            <div class="bg-white border border-[#F0EAD6] p-6 rounded-xl shadow-sm">
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 text-sm">Total Pendapatan</span>
                    <div class="text-green-600 bg-green-50 p-2 rounded-lg">
                        <i data-lucide="wallet" class="w-5 h-5"></i>
                    </div>
                </div>
                <div class="text-3xl font-bold text-green-600 mt-2">
                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">


            <!-- Transaksi Tiket -->
            <div class="bg-white border border-[#F0EAD6] rounded-xl p-6 shadow-sm">

                <!-- HEADER + SEARCH -->
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-2">
                        <i data-lucide="ticket" class="w-5 h-5 text-[#69161D]"></i>
                        <h2 class="text-xl font-bold">Transaksi Tiket</h2>
                    </div>

                    <div class="flex items-center gap-2">
                        <!-- ICON SEARCH -->
                        <button onclick="toggleSearch('ticketSearchBox')"
                            class="p-2 rounded-lg hover:bg-gray-100 transition">
                            <i data-lucide="search" class="w-5 h-5 text-gray-600"></i>
                        </button>

                        <!-- SEARCH BOX -->
                        <div id="ticketSearchBox" class="hidden opacity-0 transition-all duration-200">
                            <form onsubmit="filterTable(event,'ticketTable','ticketSearchInput')">
                                <div class="flex items-center bg-white border border-gray-300 rounded-lg px-3">
                                    <input id="ticketSearchInput" type="text" placeholder="Cari pengguna..."
                                        class="py-2 text-sm focus:outline-none w-40" />

                                    <button type="submit" class="text-gray-600 hover:text-[#69161D] p-1">
                                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                    </button>

                                    <button type="button"
                                        onclick="resetFilter('ticketTable','ticketSearchInput','ticketSearchBox')"
                                        class="text-gray-400 hover:text-red-500 p-1">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">
                    <table id="ticketTable" class="w-full text-sm">
                        <thead class="text-xs text-gray-500 uppercase border-b">
                            <tr>
                                <th class="pb-3 text-left">Pengguna</th>
                                <th class="pb-3 text-left">Tanggal</th>
                                <th class="pb-3 text-left">Harga</th>
                                <th class="pb-3 text-center">Bukti</th>
                                <th class="pb-3 text-center">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            @foreach ($ticketTransactions as $trx)
                                <tr class="hover:bg-gray-50">

                                    <td class="py-4 font-semibold">
                                        {{ $trx->user->name }}
                                        <div class="text-xs text-gray-400">{{ $trx->quantity }} Tiket</div>
                                    </td>

                                    <td class="py-4 text-gray-500">
                                        {{ \Carbon\Carbon::parse($trx->visit_date)->format('d M Y') }}
                                    </td>

                                    <td class="py-4 text-[#69161D] font-medium">
                                        Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                    </td>

                                    <!-- BUKTI -->
                                    <td class="py-4 text-center">
                                        @if($trx->payment_proof)
                                            @php $imageUrl = asset($trx->payment_proof); @endphp
                                            <button onclick="openProof('{{ $imageUrl }}')"
                                                class="bg-[#69161D] text-white px-3 py-1 rounded-lg text-xs font-semibold">
                                                Lihat
                                            </button>
                                        @else
                                            <span class="text-xs text-gray-400">-</span>
                                        @endif
                                    </td>

                                    <!-- STATUS -->
                                    <td class="py-4 text-center">

                                        @if($trx->status == 'pending')
                                            <form action="{{ route('admin.approve', $trx->id) }}" method="POST">
                                                @csrf
                                                <button
                                                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg text-xs font-semibold">
                                                    Konfirmasi
                                                </button>
                                            </form>

                                        @elseif($trx->status == 'active')
                                            <form action="{{ route('admin.redeem', $trx->id) }}" method="POST">
                                                @csrf
                                                <button
                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs font-semibold">
                                                    Scan
                                                </button>
                                            </form>

                                        @else
                                            <button
                                                class="bg-gray-300 text-gray-500 px-3 py-1 rounded-lg text-xs font-semibold">
                                                Selesai
                                            </button>
                                        @endif

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>




            <!-- Transaksi Virtual Tour -->

            <div class="bg-white border border-[#F0EAD6] rounded-xl p-6 shadow-sm">

                <!-- HEADER + SEARCH -->
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-2">
                        <i data-lucide="video" class="w-5 h-5 text-[#69161D]"></i>
                        <h2 class="text-xl font-bold">Transaksi Tur Virtual</h2>
                    </div>

                    <div class="flex items-center gap-2">
                        <!-- ICON SEARCH -->
                        <button onclick="toggleSearch('virtualSearchBox')"
                            class="p-2 rounded-lg hover:bg-gray-100 transition">
                            <i data-lucide="search" class="w-5 h-5 text-gray-600"></i>
                        </button>

                        <!-- SEARCH BOX -->
                        <div id="virtualSearchBox" class="hidden opacity-0 transition-all duration-200">
                            <form onsubmit="filterTable(event,'virtualTable','virtualSearchInput')">
                                <div class="flex items-center bg-white border border-gray-300 rounded-lg px-3">
                                    <input id="virtualSearchInput" type="text" placeholder="Cari pengguna..."
                                        class="py-2 text-sm focus:outline-none w-40" />

                                    <button type="submit" class="text-gray-600 hover:text-[#69161D] p-1">
                                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                    </button>

                                    <button type="button"
                                        onclick="resetFilter('virtualTable','virtualSearchInput','virtualSearchBox')"
                                        class="text-gray-400 hover:text-red-500 p-1">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">
                    <table id="virtualTable" class="w-full text-sm">
                        <thead class="text-xs text-gray-500 uppercase border-b">
                            <tr>
                                <th class="pb-3 text-left">Pengguna</th>
                                <th class="pb-3 text-left">Tanggal</th>
                                <th class="pb-3 text-left">Harga</th>
                                <th class="pb-3 text-center">Bukti</th>
                                <th class="pb-3 text-center">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            @foreach ($virtualTourTransactions as $trx)
                                <tr class="hover:bg-gray-50">

                                    <td class="py-4 font-semibold">{{ $trx->user->name }}</td>

                                    <td class="py-4 text-gray-500">
                                        {{ \Carbon\Carbon::parse($trx->created_at)->format('d M Y') }}
                                    </td>

                                    <td class="py-4 text-[#69161D] font-medium">
                                        Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                    </td>

                                    <!-- BUKTI -->
                                    <td class="py-4 text-center">
                                        @if($trx->payment_proof)
                                            @php $imageUrl = asset($trx->payment_proof); @endphp
                                            <button onclick="openProof('{{ $imageUrl }}')"
                                                class="bg-[#69161D] text-white px-3 py-1 rounded-lg text-xs font-semibold">
                                                Lihat
                                            </button>
                                        @else
                                            <span class="text-xs text-gray-400">-</span>
                                        @endif
                                    </td>

                                    <!-- STATUS -->
                                    <td class="py-4 text-center">

                                        @if($trx->status == 'pending')
                                            <form action="{{ route('admin.approve', $trx->id) }}" method="POST">
                                                @csrf
                                                <button
                                                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg text-xs font-semibold">
                                                    Konfirmasi
                                                </button>
                                            </form>
                                        @else
                                            <button
                                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs font-semibold">
                                                Aktif
                                            </button>
                                        @endif

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>



    <!-- Bukti Pembayaran -->

    <div id="proofModal"
        class="fixed inset-0 hidden flex justify-center items-center bg-black/60 backdrop-blur-sm z-[9999] opacity-0 transition-opacity duration-300">

        <!-- CLOSE BUTTON -->
        <button onclick="closeProof()"
            class="absolute top-6 right-6 text-white hover:text-gray-300 text-3xl font-light z-[10000]">
            &times;
        </button>

        <!-- CONTENT -->
        <div id="modalContent"
            class="bg-white rounded-2xl shadow-2xl p-4 max-w-3xl w-[90%] transform scale-90 opacity-0 transition-all duration-300">

            <img id="proofImage" src="" class="w-full max-h-[80vh] object-contain rounded-xl shadow-sm" />
        </div>
    </div>




    <!-- Search + Filter -->

    <script>
        lucide.createIcons();

        /* ---- Toggle Search Box ---- */
        function toggleSearch(boxId) {
            const box = document.getElementById(boxId);

            if (box.classList.contains("hidden")) {
                box.classList.remove("hidden");
                setTimeout(() => box.classList.add("opacity-100"), 10);
                box.querySelector("input").focus();
            } else {
                box.classList.remove("opacity-100");
                setTimeout(() => box.classList.add("hidden"), 200);
            }
        }

        /* ---- Filter Table ---- */
        function filterTable(e, tableId, inputId) {
            e.preventDefault();

            const value = document.getElementById(inputId).value.toLowerCase();
            const rows = document.querySelectorAll(`#${tableId} tbody tr`);

            rows.forEach(row => {
                const nameCell = row.querySelector("td:first-child");
                const name = nameCell ? nameCell.innerText.toLowerCase() : "";

                row.style.display = name.includes(value) ? "" : "none";
            });
        }

        /* ---- Reset Filter ---- */
        function resetFilter(tableId, inputId, boxId) {
            document.getElementById(inputId).value = "";

            const rows = document.querySelectorAll(`#${tableId} tbody tr`);
            rows.forEach(row => row.style.display = "");

            toggleSearch(boxId);
        }

        /* ---- MODAL ---- */
        function openProof(url) {
            const modal = document.getElementById("proofModal");
            const content = document.getElementById("modalContent");
            const img = document.getElementById("proofImage");

            img.src = url;
            modal.classList.remove("hidden");

            setTimeout(() => {
                modal.classList.add("opacity-100");
                content.classList.remove("scale-90", "opacity-0");
                content.classList.add("scale-100", "opacity-100");
            }, 10);
        }

        function closeProof() {
            const modal = document.getElementById("proofModal");
            const content = document.getElementById("modalContent");

            modal.classList.remove("opacity-100");
            content.classList.remove("scale-100", "opacity-100");
            content.classList.add("scale-90", "opacity-0");

            setTimeout(() => modal.classList.add("hidden"), 200);
        }

        /* ---- Close modal when clicking outside ---- */
        document.getElementById("proofModal").addEventListener("click", function (e) {
            if (e.target === this) closeProof();
        });
    </script>

</body>

</html>