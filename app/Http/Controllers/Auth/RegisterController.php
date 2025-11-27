<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password_hash' => Hash::make($request->password),
            // 💡 PERBAIKAN: Set role default menjadi 'user' untuk pendaftaran mandiri
            'role' => 'user', 
        ]);

        // Optional: otomatis login setelah register
        Auth::login($admin);

        return redirect('/dashboard')->with('success', 'Akun berhasil dibuat dan Anda terdaftar sebagai User!');
    }
}
