<?php

namespace App\Http\Controllers;

use App\Models\Admin; // Model Admin
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // PENTING: Import Facade Auth
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Knowledge; // Diperlukan untuk Canvas di bawah

class AdminManagementController extends Controller
{
    /**
     * PENTING: Kita hapus __construct() yang bermasalah.
     * Proteksi 'auth' sudah di handle di routes/web.php.
     */
    
    /**
     * Menampilkan daftar semua Admin dan mengirimkannya ke View.
     */
    public function index()
    {
        // Pengecekan role di awal fungsi
        if (Auth::user()->role !== 'superadmin') {
             return redirect()->route('dashboard')->with('error', 'Akses Ditolak! Anda bukan Super Admin.');
        }

        // Ambil semua admin kecuali diri sendiri
        $admins = Admin::where('id', '!=', Auth::id())
                        ->orderBy('name', 'asc')
                        ->get();
                        
        // Ambil data admin yang sedang login
        $currentUser = Auth::user();

        // Mengirim data ke view admin.index (yang harus Anda buat)
        return view('admin.index', compact('admins', 'currentUser'));
    }

    /**
     * Menampilkan form untuk membuat Admin baru (Create).
     */
    public function create()
    {
        // Pengecekan role di awal fungsi
        if (Auth::user()->role !== 'superadmin') {
             return redirect()->route('dashboard')->with('error', 'Akses Ditolak! Anda bukan Super Admin.');
        }
        return view('admin.create');
    }

    /**
     * Menyimpan Admin baru ke database (Store).
     */
    public function store(Request $request)
    {
        // Pengecekan role di awal fungsi
        if (Auth::user()->role !== 'superadmin') {
             return back()->with('error', 'Akses Ditolak! Anda bukan Super Admin.');
        }
        
        $request->validate([
            'name' => 'required|string|max:100',
            // Pastikan email unik di tabel 'admins'
            'email' => 'required|string|email|max:120|unique:admins', 
            'password' => 'required|string|min:8|confirmed',
            // Membatasi role yang dapat dibuat: DIUBAH (Hapus 'editor')
            'role' => ['required', Rule::in(['admin', 'user'])], 
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password_hash' => Hash::make($request->password), // Menggunakan kolom password_hash
            'role' => $request->role,
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin baru berhasil ditambahkan!');
    }

    /**
     * Menghapus Admin dari database (Destroy).
     */
    public function destroy(Admin $admin)
    {
        // Pengecekan role di awal fungsi
        if (Auth::user()->role !== 'superadmin') {
             return back()->with('error', 'Akses Ditolak! Anda bukan Super Admin.');
        }

        // Pencegahan: Super Admin tidak boleh menghapus dirinya sendiri
        if (Auth::id() == $admin->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Hapus Admin
        $admin->delete();

        return back()->with('success', 'Admin berhasil dihapus.');
    }
}