<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <-- Tambahkan ini

class CheckUserRole
{
    /**
     * Menangani permintaan masuk dan memeriksa role pengguna.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string ...$roles Role yang diizinkan (dipisahkan koma)
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pengecekan otentikasi
        if (!Auth::check()) { // Diganti dari auth()->check() menjadi Auth::check()
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman ini.');
        }

        $user = Auth::user(); // Ambil objek user secara eksplisit

        // Pengecekan role
        // Pastikan pengguna sudah login dan memiliki atribut 'role'
        // Pengecekan $user ditambahkan meskipun sudah dicek di atas, untuk Static Analysis
        if (!$user || !in_array($user->role, $roles)) { 
            return redirect('/dashboard')->with('error', 'Akses ditolak! Anda tidak memiliki izin untuk halaman ini.');
        }

        return $next($request);
    }
}