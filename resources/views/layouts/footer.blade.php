{{-- Simpan sebagai: views/layouts/footer.blade.php --}}
<footer class="w-full mt-12 md:mt-20">
    <div class="bg-gradient-to-r from-museum-light to-museum-dark text-white p-8 text-center">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-xl md:text-3xl font-extrabold text-white mb-4" id="footer-cta-title">
                Siap Menjelajahi Sejarah?
            </h1>
            <p class="text-white leading-relaxed mb-6 text-sm md:text-base max-w-2xl" id="footer-cta-desc">
                Bergabunglah dengan pengunjung yang telah merasakan pengalaman di Museum Brawijaya
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                
                {{-- 
                  PERBAIKAN DI SINI:
                  1. Text berubah jadi 'Masuk Sekarang'
                  2. Link mengarah ke route('login')
                --}}
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-gray-900 font-semibold rounded-lg shadow-md hover:bg-gray-100 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                        <polyline points="10 17 15 12 10 7"></polyline>
                        <line x1="15" y1="12" x2="3" y2="12"></line>
                    </svg>
                    <span id="footer-cta-btn1">Masuk Sekarang</span>
                </a>
                
                {{-- 
                  PERBAIKAN DI SINI:
                  Link 'Pesan Sekarang' juga mengarah ke route('login')
                --}}
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-museum-dark to-museum-light border border-white/40 text-white font-semibold rounded-lg hover:opacity-90 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                        </path>
                        <path d="M13 5v2"></path>
                        <path d="M13 17v2"></path>
                        <path d="M13 11v2"></path>
                    </svg>
                    <span id="footer-cta-btn2">Pesan Sekarang</span>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-museum-dark text-neutral-300 pt-10 pb-8">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-8 mb-10">
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-white">Museum Brawijaya</h3>
                    <p class="text-neutral-300" id="footer-info-desc">
                        Melestarikan sejarah dan budaya Indonesia.
                    </p>
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mt-1">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span>Jl. Ijen No. 25A, Malang, Jawa Timur</span>
                    </div>
                </div>
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-white" id="footer-hours-title">Jam Operasional</h3>
                    <div class="space-y-2">
                        <p id="footer-hours-text">Senin - Minggu</p>
                        <p class="font-medium">08.00 - 15.00 WIB</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-white" id="footer-contact-title">Kontak</h3>
                    <div class="space-y-2">
                        <p>Telepon: (0341) 123456</p>
                        <p>Instagram: @museum_brawijaya</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/20 pt-6 text-center text-neutral-400 text-sm">
                <span id="footer-copyright">© 2025 Museum Brawijaya. Semua hak dilindungi.</span>
            </div>
        </div>
    </div>

</footer>