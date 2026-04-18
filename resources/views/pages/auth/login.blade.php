<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SAMPAY - Masuk ke Sistem</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Inter',sans-serif;background:#f8fafc;color:#1e293b;min-height:100vh;display:flex;flex-direction:column;-webkit-font-smoothing:antialiased}

        .auth-container{width:100%;max-width:400px;margin:auto;padding:20px}

        /* Card */
        .auth-card{background:#fff;border-radius:24px;padding:32px;box-shadow:0 20px 50px rgba(0,0,0,0.04);border:1px solid #f1f5f9;position:relative;overflow:hidden}
        .auth-card::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#0ea5e9,#0369a1)}

        .logo-box{width:60px;height:60px;margin:0 auto 20px;display:flex;align-items:center;justify-content:center}
        .logo-box img{width:100%;height:100%;object-fit:contain}

        .card-title{font-size:18px;font-weight:800;margin-bottom:8px;color:#1e293b;text-align:center}
        .card-sub{font-size:13px;color:#94a3b8;margin-bottom:24px;line-height:1.5;text-align:center}

        /* Form */
        .form-group{margin-bottom:16px}
        label{display:block;font-size:11px;font-weight:700;color:#475569;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.04em}
        input{width:100%;height:48px;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:12px;padding:0 16px;font-size:14px;font-family:inherit;color:#1e293b;transition:all 0.2s;outline:none}
        input:focus{background:#fff;border-color:#0284c7;box-shadow:0 0 0 4px rgba(2,132,199,0.1)}

        .btn-auth{width:100%;height:48px;background:linear-gradient(135deg,#0ea5e9,#0369a1);color:#fff;border:0;border-radius:12px;font-size:14px;font-weight:800;cursor:pointer;margin-top:8px;box-shadow:0 10px 20px rgba(2,132,199,0.25);transition:all 0.2s;display:flex;align-items:center;justify-content:center;gap:10px}
        .btn-auth:active{transform:scale(0.98)}

        .auth-footer{text-align:center;margin-top:24px}
        .auth-footer p{font-size:11px;color:#94a3b8}
        .back-link{display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:700;color:#0284c7;margin-top:16px;text-decoration:none}
    </style>
</head>
<body>

    <div class="auth-container">
        <div class="auth-card">
            <!-- Logo Di Dalam Box -->
            <div class="logo-box">
                <img src="{{ asset('images/logo/logo-sampay.png') }}" alt="SAMPAY Logo">
            </div>

            <h2 class="card-title">Selamat Datang 👋</h2>
            <p class="card-sub">Gunakan akun Anda untuk masuk.</p>

            @if($errors->any())
            <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:12px;padding:10px;margin-bottom:20px;color:#b12b2b;font-size:13px">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="contoh@email.com" required value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-auth">
                    Masuk Sekarang
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>

            <div style="text-align:center;margin-top:20px;font-size:13px;color:#64748b">
                Belum punya akun? <a href="{{ route('register') }}" style="color:#0ea5e9;text-decoration:none;font-weight:700">Daftar</a>
            </div>
        </div>

        <div class="auth-footer">
            <p>© 2026 SAMPAY Team.</p>
            <a href="{{ route('landing') }}" class="back-link">← Beranda</a>
        </div>
    </div>

</body>
</html>
