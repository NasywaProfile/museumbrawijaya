<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function showHalamanSaya()
    {
        $user = Auth::user();

        // Ambil 2 Transaksi Terakhir
        $recentTransactions = Transaction::where('user_id', $user->id)
                                ->where('status', '!=', 'unpaid')
                                ->latest()
                                ->take(2)
                                ->get();
                                
        // Ambil SEMUA Tiket Aktif 
        $activeTickets = Transaction::where('user_id', $user->id)
                                ->where('category', 'Umum')
                                ->where('status', 'active')
                                ->orderBy('visit_date', 'asc')
                                ->get();
        
        // 3. Cek Akses Virtual Tour
        $hasVirtualTour = Transaction::where('user_id', $user->id)
                                ->where('category', 'Virtual Tour')
                                ->where('status', 'active')
                                ->exists();

        // Mengatur Bahasa Indonesia
        $locale = Session::get('locale', 'id'); 
        Carbon::setLocale($locale); 

        return view('halaman-saya', compact('recentTransactions', 'activeTickets', 'hasVirtualTour'));
    }
}