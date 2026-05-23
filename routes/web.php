<?php

use Illuminate\Support\Facades\Route;
// Import Semua Controller
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\VirtualTourController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;



Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/koleksi/tradisional', fn() => view('koleksi-tradisional'))->name('koleksi.tradisional');
Route::get('/koleksi/sejarah', fn() => view('koleksi-sejarah'))->name('koleksi.sejarah');
Route::get('/koleksi/militer', fn() => view('koleksi-militer'))->name('koleksi.militer');

// GUEST (Hanya untuk yang BELUM Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
    Route::get('/daftar', fn() => view('daftar'))->name('daftar');
    Route::post('/daftar', [AuthController::class, 'register'])->name('daftar.proses');
});



Route::middleware('auth')->group(function () {

    // DASHBOARD UTAMA
    Route::get('/beranda', fn() => view('beranda'))->name('beranda');

    // HALAMAN SAYA 
    Route::get('/halaman-saya', [DashboardController::class, 'showHalamanSaya'])->name('halaman-saya');

    // TIKET SAYA
    Route::get('/tiket-saya', [TicketController::class, 'myTickets'])->name('tiket-saya');

    // PESAN TIKET
    Route::get('/pesan-tiket', [TicketController::class, 'index'])->name('pesan-tiket');
    Route::post('/pesan-tiket', [TicketController::class, 'storeOrder'])->name('pesan-tiket.store');

    // PEMBAYARAN 
    Route::get('/pembayaran', [TicketController::class, 'showPayment'])->name('pembayaran');
    Route::post('/pembayaran', [TicketController::class, 'processPayment'])->name('pembayaran.proses');

    // RIWAYAT
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');

    // VIRTUAL TOUR
    Route::get('/virtual-tour', [VirtualTourController::class, 'index'])->name('virtual-tour');
    Route::post('/virtual-tour/beli', [VirtualTourController::class, 'purchase'])->name('virtual-tour.beli');

    // PROFIL & LOGOUT
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
    Route::post('/profil/update', [ProfileController::class, 'updateProfile'])->name('profil.update');
    Route::post('/profil/password', [ProfileController::class, 'updatePassword'])->name('profil.password');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // ADMIN
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/approve/{id}', [AdminController::class, 'approveTicket'])->name('admin.approve');
    Route::post('/admin/redeem/{id}', [AdminController::class, 'redeemTicket'])->name('admin.redeem');
    Route::delete('/admin/transaksi/{id}', [AdminController::class, 'destroy'])->name('admin.hapus-transaksi');
});