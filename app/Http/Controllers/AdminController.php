<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index() //Menampilkan Data
    {
        // Total Pengguna
        $totalUsers = User::where('email', '!=', 'admin@gmail.com')->count();
        
        // Tiket Terjual
        $totalTickets = Transaction::where('category', 'Umum')
                                   ->where('status', '!=', 'unpaid')
                                   ->sum('quantity');
        
        // Tur Virtual
        $totalVirtualTour = Transaction::where('category', 'Virtual Tour')
                                       ->where('status', '!=', 'unpaid')
                                       ->sum('quantity');
        
        // Total Pendapatan
        $totalRevenue = Transaction::whereIn('status', ['active', 'used'])->sum('total_price');

        
        // Transaksi Tiket Masuk
        $ticketTransactions = Transaction::with('user')
            ->where('status', '!=', 'unpaid')
            ->where('category', 'Umum')
            ->latest()
            ->get();

        // Transaksi Virtual Tour
        $virtualTourTransactions = Transaction::with('user')
            ->where('status', '!=', 'unpaid')
            ->where('category', 'Virtual Tour')
            ->latest()
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalTickets', 
            'totalVirtualTour', 
            'totalRevenue', 
            'ticketTransactions', 
            'virtualTourTransactions'
        ));
    }

    // Fungsi Konfirmasi Aktif
    public function approveTicket($id) //Mengedit Data
    {
        $transaction = Transaction::findOrFail($id);
        
        $transaction->update([
            'status' => 'active'
        ]);

        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui (Aktif)!');
    }

    // Fungsi Pakai Tiket Used
    public function redeemTicket($id)
    {
        $transaction = Transaction::findOrFail($id);
        
        $transaction->update([
            'status' => 'used'
        ]);

        return redirect()->back()->with('success', 'Tiket berhasil digunakan (Check-in Sukses)!');
    }
}