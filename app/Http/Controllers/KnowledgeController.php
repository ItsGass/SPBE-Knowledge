<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Knowledge; 
use App\Models\Scope;
use App\Models\Status;
use App\Models\Admin; 

class KnowledgeController extends Controller
{
    /**
     * Mengumpulkan semua data statistik yang dibutuhkan oleh Dashboard.
     * Dipanggil oleh index dan create untuk mencegah 'Undefined variable' di view.
     * @return array
     */
    private function getDashboardData()
    {
        // Data Statistik
        $totalKnowledge = Knowledge::count();
        $totalAdminCount = Admin::count(); 
        
        $draftKnowledge = Knowledge::whereHas('status', function($q) {
            $q->where('name', 'Draft'); 
        })->count();
        $publishedKnowledge = Knowledge::whereHas('status', function($q) {
            $q->where('name', 'Published'); 
        })->count();

        $latestActivities = Knowledge::with(['creator', 'status'])->latest('updated_at')->limit(5)->get();
        
        // Variabel Kondisional (Admin List)
        $admins = collect([]);
        $currentUser = null;
        if (Auth::check()) {
            $admins = Admin::where('id', '!=', Auth::id())->orderBy('name', 'asc')->get();
            $currentUser = Auth::user();
        }

        return [
            'totalKnowledge' => $totalKnowledge,
            'draftKnowledge' => $draftKnowledge,
            'publishedKnowledge' => $publishedKnowledge,
            'totalAdmin' => $totalAdminCount,
            'latestActivities' => $latestActivities,
            'admins' => $admins,
            'currentUser' => $currentUser,
            'scopes' => Scope::all(),
            'statuses' => Status::all(),
        ];
    }
    
    // ===============================================================
    // TAMPILAN PUBLIK (INDEX)
    // ===============================================================
    public function index()
    {
        // 1. Ambil data Knowledge & Relasi (dengan filter Publik/Admin)
        $query = Knowledge::with(['status', 'scope', 'creator']);

        // Batasi hanya yang 'Published' jika Guest/User biasa
        if (!Auth::check() || !in_array(Auth::user()?->role, ['superadmin', 'admin'])) {
            $query->whereHas('status', function($q) {
                $q->where('name', 'Published'); 
            });
        }
        
        $knowledgeItems = $query->latest('created_at')->get();
        
        // 2. Kumpulkan data dashboard dan kirim ke view utama
        $data = $this->getDashboardData();
        $data['knowledgeItems'] = $knowledgeItems;
        
        return view('dashboard', $data);
    }

    // ===============================================================
    // SHOW DETAIL KNOWLEDGE
    // ===============================================================
    public function show(Knowledge $knowledge)
    {
        // Pengecekan Otorisasi: Jika bukan admin/superadmin, hanya boleh melihat jika statusnya 'Published'
        if (!Auth::check() || !in_array(Auth::user()?->role, ['superadmin', 'admin'])) {
            if ($knowledge->status?->name !== 'Published') { // Gunakan null safe operator
                 abort(403, 'Akses ditolak. Dokumen belum dipublikasikan.');
            }
        }
        
        // Mengembalikan view terpisah (knowledge.show)
        return view('knowledge.show', [
            'knowledge' => $knowledge->load(['creator', 'status', 'scope']),
        ]);
    }

    // ===============================================================
    // FORM CREATE (ADMIN / SUPERADMIN)
    // ===============================================================
    public function create()
    {
        $data = $this->getDashboardData();
        return view('dashboard', $data);
    }

    // ===============================================================
    // STORE DATA BARU
    // ===============================================================
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'        => 'required|string|max:255',
            'author'       => 'nullable|string|max:150',
            'instansi'     => 'nullable|string|max:150',
            'description'  => 'nullable|string',
            'publish_date' => 'nullable|date',
            'format'       => 'nullable|in:dokumen,gambar,video,tautan,lain-lain', 
            'scope_id'     => 'nullable|integer|exists:scopes,id', 
            'status_id'    => 'nullable|integer|exists:statuses,id', 
            'url'          => 'nullable|url|max:255',
        ]);

        $validatedData['created_by'] = Auth::id(); // Pastikan ID creator terisi
        Knowledge::create($validatedData);

        // PERBAIKAN: Redirect ke index + Flash untuk memuat menu Knowledge
        return redirect()->route('knowledge.index')
                         ->with('redirectTo', 'Manajemen Knowledge')
                         ->with('success', 'Knowledge berhasil ditambahkan!');
    }

    // ===============================================================
    // EDIT KNOWLEDGE
    // ===============================================================
    public function edit(Knowledge $knowledge)
    {
        $data = $this->getDashboardData();
        $data['knowledge'] = $knowledge->load(['creator', 'status', 'scope']);

        // Mengembalikan view terpisah (knowledge.edit)
        return view('knowledge.edit', $data); 
    }

    // ===============================================================
    // UPDATE KNOWLEDGE
    // ===============================================================
    public function update(Request $request, Knowledge $knowledge)
    {
        $validatedData = $request->validate([
            'title'        => 'required|string|max:255',
            'author'       => 'nullable|string|max:150',
            'instansi'     => 'nullable|string|max:150',
            'description'  => 'nullable|string',
            'publish_date' => 'nullable|date',
            'format'       => 'nullable|in:dokumen,gambar,video,tautan,lain-lain', 
            'scope_id'     => 'nullable|integer|exists:scopes,id', 
            'status_id'    => 'nullable|integer|exists:statuses,id', 
            'url'          => 'nullable|url|max:255',
        ]);
        
        $knowledge->update($validatedData);

        // PERBAIKAN: Redirect ke index + Flash untuk memuat menu Knowledge
        return redirect()->route('knowledge.index')
                         ->with('redirectTo', 'Manajemen Knowledge')
                         ->with('success', 'Knowledge berhasil diperbarui!');
    }

    // ===============================================================
    // HAPUS KNOWLEDGE
    // ===============================================================
    public function destroy(Knowledge $knowledge)
    {
        $knowledge->delete();

        // PERBAIKAN: Redirect ke index + Flash untuk memuat menu Knowledge
        return redirect()->route('knowledge.index')
                         ->with('redirectTo', 'Manajemen Knowledge')
                         ->with('success', 'Knowledge berhasil dihapus!');
    }
}