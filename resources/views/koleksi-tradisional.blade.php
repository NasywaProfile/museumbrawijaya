@extends('layouts.guest')

@section('title', 'Koleksi Tradisional')

@section('content')

    <header class="relative">
        <img src="{{ asset('images/lptradisional.webp') }}"
            onerror="this.onerror=null;this.src='https://placehold.co/1200x500/333333/999999?text=Museum+Hero'"
            alt="Pameran koleksi tradisional" class="w-full h-64 object-cover">

        <div class="absolute inset-0 bg-black/60"></div>

        <div class="absolute inset-0 py-8 md:py-12 flex flex-col justify-between text-white">

            <div class="max-w-5xl mx-auto w-full px-8 flex flex-col justify-between h-full">

                {{-- PERBAIKAN TOMBOL KEMBALI --}}
                <a href="{{ Auth::check() ? route('beranda') : route('landing') }}"
                    class="flex items-center space-x-2 text-white/90 hover:text-white transition-colors w-fit">
                    <i data-lucide="arrow-left" class="w-6 h-6"></i>
                    <span id="page-back">Kembali</span>
                </a>

                <div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-2" id="koleksi-tradisional-title">Koleksi Tradisional</h1>
                    <p class="text-lg text-gray-200" id="koleksi-tradisional-subtitle">Jelajahi warisan budaya Indonesia
                        melalui koleksi tradisional kami</p>
                </div>

            </div>
        </div>
    </header>

    {{-- BAGIAN 1: TENTANG KOLEKSI --}}
    <section class="pt-12 md:pt-20 pb-4 md:pb-8 bg-white">
        <div class="max-w-5xl mx-auto px-8">
            <h2 class="text-3xl font-bold text-museum-dark mb-4" id="koleksi-tradisional-about-title">Tentang Koleksi</h2>
            <p class="text-base text-gray-600 leading-relaxed" id="koleksi-tradisional-about-text">
                Koleksi Tradisional di Museum Brawijaya memamerkan berbagai artefak budaya yang memiliki peran penting dalam
                sejarah pertahanan dan perjuangan rakyat Jawa Timur. Mulai dari keris pusaka, tombak, hingga pakaian adat
                dan topeng yang digunakan sebagai simbol perlawanan. Koleksi ini menyoroti perpaduan antara budaya lokal
                dengan semangat kepahlawanan.
            </p>
        </div>
    </section>

    {{-- BAGIAN 2: GALERI --}}
    <section class="pt-0 pb-12 md:pb-16 bg-white">
        <div class="max-w-5xl mx-auto px-8">
            <h2 class="text-3xl font-bold text-museum-dark mb-6" id="koleksi-tradisional-gallery-title">Galeri</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <img src="{{ asset('images/lptradisional1.png') }}" alt="Foto galeri 1"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
                <img src="{{ asset('images/lptradisional2.png') }}" alt="Foto galeri 2"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
                <img src="{{ asset('images/lptradisional3.png') }}" alt="Foto galeri 3"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
                <img src="{{ asset('images/lptradisional4.jpg') }}" alt="Foto galeri 4"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
                <img src="{{ asset('images/lptradisional5.webp') }}" alt="Foto galeri 5"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
                <img src="{{ asset('images/lptradisional6.jpg') }}" alt="Foto galeri 6"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
                <img src="{{ asset('images/lptradisional7.jfif') }}" alt="Foto galeri 7"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
                <img src="{{ asset('images/lptradisional8.png') }}" alt="Foto galeri 8"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
                <img src="{{ asset('images/lptradisional9.png') }}" alt="Foto galeri 9"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-museum-dark text-white p-12 text-center">
        <h2 class="text-2xl font-bold mb-3" id="koleksi-tradisional-cta-title">Kunjungi Koleksi Ini</h2>
        <p class="text-gray-300 text-xs max-w-lg mx-auto mb-6" id="koleksi-tradisional-cta-subtitle">
            Pesan tiket Anda sekarang dan lihat koleksi secara langsung.
        </p>
        <a href="{{ route('pesan-tiket') }}"
            class="inline-block bg-button-yellow text-[#69161D] font-bold py-3 px-8 rounded-lg shadow-lg hover:opacity-90 transition-colors"
            id="koleksi-tradisional-cta-button">
            Pesan Tiket
        </a>
    </section>

@endsection