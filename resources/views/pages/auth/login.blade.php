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

        .login-container{width:100%;max-width:420px;margin:auto;padding:24px}

        /* Header Area */
        .auth-header{text-align:center;margin-bottom:32px}
        .logo-box{width:72px;height:72px;background:#fff;border-radius:20px;margin:0 auto 16px;display:flex;align-items:center;justify-content:center;box-shadow:0 10px 25px rgba(2,132,199,0.12);border:1px solid #f1f5f9}
        .logo-box img{width:46px;height:46px;object-fit:contain}
        .app-name{font-size:24px;font-weight:900;color:#0284c7;letter-spacing:-0.03em}
        .app-sub{font-size:14px;color:#64748b;margin-top:4px;font-weight:500}

        /* Card */
        .auth-card{background:#fff;border-radius:24px;padding:32px;box-shadow:0 20px 50px rgba(0,0,0,0.04);border:1px solid #f1f5f9;position:relative;overflow:hidden}
        .auth-card::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#0ea5e9,#0369a1)}

        .card-title{font-size:18px;font-weight:800;margin-bottom:8px;color:#1e293b}
        .card-sub{font-size:13px;color:#94a3b8;margin-bottom:28px;line-height:1.5}

        /* Form */
        .form-group{margin-bottom:20px}
        label{display:block;font-size:12px;font-weight:700;color:#475569;margin-bottom:8px;text-transform:uppercase;letter-spacing:0.04em}
        .input-wrap{position:relative}
        .input-icon{position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:18px;color:#94a3b8}
        input{width:100%;height:52px;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:14px;padding:0 16px 0 46px;font-size:15px;font-family:inherit;color:#1e293b;transition:all 0.2s;outline:none}
        input:focus{background:#fff;border-color:#0284c7;box-shadow:0 0 0 4px rgba(2,132,199,0.1)}
        input::placeholder{color:#cbd5e1}

        /* Error */
        .error-alert{background:#fef2f2;border:1px solid #fecaca;border-radius:14px;padding:12px 16px;margin-bottom:24px;color:#b91c1c;font-size:13px;font-weight:600;display:flex;align-items:center;gap:10px}

        /* Button */
        .btn-login{width:100%;height:52px;background:linear-gradient(135deg,#0ea5e9,#0369a1);color:#fff;border:0;border-radius:14px;font-size:15px;font-weight:800;cursor:pointer;margin-top:8px;box-shadow:0 10px 20px rgba(2,132,199,0.3);transition:all 0.2s;display:flex;align-items:center;justify-content:center;gap:10px}
        .btn-login:active{transform:scale(0.98);box-shadow:0 5px 10px rgba(2,132,199,0.2)}

        /* Footer */
        .auth-footer{text-align:center;margin-top:32px;padding-bottom:20px}
        .auth-footer p{font-size:12px;color:#94a3b8;line-height:1.6}
        .back-link{display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:700;color:#0284c7;margin-top:20px;text-decoration:none}

        /* Desktop */
        @media(min-width:1024px){
            body{background:#f1f5f9;justify-content:center}
            .auth-card{box-shadow:0 40px 80px rgba(15,23,42,0.08)}
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- Header -->
        <div class="auth-header">
            <div class="logo-box">
                <img src="{{ asset('images/logo/logo-sampay.png') }}" alt="SAMPAY">
            </div>
            <h1 class="app-name">SAMPAY</h1>
            <p class="app-sub">Solusi Sampah Jadi Poin</p>
        </div>

        <!-- Form Card -->
        <div class="auth-card">
            <h2 class="card-title">Selamat Datang 👋</h2>
            <p class="card-sub">Gunakan akun Anda untuk masuk ke dashboard layanan.</p>

            @if($errors->any())
            <div class="error-alert">
                <span>⚠️</span>
                <div>
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <div class="input-wrap">
                        <span class="input-icon">✉️</span>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Contoh: user@sampay.id" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrap">
                        <span class="input-icon">🔐</span>
                        <input type="password" name="password" placeholder="Masukkan password" required>
                    </div>
                </div>

                <div style="display:flex;align-items:center;gap:8px;margin-bottom:24px">
                    <input type="checkbox" name="remember" id="remember" style="width:16px;height:16px;margin:0;accent-color:#0284c7">
                    <label for="remember" style="margin:0;text-transform:none;font-weight:600;color:#64748b;cursor:pointer">Ingat Saya</label>
                </div>

                <button type="submit" class="btn-login">
                    Masuk Sekarang
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>

            <div style="text-align:center;margin-top:24px;font-size:14px;color:#64748b">
                Belum punya akun? <a href="{{ route('register') }}" style="color:#0ea5e9;text-decoration:none;font-weight:700">Daftar Sekarang</a>
            </div>
        </div>

        <!-- Footer -->
        <div class="auth-footer">
            <p>Akses Terpadu untuk Admin, Petugas, dan Warga.<br>© 2026 SAMPAY Team.</p>
            <a href="{{ route('landing') }}" class="back-link">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>
