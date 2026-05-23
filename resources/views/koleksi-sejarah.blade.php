@extends('layouts.guest')

@section('title', 'Koleksi Sejarah')

@section('content')

    <header class="relative">
        <img src="{{ asset('images/lpsejarah.png') }}"
            onerror="this.onerror=null;this.src='https://placehold.co/1200x500/333333/999999?text=Museum+Hero'"
            alt="Pameran koleksi sejarah" class="w-full h-64 object-cover">

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
                    <h1 class="text-4xl md:text-5xl font-bold mb-2" id="koleksi-sejarah-title">Koleksi Sejarah</h1>
                    <p class="text-lg text-gray-200" id="koleksi-sejarah-subtitle">Jelajahi warisan budaya Indonesia melalui
                        koleksi sejarah kami</p>
                </div>

            </div>
        </div>
    </header>

    {{-- BAGIAN 1: TENTANG KOLEKSI --}}
    <section class="py-12 md:py-20 bg-white">
        <div class="max-w-5xl mx-auto px-8">
            <h2 class="text-3xl font-bold text-museum-dark mb-4" id="koleksi-sejarah-about-title">Tentang Koleksi</h2>
            <p class="text-base text-gray-600 leading-relaxed" id="koleksi-sejarah-about-text">
                Koleksi Sejarah menyajikan kronologi perjuangan bangsa melalui dokumen asli, foto langka, dan surat-surat
                penting. Fokus utama adalah pada periode penjajahan Belanda, pendudukan Jepang, dan proklamasi kemerdekaan,
                memberikan pandangan mendalam tentang pengorbanan para pahlawan.
            </p>
        </div>
    </section>

    {{-- BAGIAN 2: GALERI --}}
    <section class="pt-0 pb-12 md:pb-16 bg-white">
        <div class="max-w-5xl mx-auto px-8">
            <h2 class="text-3xl font-bold text-museum-dark mb-6" id="koleksi-sejarah-gallery-title">Galeri</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <img src="{{ asset('images/lpsejarah1.png') }}" alt="Foto galeri 1"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
                <img src="{{ asset('images/lpsejarah.png') }}" alt="Foto galeri 2"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
                <img src="{{ asset('images/lpsejarah3.png') }}" alt="Foto galeri 3"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
                <img src="{{ asset('images/lpsejarah4.png') }}" alt="Foto galeri 4"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
                <img src="{{ asset('images/lpsejarah5.png') }}" alt="Foto galeri 5"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
                <img src="{{ asset('images/lpsejarah6.jpg') }}" alt="Foto galeri 6"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
                <img src="{{ asset('images/lpsejarah7.png') }}" alt="Foto galeri 7"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
                <img src="{{ asset('images/lpsejarah8.jpeg') }}" alt="Foto galeri 8"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
                <img src="{{ asset('images/lpsejarah9.png') }}" alt="Foto galeri 9"
                    class="w-full h-48 object-cover rounded-lg shadow-md transition-transform hover:scale-105">
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-museum-dark text-white p-12 text-center">
        <h2 class="text-2xl font-bold mb-3" id="koleksi-sejarah-cta-title">Kunjungi Koleksi Ini</h2>
        <p class="text-gray-300 text-xs max-w-lg mx-auto mb-6" id="koleksi-sejarah-cta-subtitle">
            Pesan tiket Anda sekarang dan lihat koleksi secara langsung.
        </p>
        <a href="{{ route('pesan-tiket') }}"
            class="inline-block bg-button-yellow text-[#69161D] font-bold py-3 px-8 rounded-lg shadow-lg hover:opacity-90 transition-colors"
            id="koleksi-sejarah-cta-button">
            Pesan Tiket
        </a>
    </section>

@endsection