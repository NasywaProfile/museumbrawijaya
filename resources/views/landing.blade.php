@extends('layouts.app')

@section('title', 'Beranda - Museum Brawijaya')

@section('content')

    <div class="flex-grow overflow-y-auto">
        <header class="hero-bg min-h-[550px] flex items-start pt-20 md:pt-24 lg:pt-28 px-5 lg:px-20 pb-10">
            <div class="hero-content max-w-3xl text-white">
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold mb-6 leading-tight drop-shadow-lg">
                    <span id="hero-title">Jelajahi Sejarah Indonesia di</span> <span class="text-white">Museum
                        Brawijaya</span>
                </h1>
                <p class="text-lg md:text-xl mb-10 max-w-2xl font-medium drop-shadow-md" id="hero-description-text">
                    Temukan koleksi bersejarah dan artefak yang menggambarkan perjalanan panjang bangsa Indonesia.
                    Nikmati pengalaman museum yang interaktif dan edukatif.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6">

                    {{-- TOMBOL 1: PESAN TIKET --}}
                    <a href="{{ Auth::check() ? route('pesan-tiket') : route('login') }}"
                        class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-museum-dark to-museum-light border border-white/40 text-white font-bold rounded-xl shadow-xl hover:opacity-90 transition duration-300 ease-in-out text-base md:text-lg transform hover:scale-[1.02]">
                        <i data-lucide="ticket" class="w-5 h-5 mr-3"></i>
                        <span id="hero-button-1">Pesan Tiket Sekarang</span>
                        <i data-lucide="arrow-right" class="w-5 h-5 ml-3"></i>
                    </a>

                    {{-- TOMBOL 2: VIRTUAL TOUR --}}
                    <a href="{{ Auth::check() ? route('virtual-tour') : route('login') }}"
                        class="inline-flex items-center justify-center px-8 py-3 bg-white text-primary-brown font-bold rounded-xl shadow-xl hover:bg-gray-100 transition duration-300 ease-in-out text-base md:text-lg transform hover:scale-[1.02] ring-2 ring-primary-brown focus:outline-none focus:ring-2 focus:ring-primary-brown">
                        <i data-lucide="camera" class="w-5 h-5 mr-3"></i>
                        <span id="hero-button-2">Mulai Virtual Tour</span>
                        <i data-lucide="arrow-right" class="w-5 h-5 ml-3"></i>
                    </a>
                </div>
            </div>
        </header>

        <section class="py-12 md:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
                <div class="w-full bg-bg-light rounded-xl p-8 md:p-12 lg:p-12">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                        <div class="lg:col-span-2">
                            <h1 class="text-xl md:text-3xl font-extrabold text-brand-red mb-6" id="about-title">
                                Tentang Museum Brawijaya
                            </h1>
                            <p class="text-primary-dark leading-relaxed mb-8 text-sm md:text-base max-w-2xl"
                                id="about-description">
                                Museum Brawijaya adalah museum militer yang didedikasikan untuk melestarikan
                                sejarah perjuangan kemerdekaan Indonesia. Terletak di jantung kota Malang,
                                museum ini menampilkan koleksi komprehensif artefak, dokumen, dan
                                memorabilia dari era kolonial hingga kemerdekaan.
                            </p>
                            <div class="space-y-4 text-gray-700">
                                <div class="flex items-start text-sm md:text-base">
                                    <i data-lucide="map-pin" class="w-5 h-5 text-primary-brown mr-3 mt-1"></i>
                                    <p>
                                        <span class="font-semibold" id="about-location-label">Lokasi:</span>
                                        <span class="font-normal" id="about-location-description">Jl. Ijen No. 25A, Malang,
                                            Jawa Timur</span>
                                    </p>
                                </div>
                                <div class="flex items-start text-sm md:text-base">
                                    <i data-lucide="clock" class="w-5 h-5 text-primary-brown mr-3 mt-1"></i>
                                    <p>
                                        <span class="font-semibold" id="about-hours-label">Jam Buka:</span>
                                        <span id="about-hours-text">Senin - Minggu, 08:00 - 15:00</span>
                                    </p>
                                </div>
                                <div class="flex items-start text-sm md:text-base">
                                    <i data-lucide="users" class="w-5 h-5 text-primary-brown mr-3 mt-1"></i>
                                    <p>
                                        <span class="font-semibold" id="about-guide-label">Panduan tersedia dalam</span>
                                        <span id="about-guide-text">Bahasa Indonesia & Inggris</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="lg:col-span-1 space-y-4 pt-4 md:pt-0">
                            <div
                                class="flex flex-col items-center justify-center p-6 md:p-8 bg-white border border-stone-200 rounded-lg shadow-sm transition duration-300 hover:shadow-md">
                                <div class="text-primary-brown mb-3 p-3 bg-detail-bg rounded-full">
                                    <i data-lucide="calendar" class="w-6 h-6"></i>
                                </div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-1" id="about-card1-title">Buka Setiap Hari
                                </h3>
                                <p class="text-sm text-gray-500" id="about-card1-text">Tidak ada hari libur</p>
                            </div>
                            <div
                                class="flex flex-col items-center justify-center p-6 md:p-8 bg-white border border-stone-200 rounded-lg shadow-sm transition duration-300 hover:shadow-md">
                                <div class="text-primary-brown mb-3 p-3 bg-detail-bg rounded-full">
                                    <i data-lucide="camera" class="w-6 h-6"></i>
                                </div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-1" id="about-card2-title">Virtual Tour
                                </h3>
                                <p class="text-sm text-gray-500" id="about-card2-text">Teknologi 360°</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pb-12 md:pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 space-y-6 md:space-y-10">
                <header class="text-center mb-12 md:mb-16">
                    <h1 class="text-xl md:text-3xl font-extrabold text-brand-red mb-6" id="collection-title">
                        Koleksi Unggulan
                    </h1>
                    <p class="text-primary-dark leading-relaxed mb-8 text-sm md:text-base max-w-2xl mx-auto"
                        id="collection-description">
                        Jelajahi koleksi bersejarah berbagai periode penting dalam sejarah Indonesia
                    </p>
                </header>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    <a href="{{ route('koleksi.tradisional') }}"
                        class="bg-white block bg-card-bg rounded-xl shadow-lg hover:shadow-xl transition duration-300 overflow-hidden h-[347px]">
                        <div class="w-full h-48 overflow-hidden">
                            <img src="{{ asset('images/lptradisional.webp') }}"
                                onerror="this.onerror=null;this.src='https://placehold.co/600x400/DBC8BC/2D1C0F?text=Tradisional'"
                                alt="Gambar artefak budaya dan tradisi Indonesia"
                                class="w-full h-full object-cover rounded-t-xl transition duration-500 hover:scale-105">
                        </div>
                        <div class="p-6">
                            <span
                                class="inline-block bg-tag-bg text-tag-text text-xs font-semibold px-3 py-1 rounded-full mb-3"
                                id="collection-card1-tag">
                                Tradisional
                            </span>
                            <h2 class="text-xl font-bold text-primary-dark mb-2" id="collection-card1-title">
                                Koleksi Tradisional
                            </h2>
                            <p class="text-primary-dark text-xs" id="collection-card1-desc">
                                Artefak Tradisional Indonesia
                            </p>
                        </div>
                    </a>

                    <a href="{{ route('koleksi.sejarah') }}"
                        class="bg-white block bg-card-bg rounded-xl shadow-lg hover:shadow-xl transition duration-300 overflow-hidden h-[347px]">
                        <div class="w-full h-48 overflow-hidden">
                            <img src="{{ asset('images/lpsejarah.png') }}"
                                onerror="this.onerror=null;this.src='https://placehold.co/600x400/808A7C/000000?text=Sejarah'"
                                alt="Gambar dokumentasi perjuangan kemerdekaan"
                                class="w-full h-full object-cover rounded-t-xl transition duration-500 hover:scale-105">
                        </div>
                        <div class="p-6">
                            <span
                                class="inline-block bg-tag-bg text-tag-text text-xs font-semibold px-3 py-1 rounded-full mb-3"
                                id="collection-card2-tag">
                                Sejarah
                            </span>
                            <h2 class="text-xl font-bold text-primary-dark mb-2" id="collection-card2-title">
                                Koleksi Sejarah
                            </h2>
                            <p class="text-primary-dark text-xs" id="collection-card2-desc">
                                Dokumentasi perjuangan Indonesia
                            </p>
                        </div>
                    </a>

                    <a href="{{ route('koleksi.militer') }}"
                        class="bg-white block bg-card-bg rounded-xl shadow-lg hover:shadow-xl transition duration-300 overflow-hidden h-[347px]">
                        <div class="w-full h-48 overflow-hidden">
                            <img src="{{ asset('images/lpmiliter.png') }}"
                                onerror="this.onerror=null;this.src='https://placehold.co/600x400/6B3E3E/FFFFFF?text=Militer'"
                                alt="Gambar seragam dan peralatan militer"
                                class="w-full h-full object-cover rounded-t-xl transition duration-500 hover:scale-105">
                        </div>
                        <div class="p-6">
                            <span
                                class="inline-block bg-tag-bg text-tag-text text-xs font-semibold px-3 py-1 rounded-full mb-3"
                                id="collection-card3-tag">
                                Militer
                            </span>
                            <h2 class="text-xl font-bold text-primary-dark mb-2" id="collection-card3-title">
                                Koleksi Militer
                            </h2>
                            <p class="text-primary-dark text-xs" id="collection-card3-desc">
                                Seragam dan peralatan militer bersejarah
                            </p>
                        </div>
                    </a>

                </div>
            </div>
        </section>

@endsection