<nav class="bg-bg-light p-4 shadow-xl sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center max-w-7xl px-4 sm:px-6 lg:px-12">
        {{-- LOGO --}}
        <a href="{{ route('landing') }}" class="text-xl font-bold text-brand-red tracking-wider">
            Museum Brawijaya
        </a>

        <div class="flex items-center space-x-4">
            {{-- TOMBOL GANTI BAHASA --}}
            <div class="relative">
                <button id="language-toggle" class="text-black">
                    <i class="fa-solid fa-globe"></i>
                    <i id="language-arrow"
                        class="fa-solid fa-chevron-down text-xs ml-1 transition-transform duration-300"></i>
                </button>
                <div id="language-menu"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-2xl py-2 hidden origin-top-right transform transition duration-300 ease-out border border-gray-100">

                    {{-- OPSI BAHASA INDONESIA --}}
                    {{-- Tambahkan id="lang-option-id" --}}
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 font-medium"
                        data-lang="id" id="lang-option-id">
                        Bahasa Indonesia
                    </a>

                    {{-- OPSI BAHASA INGGRIS --}}
                    {{-- Tambahkan id="lang-option-en" --}}
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 font-medium"
                        data-lang="en" id="lang-option-en">
                        English Language
                    </a>
                </div>
            </div>

            {{-- LOGIKA AUTH --}}
            @auth
                {{-- JIKA SUDAH LOGIN: Tombol Dashboard --}}
                <a href="{{ route('beranda') }}"
                    class="bg-button-yellow hover:bg-[#d99f2e] text-[#69161D] text-xm font-bold h-10 px-6 flex items-center justify-center rounded-xl transition-colors shadow-sm">
                    {{-- Tambahkan span dengan id="nav-dashboard" --}}
                    <span id="nav-dashboard">Halaman Saya</span>
                </a>
            @else
                            {{-- JIKA BELUM LOGIN: Tombol Masuk --}}
                            {{-- Gunakan id="nav-login" agar sesuai dengan JS bagian Navbar --}}
                            <a href="{{ route('login') }}" id="nav-login" class="
                     bg-button-yellow 
                     hover:bg-[#d99f2e]
                     text-[#69161D]
                     text-sm font-bold
                     h-11 px-8
                     flex items-center justify-center
                     rounded-xl
                     shadow-[inset_0_2px_0_rgba(255,255,255,0.5),0_4px_8px_rgba(0,0,0,0.15)]
                     hover:shadow-[inset_0_1px_0_rgba(255,255,255,0.3),0_6px_12px_rgba(0,0,0,0.20)]
                     transition-all duration-200
                   ">
                                Masuk / Daftar
                            </a>

            @endauth

        </div>
    </div>
</nav>