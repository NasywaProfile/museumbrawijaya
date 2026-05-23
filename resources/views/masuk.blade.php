@extends('layouts.guest')

@section('title', 'Masuk Akun')

@section('content')
    <div class="bg-[#FBFAF9] text-black min-h-screen">
        <nav class="absolute top-0 left-0 p-6 md:p-10 z-10">
            <a href="{{ route('landing') }}" class="flex items-center text-gray-700 hover:text-black transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                <span class="ml-2 font-medium" id="page-back">Kembali</span>
            </a>
        </nav>

        <main class="min-h-screen flex items-center justify-center px-4">
            <div class="w-full max-w-sm bg-[#F9F8F6] border border-[#F0C442]/20 rounded-xl shadow-lg p-5">

                <div class="text-center mb-3">
                    {{-- ID Translate --}}
                    <h1 class="text-3xl font-bold text-[#69161D]" id="auth-masuk-title">Masuk</h1>
                    <p class="text-sm text-gray-500 mt-1" id="auth-masuk-subtitle">Masuk ke akun Museum Brawijaya Anda</p>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-3 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-3 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.proses') }}" method="POST">
                    @csrf
                    <div class="space-y-3">
                        <div>
                            {{-- ID Translate --}}
                            <label for="email" class="text-sm font-medium text-[#69161D]"
                                id="auth-label-email">Email</label>
                            <div class="relative mt-1">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-1 text-gray-500"><i
                                        data-lucide="mail" class="w-5 h-5"></i></span>
                                <input type="email" id="email" name="email" required placeholder=""
                                    class="w-full pl-8 pr-3 py-2 bg-transparent border-b border-gray-300 focus:outline-none focus:border-b-2 focus:border-[#69161D] text-black">
                            </div>
                        </div>

                        <div>
                            {{-- ID Translate --}}
                            <label for="password" class="text-sm font-medium text-[#69161D]"
                                id="auth-label-password">Password</label>
                            <div class="relative mt-1">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-1 text-gray-500"><i
                                        data-lucide="lock" class="w-5 h-5"></i></span>
                                <input type="password" id="password" name="password" required placeholder=""
                                    class="w-full pl-8 pr-3 py-2 bg-transparent border-b border-gray-300 focus:outline-none focus:border-b-2 focus:border-[#69161D] text-black">
                            </div>
                        </div>

                        <div>
                            {{-- ID Translate --}}
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-[#93501F] to-[#69161D] text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:opacity-90 transition-opacity duration-300 mt-4"
                                id="auth-btn-masuk">
                                Masuk
                            </button>
                        </div>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p class="text-sm text-gray-500">
                        <span id="auth-text-no-account">Belum punya akun?</span>
                        <a href="{{ route('daftar') }}" class="font-medium text-[#69161D] hover:underline"
                            id="auth-link-daftar">Daftar di sini</a>
                    </p>
                </div>
            </div>
        </main>
    </div>
@endsection