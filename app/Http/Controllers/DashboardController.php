<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Knowledge; // Digunakan untuk statistik/aktivitas
use App\Models\Admin;     // Digunakan untuk total admin dan daftar admin
use App\Models\Status;     // Digunakan untuk relasi status

class DashboardController extends Controller
{
    /**
     * Menampilkan Dashboard utama dengan semua data statistik dan daftar admin.
     * * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 1. Ambil data statistik dari method privat
        $stats = $this->getDashboardStats();

        // 2. Variabel Kondisional (Daftar Admin) - FIX UNDEFINED VARIABLE
        $admins = collect([]); // <-- Default Collection kosong
        $currentUser = null;   // <-- Default null
        
        if (Auth::check()) {
            // Ambil daftar admin, kecuali admin yang sedang login
            // Gunakan Model Admin yang sesuai dengan role 'superadmin' dan 'admin'
            $admins = Admin::where('id', '!=', Auth::id())
                            ->orderBy('name', 'asc')
                            ->get();
            $currentUser = Auth::user();
        }

        // 3. Kirim SEMUA variabel ke view 'dashboard'
        return view('dashboard', array_merge($stats, [
            // Variabel Kondisional
            'admins' => $admins, // <-- Pastikan ini dikirim
            'currentUser' => $currentUser, // <-- Pastikan ini dikirim
            
            // Variabel Knowledge (Placeholder untuk View Knowledge)
            'knowledgeItems' => Knowledge::with(['creator', 'status', 'scope'])->get(),
            //'scopes' => Scope::all(),
            'statuses' => Status::all(),

        ]));
    }

    /**
     * Mengumpulkan semua data statistik yang dibutuhkan oleh Dashboard.
     * * @return array
     */
    private function getDashboardStats(): array
    {
        // Mengambil data aktivitas terbaru (Eager load creator dan status)
        $latestActivities = Knowledge::with(['creator', 'status'])
            ->latest('updated_at')
            ->limit(5)
            ->get();
            
        return [
            // Statistik Konten
            'totalKnowledge' => Knowledge::count(),
            
            // Statistik Status (Asumsi Model Knowledge memiliki relasi 'status')
            'draftKnowledge' => Knowledge::whereHas('status', function($query) {
                $query->where('name', 'Draft'); 
            })->count(),
            
            'publishedKnowledge' => Knowledge::whereHas('status', function($query) {
                $query->where('name', 'Published'); 
            })->count(),
            
            // Statistik Pengguna Admin (Menggunakan Model Admin)
            'totalAdmin' => Admin::count(), 

            // Aktivitas Terbaru
            'latestActivities' => $latestActivities,
        ];
    }
}