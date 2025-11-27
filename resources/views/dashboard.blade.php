<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | SPBE Knowledge</title>
    
    {{-- Simulasi Font Awesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Variables POCO Style - TEMA TERANG (Dominan Putih dengan Aksen Kuning) */
        :root {
            --poco-header-bg: #FFFFFF; /* Pastikan ini bukan transparan */
            --poco-yellow: #FFDE00;
            --poco-light: #FFFFFF;
            --poco-text: #333333;
            --poco-header-bg: #FFFFFF; /* Navbar Background */
            --poco-card-bg: #FDFDFD;
            --poco-border: #EEEEEE;
            --poco-secondary-text: #666; /* Teks sekunder */
            --poco-hover-bg: #F0F0F0;
        }

        /* BASE STYLES & FONT */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--poco-light);
            color: var(--poco-text); 
            margin: 0;
            padding: 0;
            min-height: 100vh;
            overflow-x: hidden; 
        }

        /* --------------------------------- */
        /* NAVBAR (HEADER) */
        /* --------------------------------- */
        .header { 
            background: var(--poco-header-bg);
            color: var(--poco-text);
            padding: 10px 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 4px solid var(--poco-yellow);
            position: sticky;
            top: 0;
            z-index: 1000;
            /* 👇 Dua properti ini penting untuk sticky: */
            position: sticky; /* Membuatnya tetap di tempat saat menggulir */
            top: 0;          /* Menetapkan posisinya di bagian atas layar */
    
    /* 👇 Properti ini penting agar navbar selalu di atas elemen lain */
    z-index: 1000;  
        }

        


        .logo {
            color: var(--poco-text);
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-right: 30px;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
        }

        .menu { 
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .menu-item {
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.2s, color 0.2s;
            border-bottom: 3px solid transparent;
            font-size: 14px;
            font-weight: 600;
            color: var(--poco-text);
        }

        .menu-item:hover {
            color: #000;
            background-color: var(--poco-border); 
        }

        .menu-item.active {
            color: var(--poco-yellow);
            border-bottom: 3px solid var(--poco-yellow);
        }
        
        .menu-item i {
            margin-right: 5px;
            font-size: 16px;
        }
        
        /* User Info dan Profile Button */
        .user-info {
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .profile-btn {
            background: none; 
            border: none;
            color: var(--poco-text);
            padding: 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: color 0.2s;
            text-align: right;
            line-height: 1.2;
        }

        .profile-btn:hover {
            color: var(--poco-yellow);
        }

        .user-info .profile {
            width: 35px;
            height: 35px;
            background: var(--poco-yellow);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #000;
            font-weight: bold;
            margin-left: 10px;
            flex-shrink: 0;
            font-size: 16px;
        }

        .logout-btn {
            background: none;
            border: none;
            color: #D63030;
            font-weight: 600;
            cursor: pointer;
            margin-left: 20px;
            transition: color 0.2s;
        }
        .logout-btn:hover {
             color: #FF7272;
        }


        /* --------------------------------- */
        /* MAIN CONTENT AREA */
        /* --------------------------------- */
        .main-container {
            padding: 30px;
            flex-grow: 1;
        }
        
        /* Tambahan untuk form profile agar berdampingan */
        .profile-form-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }
        @media (min-width: 900px) {
            .profile-form-container {
                grid-template-columns: 1fr 1fr;
            }
        }


        /* CARD (untuk Statistik) */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .card {
            background: var(--poco-card-bg); 
            padding: 25px;
            border-radius: 10px;
            border-left: 5px solid var(--poco-yellow);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--poco-border);
            color: var(--poco-text);
        }
        
        .card-title { color: var(--poco-secondary-text); }
        .card-value { color: var(--poco-yellow); }

        /* Form Styling */
        .form-section { 
            background: var(--poco-card-bg);
            border: 1px solid var(--poco-border);
            padding: 30px;
            border-radius: 10px;
            color: var(--poco-text);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); 
        }
        .form-section h3 {
            color: var(--poco-yellow);
            border-bottom: 1px solid var(--poco-border);
            padding-bottom: 10px;
            margin-top: 0;
            font-size: 18px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            box-sizing: border-box;
            background: #fff;
            border: 1px solid #ccc;
            color: var(--poco-text);
            transition: border-color 0.2s;
        }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus { 
            outline: none;
            border-color: var(--poco-yellow); 
            box-shadow: 0 0 5px rgba(255, 222, 0, 0.3);
        }


        /* Tombol Submit Kuning */
        .btn-submit {
            padding: 10px 20px;
            background: var(--poco-yellow);
            color: #000;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-submit:hover {
            background: #FFEC70;
        }


        /* Tabel Styles */
        .table { 
            width: 100%;
            border-collapse: collapse;
            color: var(--poco-text); 
        }
        .table th, .table td { 
            padding: 15px;
            text-align: left;
            border: 1px solid #eee; 
        }
        .table thead th { 
            border-bottom: 2px solid var(--poco-yellow); 
            background-color: #f0f0f0 !important; 
            color: #333; 
            text-transform: uppercase;
            font-size: 13px;
        }
        .table tbody tr:nth-child(even) { background-color: #f8f8f8; }
        .table tbody tr:nth-child(odd) { background-color: #fff; }
        tabel.table tbody tr:hover { background-color: #F5F5F5; }
        
        .btn-delete { 
            background: #D63030; 
            color: white; 
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }
        .btn-delete:hover { background: #E95454; }
        
        .btn-read { 
            background: #1e88e5; 
            color: white; 
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            margin-right: 5px;
        }
        .btn-read:hover { background: #42a5f5; }


        /* Notifikasi */
        .alert-success { 
            background: #E6F7E6; 
            color: #1E6C1E; 
            border: 1px solid #A3D9A3; 
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .alert-error { 
            background: #FDE6E6; 
            color: #A31E1E; 
            border: 1px solid #D9A3A3; 
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .is-invalid { border-color: #ff4d4d !important; }

        /* --------------------------------- */
/* MEDIA QUERIES (RESPONSIVE DESIGN) */
/* --------------------------------- */

@media (max-width: 1200px) {
    /* Penyesuaian umum untuk layar yang lebih kecil */
    .header {
        padding: 10px 20px;
    }
    .menu-item {
        padding: 8px 10px;
        font-size: 13px;
    }
    .main-container {
        padding: 20px;
    }
}

@media (max-width: 900px) {
    /* Penyesuaian Grid Form (untuk Form Profile) */
    .profile-form-container {
        grid-template-columns: 1fr; /* Tumpuk ke bawah */
    }
}

@media (max-width: 768px) {
    
    /* HEADER & NAVIGASI */
    .header {
        flex-direction: column;
        align-items: flex-start;
        padding-bottom: 15px; /* Tambahkan padding bawah untuk memisahkan dari konten */
    }
    
    .logo {
        margin-bottom: 10px;
        font-size: 20px;
    }

    .navbar-menu {
        width: 100%;
        margin-bottom: 10px;
    }

    .menu {
        flex-wrap: wrap; /* Biarkan menu terlipat ke bawah jika tidak cukup ruang */
        justify-content: flex-start;
        width: 100%;
    }

    .menu-item {
        flex: 1 1 auto; /* Ambil ruang sebanyak mungkin, namun tetap bungkus */
        text-align: center;
        margin: 2px;
        font-size: 12px;
        padding: 8px 5px; /* Kecilkan padding */
    }
    
    .menu-item i {
        display: block; /* Ikon di atas teks */
        margin-right: 0;
        margin-bottom: 2px;
        font-size: 14px;
    }

    .user-info {
        width: 100%;
        justify-content: space-between; /* Pisahkan info profil dan tombol logout */
        margin-top: 5px;
        border-top: 1px solid var(--poco-border);
        padding-top: 10px;
    }

    .profile-btn {
        flex-grow: 1;
        justify-content: flex-start;
    }
    
    .profile-btn .profile {
        margin-left: 5px; /* Kurangi margin */
        width: 30px;
        height: 30px;
        font-size: 14px;
    }

    .logout-btn {
        margin-left: 10px;
    }

    /* STATISTIK GRID */
    .stats-grid {
        /* Auto-fit mungkin sudah cukup, tetapi pastikan minmax lebih kecil */
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); 
        gap: 15px;
        margin-bottom: 30px;
    }
    
    /* FORM & TABLE */
    /* Untuk grid input knowledge, tumpuk ke bawah */
    .form-section > form > div:first-child {
        grid-template-columns: 1fr !important;
    }
    .form-section > form > div > div {
        grid-template-columns: 1fr !important;
    }
    
    /* Pastikan tabel dapat di-scroll horizontal */
    .form-section[style*="overflow-x: auto"] {
        /* Tidak perlu perubahan, sudah diatur di HTML, tapi pastikan overflow aktif */
        overflow-x: auto;
    }

    /* Penyesuaian tombol di tabel (opsional) */
    .btn-read, .btn-submit, .btn-delete {
        padding: 6px 10px;
        font-size: 11px !important;
    }
    
}
    </style>
</head>
<body>

    <div class="header">
        <div class="logo">SPBE Knowledge</div>
        
        <div class="navbar-menu">
            <ul class="menu">
                {{-- Menu yang selalu tampil (Publik) --}}
                <li class="menu-item active" data-content="dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</li>
                <li class="menu-item" data-content="Manajemen Knowledge"><i class="fas fa-book"></i> Knowledge</li>
                <li class="menu-item" data-content="Manajemen Scope"><i class="fas fa-globe"></i> Scope</li>
                <li class="menu-item" data-content="Manajemen Status"><i class="fas fa-check-circle"></i> Status</li>
                
                {{-- PERBAIKAN: Menu Manajemen Admin hanya tampil jika role adalah 'superadmin' atau 'admin' --}}
                @auth
                    @if (in_array(auth()->user()?->role, ['superadmin', 'admin']))
                    <li class="menu-item" data-content="Manajemen Admin"><i class="fas fa-users-cog"></i> Admin</li>
                    @endif
                @endauth
            </ul>
        </div>

        <div class="user-info">
            {{-- Bagian Otentikasi dan Profil --}}
            @auth
                <button class="profile-btn" onclick="loadContent('Profile', 'Profile Pengguna', null);">
                    Selamat datang, {{ auth()->user()?->name ?? 'Pengguna' }}!
                    <div class="profile">{{ substr(auth()->user()?->name ?? 'P', 0, 1) }}</div>
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf 
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            @else
                {{-- Belum Login: Tampilkan Login dan Daftar --}}
                <a href="{{ route('register') }}" class="btn-submit" style="text-decoration: none; padding: 8px 15px; font-size: 13px; background: none; border: 1px solid var(--poco-yellow); color: var(--poco-yellow); margin-right: 10px;">DAFTAR</a>
                <a href="{{ route('login') }}" class="btn-submit" style="text-decoration: none; padding: 8px 15px; font-size: 13px;">LOGIN</a>
            @endauth
        </div>
    </div>

    <div class="main-container">
        
        {{-- JUDUL HALAMAN UTAMA - HANYA ADA SATU JUDUL BESAR DI SINI --}}
        <h1 id="header-title" style="color: var(--poco-text); margin-bottom: 20px; font-size: 24px; border-left: 5px solid var(--poco-yellow); padding-left: 10px;">Dashboard Utama</h1>

        {{-- Menampilkan pesan Success atau Error dari sesi (STATIS) --}}
        @if(session('success') && !($errors->any()))
            <div class="alert-success session-alert">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error') && !($errors->any()))
            <div class="alert-error session-alert">
                {{ session('error') }}
            </div>
        @endif
        
        <div id="dashboard-content">
            
            {{-- H2 ini tidak perlu dihilangkan karena dia bagian dari struktur dashboard overview --}}
            <div style="color: var(--poco-yellow); border-left: 5px solid var(--poco-yellow); padding-left: 15px; margin-bottom: 20px;">
                <h2 style="font-size: 20px; margin: 0; color: var(--poco-text);">Dashboard Overview</h2>
            </div>

            <div class="stats-grid">
                
                <div class="card">
                    <div class="card-title">Total Knowledge Base</div>
                    <div class="card-value">{{ $totalKnowledge ?? 'N/A' }}</div>
                    <p style="color: var(--poco-secondary-text); font-size: 12px; margin: 0;">Total semua konten</p>
                </div>

                <div class="card" style="border-left-color: #555;">
                    <div class="card-title">Dalam Draft</div>
                    <div class="card-value" style="color: #555;">{{ $draftKnowledge ?? 'N/A' }}</div>
                    <p style="color: var(--poco-secondary-text); font-size: 12px; margin: 0;">Menunggu Review</p>
                </div>

                <div class="card" style="border-left-color: #4CAF50;">
                    <div class="card-title">Sudah Dipublikasikan</div>
                    <div class="card-value" style="color: #4CAF50;">{{ $publishedKnowledge ?? 'N/A' }}</div>
                    <p style="color: var(--poco-secondary-text); font-size: 12px; margin: 0;">Konten Aktif</p>
                </div>
                
                <div class="card" style="border-left-color: #1e88e5;">
                    <div class="card-title">Total Pengguna Admin</div>
                    <div class="card-value">{{ $totalAdmin ?? 'N/A' }}</div>
                    <p style="color: var(--poco-secondary-text); font-size: 12px; margin: 0;">Pengguna aktif</p>
                </div>
            </div>

            <h2 style="color: var(--poco-yellow); border-bottom: 1px solid var(--poco-border); padding-bottom: 10px; margin-top: 0; font-size: 18px;">Aktivitas & Laporan Terbaru</h2>

            <div style="background: var(--poco-card); padding: 20px; border-radius: 10px; min-height: 400px; border: 1px solid var(--poco-border);">
                <ul style="list-style: none; padding: 0;">
                    @forelse ($latestActivities as $activity)
                    <li style="border-bottom: 1px dashed var(--poco-border); padding: 10px 0;">
                        <strong style="color: var(--poco-text);">{{ $activity->updated_at->format('Y-m-d H:i') }}:</strong>
                        Admin {{ $activity->creator?->name ?? 'User Tidak Dikenal' }} ({{ $activity->creator?->role ?? 'N/A' }}) 
                        telah mengedit/menambahkan konten: 
                        <a href="#" style="color: var(--poco-yellow); text-decoration: none;">{{ $activity->title }}</a>.
                        <span style="float: right; color: var(--poco-secondary-text); font-size: 12px;">Status: {{ $activity->status?->name ?? 'Unknown' }}</span>
                    </li>
                    @empty
                    <li style="padding: 10px 0; color: var(--poco-secondary-text);">Tidak ada aktivitas Knowledge terbaru.</li>
                    @endforelse
                </ul>
            </div>
        </div>
        
        <div id="dynamic-content"></div>

    </div>

    <footer style="padding: 15px; text-align: center; font-size: 12px; color: var(--poco-secondary-text); border-top: 1px solid var(--poco-border);">
        &copy; 2025 SPBE Knowledge Base Admin. Powered by Laravel.
    </footer>
    
    <script>
    const dashboardContent = document.getElementById('dashboard-content');
    const dynamicContent = document.getElementById('dynamic-content');
    const headerTitle = document.getElementById('header-title');
    const menuItems = document.querySelectorAll('.menu-item');
    const lastSubmittedUrl = "{{ url()->previous() }}";


    /* ===============================
        FUNGSI UNTUK MEMUAT FORM PEMBUATAN KNOWLEDGE
    ================================*/
    function loadKnowledgeForm(subtitle) {
        dashboardContent.style.display = 'none';
        headerTitle.textContent = subtitle;
        headerTitle.style.borderLeftColor = 'var(--poco-yellow)';

        // Logika untuk menampilkan notifikasi dari error validasi sebelumnya
        let notificationHtml = '';
        @if(session('success') && $errors->isEmpty())
            notificationHtml += `<div class="alert-success session-alert">{{ session('success') }}</div>`;
        @endif
        @if(session('error') && $errors->isEmpty())
            notificationHtml += `<div class="alert-error session-alert">{{ session('error') }}</div>`;
        @endif
        @if($errors->any())
            notificationHtml += `<div class="alert-error session-alert">Mohon periksa kesalahan di bawah ini pada formulir.</div>`;
        @endif

        // Dapatkan string error PHP untuk inject ke JS
        const titleError = `{!! $errors->first('title', '<small style="color:#ff4d4d; display: block; margin-top: 5px;">:message</small>') !!}`;
        const authorError = `{!! $errors->first('author', '<small style="color:#ff4d4d; display: block; margin-top: 5px;">:message</small>') !!}`;
        const instansiError = `{!! $errors->first('instansi', '<small style="color:#ff4d4d; display: block; margin-top: 5px;">:message</small>') !!}`;
        const publishDateError = `{!! $errors->first('publish_date', '<small style="color:#ff4d4d; display: block; margin-top: 5px;">:message</small>') !!}`;
        const formatError = `{!! $errors->first('format', '<small style="color:#ff4d4d; display: block; margin-top: 5px;">:message</small>') !!}`;
        const scopeIdError = `{!! $errors->first('scope_id', '<small style="color:#ff4d4d; display: block; margin-top: 5px;">:message</small>') !!}`;
        const statusIdError = `{!! $errors->first('status_id', '<small style="color:#ff4d4d; display: block; margin-top: 5px;">:message</small>') !!}`;
        const urlError = `{!! $errors->first('url', '<small style="color:#ff4d4d; display: block; margin-top: 5px;">:message</small>') !!}`;
        const descriptionError = `{!! $errors->first('description', '<small style="color:#ff4d4d; display: block; margin-top: 5px;">:message</small>') !!}`;


        dynamicContent.innerHTML = `
            ${notificationHtml}
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="font-size: 18px; margin: 0; color: var(--poco-text);">Formulir: Buat Knowledge Baru</h2>
                {{-- Tombol kembali ke Daftar Knowledge (PERBAIKAN: Menggunakan onclick JS) --}}
                <button class="btn-submit" onclick="loadContent('Manajemen Knowledge');" style="text-decoration: none; padding: 10px 20px; background: #666;">
                    <i class="fas fa-list"></i> Kembali ke Daftar
                </button>
            </div>
            
            <div class="form-section">
                {{-- FORMULIR PEMBUATAN KNOWLEDGE (Konten dari knowledge/create.blade.php) --}}
                <form method="POST" action="{{ route('knowledge.store') }}">
                    @csrf
                    <div style="display: grid; grid-template-columns: 1fr; gap: 30px;">
                        <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
                            
                            <!-- BARIS 1: TITLE, AUTHOR, INSTANSI, PUBLISH_DATE -->
                            <div class="form-group">
                                <label for="title">Judul Dokumen/Konten (title)</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}"
                                       class="${titleError ? 'is-invalid' : ''}" required>
                                ${titleError}
                            </div>

                            <div class="form-group">
                                <label for="author">Penulis (author)</label>
                                <input type="text" id="author" name="author" value="{{ old('author') }}"
                                       class="${authorError ? 'is-invalid' : ''}">
                                ${authorError}
                            </div>

                            <div class="form-group">
                                <label for="instansi">Instansi Penerbit (instansi)</label>
                                <input type="text" id="instansi" name="instansi" value="{{ old('instansi') }}"
                                       class="${instansiError ? 'is-invalid' : ''}">
                                ${instansiError}
                            </div>
                            
                            <div class="form-group">
                                <label for="publish_date">Tanggal Publikasi (publish_date)</label>
                                <input type="date" id="publish_date" name="publish_date" value="{{ old('publish_date', date('Y-m-d')) }}"
                                       class="${publishDateError ? 'is-invalid' : ''}">
                                ${publishDateError}
                            </div>

                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
                            
                            <!-- BARIS 2: FORMAT, SCOPE_ID, STATUS_ID, URL -->
                            <div class="form-group">
                                <label for="format">Format Konten (format)</label>
                                <select id="format" name="format" class="${formatError ? 'is-invalid' : ''}">
                                    @php $formats = ['dokumen', 'gambar', 'video', 'tautan', 'lain-lain']; @endphp
                                    @foreach ($formats as $f)
                                        <option value="{{ $f }}" {{ old('format') == $f ? 'selected' : '' }}>{{ ucfirst($f) }}</option>
                                    @endforeach
                                </select>
                                ${formatError}
                            </div>

                            <div class="form-group">
                                <label for="scope_id">Lingkup Penerapan (scope_id)</label>
                                <select id="scope_id" name="scope_id" class="${scopeIdError ? 'is-invalid' : ''}">
                                    <option value="">-- Pilih Lingkup --</option>
                                    {{-- Menggunakan variabel $scopes dari controller (diasumsikan ada) --}}
                                    @foreach ($scopes ?? [] as $scope)
                                        <option value="{{ $scope->id }}" {{ old('scope_id') == $scope->id ? 'selected' : '' }}>{{ $scope->name }}</option>
                                    @endforeach
                                </select>
                                ${scopeIdError}
                            </div>

                            <div class="form-group">
                                <label for="status_id">Status Dokumen (status_id)</label>
                                <select id="status_id" name="status_id" class="${statusIdError ? 'is-invalid' : ''}">
                                    <option value="">-- Pilih Status --</option>
                                    {{-- Menggunakan variabel $statuses dari controller (diasumsikan ada) --}}
                                    @foreach ($statuses ?? [] as $status)
                                        <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                                    @endforeach
                                </select>
                                ${statusIdError}
                            </div>

                            <div class="form-group">
                                <label for="url">Tautan Eksternal (url) - Opsional</label>
                                <input type="url" id="url" name="url" value="{{ old('url') }}"
                                       class="${urlError ? 'is-invalid' : ''}">
                                <p style="color: var(--poco-secondary-text); font-size: 12px; margin-top: 5px;">Isi jika Format adalah 'tautan' atau sumber eksternal.</p>
                                ${urlError}
                            </div>
                        </div>
                    </div> {{-- End Grid Container --}}
                    
                    <!-- DESCRIPTION (TEXTAREA) -->
                    <div class="form-group" style="margin-top: 20px;">
                        <label for="description">Deskripsi/Isi Ringkas (description)</label>
                        <textarea id="description" name="description" rows="6"
                                  class="${descriptionError ? 'is-invalid' : ''}">{{ old('description') }}</textarea>
                        ${descriptionError}
                    </div>

                    <div style="margin-top: 20px;">
                        <button type="submit" class="btn-submit">Simpan Knowledge</button>
                    </div>
                </form>
                {{-- AKHIR FORMULIR PEMBUATAN KNOWLEDGE --}}
            </div>
        `;
    }


    /* ===============================
        FUNGSI UNTUK MANAJEMEN KNOWLEDGE (INDEX/DAFTAR)
    ================================*/
    function loadKnowledgeManagement(subtitle) {
        dashboardContent.style.display = 'none';
        headerTitle.textContent = subtitle;
        headerTitle.style.borderLeftColor = 'var(--poco-yellow)';
        
        // Logika untuk menampilkan notifikasi
        let notificationHtml = '';
        @if(session('success') && $errors->isEmpty())
            notificationHtml += `<div class="alert-success session-alert">{{ session('success') }}</div>`;
        @endif
        @if(session('error') && $errors->isEmpty())
            notificationHtml += `<div class="alert-error session-alert">{{ session('error') }}</div>`;
        @endif

        // Pengecekan role untuk menyembunyikan/menampilkan kolom Status dan Aksi Edit
        @php
            // Menggunakan operator null safe (?) pada Auth::user() untuk mencegah crash saat guest
            $isSuperAdminOrAdmin = Auth::check() && in_array(Auth::user()?->role, ['superadmin', 'admin']);
        @endphp

        dynamicContent.innerHTML = `
            ${notificationHtml}
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="font-size: 18px; margin: 0; color: var(--poco-text);">Daftar Knowledge</h2>
                
                {{-- Tombol Buat Knowledge Baru - KINI PUBLIK (tetapi Controller akan mencegat Guest) --}}
                <button class="btn-submit" onclick="loadKnowledgeForm('Manajemen Knowledge - Buat');" style="text-decoration: none; padding: 10px 20px;">
                    + Buat Knowledge Baru
                </button>
            </div>

            <div class="form-section" style="padding: 0; overflow-x: auto; border: 1px solid var(--poco-border);">
                
                <table class="table" style="margin-bottom: 0;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Instansi</th>
            <th>Aksi</th> 
            @if ($isSuperAdminOrAdmin)
            <th>Status</th>
            <th>Aksi Admin</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse ($knowledgeItems ?? [] as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->instansi }}</td>
            
            {{-- KOLOM AKSI PUBLIK (BACA DOKUMEN) --}}
            <td>
                <a href="{{ route('knowledge.show', $item->id) }}" class="btn-read" style="text-decoration: none;">
                    <i class="fas fa-book-open"></i> Buka Dokumen
                </a>
            </td>
            
            @if ($isSuperAdminOrAdmin)
            <td>
                {{-- Asumsi status memiliki field name dan colour/badge --}}
                @php
                    // Gunakan null safe operator pada relasi status
                    $statusColor = $item->status?->color ?? '#555';
                    $statusName = $item->status?->name ?? 'Unknown';
                @endphp
                <span style="background-color: {{ $statusColor }}; color: white; padding: 3px 8px; border-radius: 4px; font-size: 12px;">
                    {{ $statusName }}
                </span>
            </td>
            <td>
                <a href="{{ route('knowledge.edit', $item->id) }}" class="btn-submit" style="padding: 8px 12px; background: #1e88e5; font-size: 13px; text-decoration: none;">Edit</a>
            </td>
            @endif
        </tr>
        @empty
        <tr>
            {{-- Menyesuaikan colspan setelah menghilangkan Role Akses --}}
            <td colspan="{{ $isSuperAdminOrAdmin ? 5 : 4 }}" style="text-align: center; padding: 20px; color: var(--poco-secondary-text);">
                Tidak ada data Knowledge yang tersedia saat ini.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

            </div>
        `;
    }


    /* ===============================
        FUNGSI UNTUK MANAJEMEN ADMIN 
    ================================*/
    function loadAdminManagement(subtitle) {
        dashboardContent.style.display = 'none';
        headerTitle.textContent = subtitle; // JUDUL UTAMA DARI HEADER TITLE

        @auth
            // Hanya tampilkan jika sudah login DAN role diizinkan (role check di JS sebagai fallback, tapi utama di Blade)
            @if (in_array(auth()->user()->role, ['superadmin', 'admin']))
            dynamicContent.innerHTML = `
                {{-- Kotak Notifikasi di sini jika diperlukan (diletakkan di dynamic content) --}}
                @if(session('success') && $errors->isEmpty())
                    <div class="alert-success" style="margin-bottom: 20px;">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error') && $errors->isEmpty())
                    <div class="alert-error" style="margin-bottom: 20px;">
                        {{ session('error') }}
                    </div>
                @endif

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    
                    <a href="{{ route('admin.create') }}" class="btn-submit" style="text-decoration: none; padding: 10px 20px;">
                        + Tambah Admin Baru
                    </a>
                </div>

                <div class="form-section" style="padding: 20px; border: 1px solid var(--poco-border); margin-bottom: 20px;">
                    <p style="margin: 0; color: var(--poco-text);">Isi kotak informasi admin yang sedang login di sini (Contoh: Selamat datang kembali).</p>
                </div>


                <div class="form-section" style="padding: 0; overflow-x: auto; border: 1px solid var(--poco-border);">
                    <h3 style="padding: 15px 30px; margin: 0; font-size: 16px; color: var(--poco-text); border-bottom: 2px solid var(--poco-yellow); background-color: #f0f0f0;">
                        Daftar Pengguna Admin (Total: {{ $admins->count() ?? 'N/A' }})
                    </h3>
                    
                    <table class="table" style="margin-bottom: 0;">
                        
                        <thead> 
                            <tr style="background-color: #f0f0f0;">
                                <th style="padding: 15px; border-bottom: 2px solid var(--poco-yellow); width: 5%;">No</th>
                                <th style="padding: 15px; border-bottom: 2px solid var(--poco-yellow); width: 30%;">Nama</th>
                                <th style="padding: 15px; border-bottom: 2px solid var(--poco-yellow); width: 30%;">Email</th>
                                <th style="padding: 15px; border-bottom: 2px solid var(--poco-yellow); width: 15%;">Role</th>
                                <th style="padding: 15px; border-bottom: 2px solid var(--poco-yellow); width: 20%; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @forelse ($admins ?? [] as $admin)
                            <tr>
                                <td style="text-align: left;">{{ $loop->iteration }}</td>
                                <td>{{ $admin->name }}</td>
                                
                                {{-- PERBAIKAN: Gunakan null safe operator pada relasi email dan role (jika Model Admin adalah Model User) --}}
                                <td>{{ $admin->email ?? 'N/A' }}</td>
                                <td>
                                    <span style="background-color: #FFDE00; color: #333; padding: 3px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">
                                        {{ $admin->role ?? 'N/A' }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    {{-- Cek Role untuk tombol Hapus (Hanya SuperAdmin) --}}
                                    @if (auth()->user()?->role === 'superadmin')
                                    <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus {{ $admin->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" style="background: #D63030; color: white; font-weight: bold;">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                    @else
                                    <span style="color: var(--poco-secondary-text); font-size: 12px;">Hanya SuperAdmin</span>
                                    @endif
                                    
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 20px; color: var(--poco-secondary-text);">
                                    Tidak ada admin lain yang terdaftar selain Anda.
                                </td>
                            </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
            `;
            @else
            // Jika user login tapi role-nya bukan admin/superadmin (misalnya role: 'user')
            dynamicContent.innerHTML = `
                <h2 style="color:#ff4d4d;margin-bottom:20px;font-size:18px;"><i class="fas fa-lock"></i> Akses Ditolak</h2>
                <div class="form-section">
                    <p style="color:var(--poco-text);">Anda tidak memiliki izin untuk mengakses manajemen admin.</p>
                </div>
            `;
            @endif
        @else
            // Jika belum login, tampilkan pesan
            dynamicContent.innerHTML = `
                <h2 style="color:#ff4d4d;margin-bottom:20px;font-size:18px;"><i class="fas fa-lock"></i> Akses Ditolak</h2>
                <div class="form-section">
                    <p style="color:var(--poco-text);">Anda harus <a href="{{ route('login') }}" style="color: var(--poco-yellow); font-weight: bold;">Login</a> untuk mengakses manajemen admin.</p>
                </div>
            `;
        @endauth
    }

    /* ===============================
        FUNGSI UTAMA MEMUAT KONTEN
    ================================*/
    function loadContent(menuText, subtitle, description) {

        // 1. Atur Tampilan Menu Aktif
        menuItems.forEach(i => i.classList.remove('active'));
        const currentItem = document.querySelector(`.menu-item[data-content="${menuText}"]`);
        if (currentItem) {
            currentItem.classList.add('active');
        }

        // 2. Sembunyikan Alert Sesi di Dashboard (agar tidak duplikat/salah tempat)
        const sessionAlerts = document.querySelectorAll('.session-alert');
        sessionAlerts.forEach(alert => alert.style.display = 'none'); 

        // 3. Logika Pemuatan Konten
        if (menuText === 'dashboard') {
            dashboardContent.style.display = 'block';
            dynamicContent.innerHTML = '';
            headerTitle.textContent = 'Dashboard Utama';
            headerTitle.style.borderLeftColor = 'var(--poco-yellow)'; // Tambahkan kembali border kiri

            // Tampilkan kembali alert sesi di dashboard
            sessionAlerts.forEach(alert => alert.style.display = 'block');
            
        } else if (menuText === 'Manajemen Knowledge') { // <-- Logika Knowledge
            loadKnowledgeManagement(menuText);
            headerTitle.style.borderLeftColor = 'var(--poco-yellow)'; 
            
        } else if (menuText === 'Manajemen Admin') {
            loadAdminManagement(menuText);
            headerTitle.style.borderLeftColor = 'var(--poco-yellow)'; // Pastikan warna border sesuai
            
        } else if (menuText === 'Profile') {

            dashboardContent.style.display = 'none';
            headerTitle.textContent = 'Pengaturan Akun';
            headerTitle.style.borderLeftColor = 'var(--poco-yellow)'; // Pastikan warna border sesuai

            // --- Pengecekan Autentikasi dan Data Pengguna ---
            @auth
                // Jika sudah login, tampilkan form
                
                let validationErrorHtml = '';
                
                @if(session()->has('success') && $errors->isEmpty())
                    validationErrorHtml += `<div class="alert-success">{{ session('success') }}</div>`;
                @endif
                @if(session()->has('error') && $errors->isEmpty())
                    validationErrorHtml += `<div class="alert-error">{{ session('error') }}</div>`;
                @endif
                @if($errors->any())
                    validationErrorHtml += `<div class="alert-error">Mohon periksa kesalahan di bawah ini.</div>`;
                @endif

                // Status Error di Form Akun 
                let nameErrorClass = '{{ $errors->has("name") ? "is-invalid" : "" }}';
                let nameErrorMessage = `
                    @error('name')
                        <small style="color:#ff4d4d; display: block; margin-top: 5px;">{{ $message }}</small>
                    @enderror
                `;
                
                // Status Error di Form Password
                let currentPasswordErrorClass = '{{ $errors->has("current_password") ? "is-invalid" : "" }}';
                let currentPasswordErrorMessage = `
                    @error('current_password')
                        <small style="color:#ff4d4d; display: block; margin-top: 5px;">{{ $message }}</small>
                    @enderror
                `;
                
                let newPasswordErrorClass = '{{ $errors->has("new_password") ? "is-invalid" : "" }}';
                let newPasswordErrorMessage = `
                    @error('new_password')
                        <small style="color:#ff4d4d; display: block; margin-top: 5px;">{{ $message }}</small>
                    @enderror
                `;

                dynamicContent.innerHTML = `
                    ${validationErrorHtml}
                    
                    {{-- 💡 Hapus tag <h2> Pengaturan Akun di sini --}}
                    
                    <div class="profile-form-container">

                        <div class="form-section">
                            <h3><i class="fas fa-user"></i> Data Akun</h3>
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf 
                                @method('PUT')

                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" class="${nameErrorClass}" required>
                                    ${nameErrorMessage}
                                </div>

                                <div class="form-group">
                                    <label>Email (Tidak Dapat Diubah)</label>
                                    <input type="email" value="{{ auth()->user()->email ?? '' }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label>Role</label>
                                    <input type="text" value="{{ auth()->user()->role ?? 'Admin' }}" disabled>
                                </div>

                                <button class="btn-submit">Simpan Perubahan Data</button>
                            </form>
                        </div>

                        <div class="form-section">
                            <h3><i class="fas fa-lock"></i> Ganti Password</h3>
                            <form method="POST" action="{{ route('profile.password') }}">
                                @csrf 
                                @method('PUT')

                                <div class="form-group">
                                    <label>Password Lama</label>
                                    <input type="password" name="current_password" class="${currentPasswordErrorClass}" required>
                                    ${currentPasswordErrorMessage}
                                </div>

                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input type="password" name="new_password" class="${newPasswordErrorClass}" required>
                                    ${newPasswordErrorMessage}
                                </div>

                                <div class="form-group">
                                    <label>Konfirmasi Password Baru</label>
                                    <input type="password" name="new_password_confirmation" required>
                                </div>

                                <button class="btn-submit">Ubah Password</button>
                            </form>
                        </div>

                    </div>
                `;
            @endauth
            
        } else {
            // Load konten dinamis lainnya
            dashboardContent.style.display = 'none';
            headerTitle.textContent = subtitle;
            headerTitle.style.borderLeftColor = 'var(--poco-yellow)';

            dynamicContent.innerHTML = `
                <div class="form-section">
                    <p style="color:var(--poco-text);">Konten untuk manajemen ${menuText} akan ditampilkan di sini...</p>
                </div>
            `;
        }
    }

    /* ===============================
        EVENT NAVIGASI
    ================================*/
    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            const menuText = item.getAttribute('data-content');
            loadContent(menuText, `Halaman: ${menuText}`, `Konten untuk manajemen ${menuText} akan ditampilkan di sini...`);
        });
    });

    /* ===============================
        LOAD AWAL
    ================================*/
    document.addEventListener('DOMContentLoaded', () => {
        // Cek apakah ada error validasi setelah POST/PUT/DELETE
        const hasValidationErrors = @json($errors->any());
        
        // Logika untuk menampilkan Profile, Admin, atau Knowledge jika ada error validasi DARI form tersebut
        if (hasValidationErrors) {
            if (lastSubmittedUrl.includes('profile')) {
                loadContent('Profile', 'Profile Pengguna', null);
            } else if (lastSubmittedUrl.includes('admin')) {
                loadContent('Manajemen Admin', 'Manajemen Admin', null);
            } else if (lastSubmittedUrl.includes('knowledge') && !lastSubmittedUrl.includes('create')) { 
                // Cek jika error terjadi saat submit FORM knowledge (knowledge.store)
                loadKnowledgeForm('Manajemen Knowledge - Buat');
            } else {
                loadContent('dashboard');
            }
        } else {
            // Load Dashboard secara default
            loadContent('dashboard');
        }
    });
    </script>
    
</body>
</html>