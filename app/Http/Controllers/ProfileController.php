<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil user.
     */
    public function index()
    {
        return view('profil'); 
    }

    
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Email harus unik di tabel users, kecuali email milik user ini sendiri
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'whatsapp' => 'nullable|string|max:15',
            'language' => 'nullable|string|max:10',
        ], [
            'email.unique' => 'Email ini sudah digunakan oleh akun lain.',
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->whatsapp = $request->whatsapp;
        $user->language = $request->language; 
        $user->save();

        return back()->with('profile_success', 'Data diri berhasil diubah!');
    }

    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_baru' => 'required|string|min:6|confirmed', 
        ], [
            'password_baru.confirmed' => 'Konfirmasi password tidak cocok.',
            'password_baru.required' => 'Password baru wajib diisi.'
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password_baru); //Enkripsi password
        $user->save();

        return back()->with('password_success', 'Password berhasil diubah!');
    }
}