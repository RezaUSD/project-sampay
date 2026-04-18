<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Daftar Akun - SAMPAY</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #10b981;
            --primary-dark: #059669;
            --bg-dark: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.7);
            --text-main: #f8fafc;
            --text-dim: #94a3b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background: var(--bg-dark);
            background-image: 
                radial-gradient(circle at 10% 10%, rgba(16, 185, 129, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 90% 90%, rgba(59, 130, 246, 0.15) 0%, transparent 40%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: var(--text-main);
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 10;
        }

        /* Glassmorphism Card */
        .register-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 28px;
            padding: 40px 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo-box {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), #3b82f6);
            border-radius: 20px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
            transform: rotate(-5deg);
        }

        h1 {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .subtitle {
            font-size: 15px;
            color: var(--text-dim);
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dim);
            margin-bottom: 8px;
            margin-left: 5px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-dim);
            transition: all 0.3s;
        }

        input {
            width: 100%;
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 15px 15px 15px 50px;
            color: white;
            font-size: 15px;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(15, 23, 42, 0.8);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        input:focus + i {
            color: var(--primary);
        }

        .btn-register {
            width: 100%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            border-radius: 16px;
            padding: 16px;
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.3s;
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(16, 185, 129, 0.3);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .footer-links {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: var(--text-dim);
        }

        .footer-links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
        }

        /* Error States */
        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            padding: 12px;
            border-radius: 12px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Responsive Mobile */
        @media (max-width: 480px) {
            .register-card {
                padding: 30px 20px;
                border-radius: 24px;
            }
            h1 { font-size: 24px; }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="register-card">
            <div class="header">
                <div class="logo-box">
                    <i class="fas fa-recycle"></i>
                </div>
                <h1>Daftar Warga</h1>
                <p class="subtitle">Bergabung untuk mengelola sampah jadi rupiah</p>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <div class="input-wrapper">
                        <input type="text" name="name" placeholder="Masukkan nama Anda" required value="{{ old('name') }}">
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <div class="input-wrapper">
                        <input type="email" name="email" placeholder="contoh@sampay.id" required value="{{ old('email') }}">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password Akun</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" placeholder="Minimal 8 karakter" required>
                        <i class="fas fa-lock"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <div class="input-wrapper">
                        <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
                        <i class="fas fa-shield-halved"></i>
                    </div>
                </div>

                <button type="submit" class="btn-register">Buat Akun Sekarang</button>
            </form>

            <div class="footer-links">
                Sudah punya akun?<a href="{{ route('login') }}">Masuk Disini</a>
            </div>
        </div>
    </div>

</body>
</html>
