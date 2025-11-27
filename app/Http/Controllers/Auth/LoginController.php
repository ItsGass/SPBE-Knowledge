<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class LoginController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cari user admin berdasarkan email
        $admin = Admin::where('email', $request->email)->first();

        // Jika email tidak ditemukan atau password salah
        // Menggunakan guard 'web' atau guard default Anda, memastikan Auth::login bekerja
        if (!$admin || !Hash::check($request->password, $admin->password_hash)) {
            return back()->with('error', 'Email atau password salah!');
        }

        // Login usernya
        // Catatan: Jika Anda menggunakan custom guard (misalnya 'admin'), gunakan Auth::guard('admin')->login($admin);
        // Jika tidak, Auth::login($admin) sudah cukup.
        Auth::login($admin);

        // Redirect ke dashboard (menggunakan helper route() adalah praktik terbaik)
        return redirect()->route('dashboard'); // Menggunakan route('dashboard')
    }

    // Logout (Diperbarui untuk keamanan sesi)
    public function logout(Request $request)
    {
        // Logout user dari guard default
        Auth::logout();

        // Hancurkan sesi user dan regenerasi token CSRF (Standar keamanan Laravel)
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect kembali ke halaman login (menggunakan helper route())
        return redirect()->route('dashboard'); // Menggunakan route('login')
    }
}