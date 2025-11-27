<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SPBE Knowledge</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Variables POCO Style (Light) */
        :root {
            --poco-yellow: #FFDE00;
            --poco-text: #333333;
            --poco-card-bg: #FFFFFF;
            --poco-border: #EEEEEE;
            --poco-secondary-text: #666;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f0f0; /* Light background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Menggunakan min-height agar bisa scroll jika form panjang */
            overflow-y: auto; /* Memungkinkan scroll vertikal */
            position: relative;
        }

        /* Bubble Decoration (CSS for decorative elements) */
        .bubble-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }
        
        /* Mengubah posisi bubble agar berbeda dari halaman login */
        .bubble {
            position: absolute;
            background: linear-gradient(135deg, var(--poco-yellow) 0%, rgba(255, 255, 255, 0.5) 100%);
            border-radius: 50%;
            opacity: 0.8;
            filter: blur(10px); 
            animation: moveBubbles 15s infinite alternate;
        }

        .bubble:nth-child(1) { width: 180px; height: 180px; top: 15%; right: 10%; animation-duration: 22s; } /* Ubah posisi */
        .bubble:nth-child(2) { width: 120px; height: 120px; bottom: 5%; left: 18%; animation-duration: 16s; opacity: 0.7; } /* Ubah posisi */
        .bubble:nth-child(3) { width: 220px; height: 220px; top: -5%; left: 30%; animation-duration: 20s; opacity: 0.5; }
        .bubble:nth-child(4) { width: 150px; height: 150px; bottom: 40%; right: 25%; animation-duration: 18s; opacity: 0.6; }

        @keyframes moveBubbles {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(200px, 100px) rotate(360deg); }
        }

        /* Register Box Styling */
        .box {
            width: 420px; /* Sedikit lebih lebar untuk form register */
            background: var(--poco-card-bg);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            z-index: 10;
            border-top: 5px solid var(--poco-yellow);
            margin: 50px 0; /* Margin atas/bawah agar ada ruang scroll */
        }

        h2 {
            text-align: center;
            color: var(--poco-text);
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: 700;
        }
        
        .logo-login {
            text-align: center;
            color: var(--poco-yellow);
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--poco-text);
            font-weight: 600;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
            color: var(--poco-text);
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: var(--poco-yellow);
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 222, 0, 0.2);
        }
        
        .is-invalid {
            border-color: #ff4d4d !important;
        }
        .invalid-feedback {
            color: #ff4d4d;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: var(--poco-yellow);
            color: #000;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            font-size: 15px;
            margin-top: 10px;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background: #ffe542;
        }

        .link-text {
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
            color: var(--poco-secondary-text);
        }

        .link-text a {
            color: var(--poco-yellow);
            text-decoration: none;
            font-weight: bold;
            transition: color 0.2s;
        }
        
        .alert-error {
            background: #FDE6E6;
            color: #A31E1E;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="bubble-container">
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
</div>

<div class="box">
    <div class="logo-login">SPBE Knowledge</div>
    <h2>Daftar Akun Baru</h2>

    @if (session('error') && ! $errors->any())
        <div class="alert-error">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert-error">
            Mohon periksa input Anda.
        </div>
    @endif

    <form method="POST" action="{{ route('register.process') }}">
        @csrf

        <div class="form-group">
            <label for="name"><i class="fas fa-user"></i> Nama Lengkap</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email"><i class="fas fa-envelope"></i> Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password"><i class="fas fa-lock"></i> Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="password_confirmation"><i class="fas fa-check-lock"></i> Konfirmasi Password</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
        </div>


        <button type="submit" class="btn-submit">
            Daftar
        </button>
    </form>

    <p class="link-text">
        Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
    </p>
</div>

</body>
</html>