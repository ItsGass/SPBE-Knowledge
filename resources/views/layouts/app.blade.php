<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Detail Dokumen') | SPBE Knowledge</title>
    
    {{-- Simulasi Font Awesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Variables POCO Style - TEMA TERANG (Dominan Putih dengan Aksen Kuning) */
        :root {
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
        }

        /* --------------------------------- */
        /* HEADER/NAVIGASI MINIMALIS */
        /* --------------------------------- */
        .header { 
            background: var(--poco-light);
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
        }

        

        .logo {
            color: var(--poco-text);
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        /* PERBAIKAN TAMPILAN TOMBOL KEMBALI (KUNING) */
        .btn-back {
            /* Menggunakan style tombol Kuning/Primary POCO */
            background-color: var(--poco-yellow); 
            color: var(--poco-text); /* Teks gelap */
            padding: 10px 18px;
            border: none; 
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: background-color 0.2s, transform 0.1s;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .btn-back i {
            margin-right: 8px;
        }
        .btn-back:hover {
            background-color: #FFEC70; /* Sedikit lebih terang saat hover */
            transform: translateY(-1px);
        }
        
        /* --------------------------------- */
        /* MAIN CONTENT & CARD STYLE (Mirip Dashboard) */
        /* --------------------------------- */
        main {
            padding: 30px 0;
            background-color: var(--poco-light);
        }

        .container-fluid {
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }

        .card {
            background: var(--poco-card-bg); 
            padding: 25px;
            border-radius: 10px;
            border-left: 5px solid var(--poco-yellow);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--poco-border);
            color: var(--poco-text);
            margin-bottom: 20px;
        }
        
        .card-title-header {
            color: var(--poco-yellow);
            border-bottom: 1px solid var(--poco-border);
            padding-bottom: 10px;
            margin-top: 0;
            font-size: 20px;
            font-weight: bold;
        }
        
        /* Tombol Edit/Aksi */
        .btn-action {
            background: #1e88e5; 
            color: white; 
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
            transition: background 0.2s;
        }
        .btn-action:hover {
            background: #42a5f5;
        }

        /* Notifikasi (Sama dengan Dashboard) */
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

    </style>
    
</head>

<body>

<div class="header">
    <div class="logo">SPBE Knowledge</div>
    
    {{-- Tombol untuk Kembali ke Daftar Knowledge (knowledge.index) --}}
    {{-- Route ini sudah benar dan akan mengarahkan ke KnowledgeController@index --}}
    <a href="{{ route('knowledge.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Knowledge
    </a>
</div>
    
<main>
    <div class="container-fluid">
        
        {{-- Menampilkan pesan Success atau Error --}}
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif
        
        {{-- Konten Dinamis dari View spesifik (knowledge.show, knowledge.edit) --}}
        @yield('content') 
        
    </div>
</main>

<footer>
    <div class="container-fluid" style="text-align: center; padding-top: 15px; border-top: 1px solid var(--poco-border);">
        <span style="font-size: 12px; color: var(--poco-secondary-text);">&copy; 2025 SPBE Knowledge Base Admin.</span>
    </div>
</footer>

{{-- Tautan ke JavaScript --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
@stack('scripts')

</body>
</html>