<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    // protected $table = 'admin'; // Hapus baris ini jika nama tabel Anda adalah 'admins'

    protected $fillable = [
        'name',
        'email',
        'password_hash',
        'role', // Pastikan kolom 'role' ada di database
    ];

    protected $hidden = [
        'password_hash'
    ];

    // Pakai password_hash sebagai password utama
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
    
    // ----------------------------------------------------
    // 💡 METODE PEMBANTU UNTUK CEK ROLE (RBAC LOGIC)
    // ----------------------------------------------------
    
    /**
     * Cek apakah user adalah SuperAdmin (Hak akses penuh)
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    /**
     * Cek apakah user adalah Admin (Termasuk SuperAdmin, karena SuperAdmin adalah pengguna tertinggi)
     * Admin diizinkan melihat daftar user/admin dan membuat user.
     * @return bool
     */
    public function isAdmin(): bool
    {
        // Poin 2 & 3: Admin dan SuperAdmin memiliki akses ke manajemen admin (walaupun dengan batasan hapus).
        return $this->role === 'admin' || $this->isSuperAdmin();
    }

    /**
     * Cek apakah user adalah User biasa (Role default setelah register)
     * Tidak memiliki akses ke manajemen admin.
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }
}