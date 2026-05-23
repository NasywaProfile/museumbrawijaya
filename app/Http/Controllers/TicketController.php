<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 

class TicketController extends Controller
{
    // Menampilkan Form Pesan
    public function index()
    {
        return view('pesan-tiket');
    }

    // Simpan Pesanan Baru
    public function storeOrder(Request $request)
    {
        $request->validate([
            'visit_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
        ]);

        $total = $request->quantity * 10000;

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'category' => 'Umum',
            'visit_date' => $request->visit_date,
            'quantity' => $request->quantity,
            'total_price' => $total,
            'status' => 'unpaid'
        ]);

        session(['current_transaction_id' => $transaction->id]);
        return redirect()->route('pembayaran');
    }

    // Halaman Pembayaran
    public function showPayment()
    {
        $trxId = session('current_transaction_id');
        
        // Mencari transaksi unpaid terakhir user ini
        if (!$trxId) {
            $lastUnpaid = Transaction::where('user_id', Auth::id())
                ->where('status', 'unpaid')
                ->latest()
                ->first();

            if ($lastUnpaid) {
                $trxId = $lastUnpaid->id;
                session(['current_transaction_id' => $trxId]);
            } else {
                return redirect()->route('tiket-saya');
            }
        }

        $transaction = Transaction::find($trxId);
        
        // Tentukan Back URL
        $backUrl = route('pesan-tiket');
        if ($transaction && $transaction->category == 'Virtual Tour') {
            $backUrl = route('virtual-tour');
        } elseif ($transaction) {
             $backUrl = route('tiket-saya');
        }

        return view('pembayaran', compact('backUrl'));
    }
    
    // PROSES UPLOAD BUKTI
    public function processPayment(Request $request)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Ambil dari ID
        $trxId = session('current_transaction_id');
        if (!$trxId) {
             $trxId = Transaction::where('user_id', Auth::id())
                ->where('status', 'unpaid')
                ->latest()
                ->first()->id ?? null;
        }

        $transaction = Transaction::find($trxId);

        if ($transaction) {
            // Renaming Upload File
            $file = $request->file('bukti_transfer');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            
            // Tentukan Path
            $path = public_path('uploads/payments');

            // Buat folder jika belum ada
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            // Pindahkan file
            $file->move($path, $filename);

            // Update Database
            $transaction->update([
                'payment_proof' => 'uploads/payments/' . $filename,
                'status' => 'pending'
            ]);

            // Hapus session
            $request->session()->forget('current_transaction_id');
            
            // Redirect sesuai kategori
            $redirectTarget = ($transaction->category == 'Virtual Tour') 
                              ? route('virtual-tour') 
                              : route('tiket-saya');

            return view('pembayaran', [
                'showSuccessModal' => true, 
                'redirectUrl' => $redirectTarget,
                'backUrl' => $redirectTarget
            ]);
        }

        return back()->with('error', 'Transaksi tidak ditemukan.');
    }

    // List Tiket Saya
    public function myTickets()
    {
        $tickets = Transaction::where('user_id', Auth::id())
                      ->where('category', '!=', 'Virtual Tour')
                      ->latest()
                      ->get();

        return view('tiket-saya', compact('tickets'));
    }
}