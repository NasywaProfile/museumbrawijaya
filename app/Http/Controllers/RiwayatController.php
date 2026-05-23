<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mengambil semua transaksi dan semua status
        $transactions = Transaction::where('user_id', $user->id)
                                   ->latest()
                                   ->get();

        // Menghitung Total Transaksi
        $totalTransaksi = $transactions->count();

        // Menghitung Total Pengeluaran
        $totalPengeluaran = Transaction::where('user_id', $user->id)
                                       ->whereIn('status', ['active', 'used', 'pending']) 
                                       ->sum('total_price');

        return view('riwayat', compact('transactions', 'totalTransaksi', 'totalPengeluaran'));
    }
}