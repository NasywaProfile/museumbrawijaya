<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class VirtualTourController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cek apakah punya akses (Active / Pending)
        $transaction = Transaction::where('user_id', $user->id)
                        ->where('category', 'Virtual Tour')
                        ->whereIn('status', ['active', 'pending'])
                        ->latest()
                        ->first();

        // Cek akses aktif untuk player
        $hasActiveAccess = $transaction && $transaction->status == 'active';

        if ($hasActiveAccess) {
            return view('virtual-tour-player'); 
        }

        return view('virtual-tour', compact('transaction'));
    }


    public function purchase() //Membuat Pesanan Baru
    {
        $user = Auth::user();

        // Cek database User untuk AKses
        $existingTransaction = Transaction::where('user_id', $user->id)
                                ->where('category', 'Virtual Tour')
                                ->whereIn('status', ['active', 'pending', 'unpaid'])
                                ->latest()
                                ->first();

        if ($existingTransaction) {
            if ($existingTransaction->status == 'active') {
                return redirect()->route('virtual-tour'); 
            } elseif ($existingTransaction->status == 'pending') {
                 return redirect()->route('virtual-tour');
            } else {
                // Kalo Unpaid, lempar ke pembayaran
                session(['current_transaction_id' => $existingTransaction->id]);
                return redirect()->route('pembayaran');
            }
        }

        // Buat Baru
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'category' => 'Virtual Tour',
            'visit_date' => now(),
            'quantity' => 1,
            'total_price' => 25000,
            'status' => 'unpaid'
        ]);

        session(['current_transaction_id' => $transaction->id]);
        return redirect()->route('pembayaran');
    }
}