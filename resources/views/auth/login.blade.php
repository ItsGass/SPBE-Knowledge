<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPBE Knowledge</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Variables POCO Style (Light) */
        :root {
            --poco-yellow: #FFDE00;
            --poco-text: #333333;
            --poco-card-bg: #FFFFFF;
            --poco-border: #EEEEEE;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f0f0; /* Light background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
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

        .bubble {
            position: absolute;
            background: linear-gradient(135deg, var(--poco-yellow) 0%, rgba(255, 255, 255, 0.5) 100%);
            border-radius: 50%;
            opacity: 0.8;
            filter: blur(10px); /* Efek Blur */
            animation: moveBubbles 15s infinite alternate;
        }

        .bubble:nth-child(1) { width: 150px; height: 150px; top: 10%; left: 5%; animation-duration: 18s; }
        .bubble:nth-child(2) { width: 250px; height: 250px; bottom: -10%; right: 15%; animation-duration: 20s; opacity: 0.6; }
        .bubble:nth-child(3) { width: 100px; height: 100px; top: 40%; right: 5%; animation-duration: 15s; }
        .bubble:nth-child(4) { width: 180px; height: 180px; bottom: 30%; left: 20%; animation-duration: 25s; opacity: 0.7; }

        @keyframes moveBubbles {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(200px, 100px) rotate(360deg); }
        }

        /* Login Box Styling */
        .box {
            width: 380px;
            background: var(--poco-card-bg);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            z-index: 10;
            border-top: 5px solid var(--poco-yellow);
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
    <h2>Login</h2>

    @if (session('error') && ! $errors->any())
        <div class="alert-error">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert-error">
            Mohon periksa input Anda.
        </div>
    @endif

    <form method="POST" action="{{ route('login.process') }}">
        @csrf

        <div class="form-group">
            <label for="email"><i class="fas fa-envelope"></i> Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
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

        <button type="submit" class="btn-submit">
            Masuk
        </button>
    </form>

    <p class="link-text">
        Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
    </p>
</div>

</body>
</html>