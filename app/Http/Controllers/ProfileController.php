<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Digunakan oleh method index() Anda yang baru
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profile pengguna dan melewatkan data user.
     * Mengganti implementasi sebelumnya dengan code yang Anda berikan.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Memperbarui data profil pengguna (Nama).
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // Menggunakan Auth::user() sebagai ganti auth()->user()

        // 1. Validasi Input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        // 2. Update Data
        $user->update([
            'name' => $request->name,
        ]);

        // 3. Redirect dengan pesan sukses
        return back()->with('success', 'Data profil berhasil diperbarui!');
    }

    /**
     * Memperbarui password pengguna.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user(); // Menggunakan Auth::user() sebagai ganti auth()->user()

        // 1. Validasi Input
        $request->validate([
            // current_password adalah rule bawaan Laravel yang mengecek password lama dengan Hash
            'current_password' => ['required', 'string', 'current_password'], 
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.current_password' => 'Password lama Anda tidak sesuai.',
            'new_password.min' => 'Password baru minimal harus 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        // 2. Update Password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        // 3. Redirect dengan pesan sukses
        return back()->with('success', 'Password berhasil diubah!');
    }
}