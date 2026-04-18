<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SAMPAY - Profil Saya</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0} body{font-family:'Inter',sans-serif;background:#f0fdf4;min-height:100vh;padding-bottom:100px;-webkit-font-smoothing:antialiased} a{text-decoration:none;color:inherit}

        /* Header */
        .header{background:linear-gradient(160deg,#0ea5e9 0%,#0284c7 50%,#0369a1 100%);padding:52px 20px 80px;color:#fff;position:relative;overflow:hidden;text-align:center}
        .header::before{content:'';position:absolute;top:-60px;right:-60px;width:240px;height:240px;border-radius:50%;background:rgba(255,255,255,0.06)}
        .header::after{content:'';position:absolute;bottom:-80px;left:-40px;width:300px;height:300px;border-radius:50%;background:rgba(255,255,255,0.04)}
        .header-inner{position:relative;z-index:2}
        .header-topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:28px}
        .topbar-title{font-size:18px;font-weight:800}
        .back-btn{width:38px;height:38px;border-radius:12px;background:rgba(255,255,255,0.15);border:0;display:flex;align-items:center;justify-content:center;cursor:pointer}

        .avatar{width:84px;height:84px;border-radius:50%;background:rgba(255,255,255,0.2);border:3px solid rgba(255,255,255,0.4);display:flex;align-items:center;justify-content:center;font-size:34px;font-weight:900;color:#fff;margin:0 auto 14px;backdrop-filter:blur(8px)}
        .profile-name{font-size:22px;font-weight:900;letter-spacing:-0.03em;margin-bottom:8px}
        .poin-float{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.2);padding:8px 18px;border-radius:99px;font-size:13px;font-weight:700}
        .poin-num{font-size:18px;font-weight:900}

        /* Float content */
        .float-content{margin:-36px 16px 0;position:relative;z-index:10}
        .info-card{background:#fff;border-radius:20px;padding:20px;margin-bottom:14px;border:1px solid #f1f5f9;box-shadow:0 4px 16px rgba(2,132,199,0.08)}
        .card-section-title{font-size:11px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:16px}
        .info-row{display:flex;align-items:center;gap:14px;padding:12px 0;border-bottom:1px solid #f8fafc}
        .info-row:last-child{border-bottom:0;padding-bottom:0}
        .info-row:first-of-type{padding-top:0}
        .info-icon{width:40px;height:40px;border-radius:12px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
        .info-text{flex:1;min-width:0}
        .info-label{font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px}
        .info-value{font-size:14px;font-weight:700;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .info-lock{width:16px;height:16px;color:#cbd5e1;flex-shrink:0}

        /* Form */
        .form-group{margin-bottom:16px}
        label{display:block;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:7px}
        .input-wrap{position:relative}
        .input-icon{position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:16px}
        input[type=text],input[type=password]{width:100%;padding:13px 14px 13px 42px;border-radius:12px;border:1.5px solid #e2e8f0;font-size:14px;font-family:inherit;color:#1e293b;background:#fff;outline:none;transition:border-color 0.2s;-webkit-appearance:none}
        input[type=text]:focus,input[type=password]:focus{border-color:#0284c7;box-shadow:0 0 0 3px rgba(2,132,199,0.12)}
        input::placeholder{color:#cbd5e1}
        .input-hint{font-size:11px;color:#94a3b8;margin-top:5px}
        .divider{display:flex;align-items:center;gap:12px;margin:20px 0 4px}
        .divider-line{flex:1;height:1px;background:#f1f5f9}
        .divider-text{font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;white-space:nowrap}

        .btn{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:14px;border-radius:14px;font-size:14px;font-weight:800;border:0;cursor:pointer;transition:all 0.2s}
        .btn-save{background:linear-gradient(135deg,#0ea5e9,#0369a1);color:#fff;box-shadow:0 4px 14px rgba(2,132,199,0.3);margin-top:20px}
        .btn-danger{background:#fff;color:#dc2626;border:1.5px solid #fecaca}

        .alert{padding:13px 16px;border-radius:14px;font-size:13px;font-weight:600;margin-bottom:14px;display:flex;align-items:center;gap:8px}
        .alert-success{background:#d1fae5;border:1px solid #6ee7b7;color:#065f46}

        /* Bottom Nav */
        .bottom-nav{position:fixed;bottom:0;left:0;right:0;background:#fff;border-top:1px solid #e2e8f0;display:flex;justify-content:space-around;padding:10px 0 20px;z-index:100;box-shadow:0 -8px 24px rgba(0,0,0,0.06)}
        .nav-btn{display:flex;flex-direction:column;align-items:center;gap:3px;padding:6px 12px;border:0;background:transparent;cursor:pointer;color:#94a3b8;font-size:10px;font-weight:700;border-radius:12px}
        .nav-btn.active{color:#0284c7}
        .nav-btn svg{width:22px;height:22px;stroke-width:2}
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <div class="header-inner">
            <div class="header-topbar">
                <button class="back-btn" onclick="location.href='{{ route('masyarakat.dashboard') }}'">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <div style="display:flex;align-items:center;gap:8px">
                    <img src="{{ asset('images/logo/logo-sampay.png') }}" alt="SAMPAY" style="width:28px;height:28px;object-fit:contain;border-radius:7px">
                    <div class="topbar-title">SAMPAY</div>
                </div>
                <div style="width:38px"></div>
            </div>
            <div class="avatar">{{ strtoupper(substr($user->nama_lengkap, 0, 2)) }}</div>
            <div class="profile-name">{{ $user->nama_lengkap }}</div>
            <div class="poin-float">
                <span>🪙</span>
                <span class="poin-num">{{ number_format($user->saldo_poin ?? 0) }}</span>
                <span>Poin</span>
            </div>
        </div>
    </div>

    <div class="float-content">
        @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif

        <!-- Info Akun -->
        <div class="info-card">
            <div class="card-section-title">Informasi Akun</div>
            <div class="info-row">
                <div class="info-icon">📧</div>
                <div class="info-text">
                    <div class="info-label">Alamat Email</div>
                    <div class="info-value">{{ $user->email }}</div>
                </div>
                <svg class="info-lock" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <div class="info-row">
                <div class="info-icon">🪙</div>
                <div class="info-text">
                    <div class="info-label">Saldo Poin</div>
                    <div class="info-value" style="color:#b45309">{{ number_format($user->saldo_poin ?? 0) }} Poin</div>
                </div>
            </div>
            <div class="info-row">
                <div class="info-icon">🪪</div>
                <div class="info-text">
                    <div class="info-label">Role</div>
                    <div class="info-value">{{ $user->role }}</div>
                </div>
                <svg class="info-lock" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="info-card">
            <div class="card-section-title">Edit Profil</div>
            <form action="{{ route('masyarakat.profil.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <div class="input-wrap">
                        <span class="input-icon">✏️</span>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                    </div>
                </div>
                <div class="divider">
                    <div class="divider-line"></div>
                    <div class="divider-text">Ganti Password (Opsional)</div>
                    <div class="divider-line"></div>
                </div>
                <div class="form-group" style="margin-top:16px">
                    <label>Password Baru</label>
                    <div class="input-wrap">
                        <span class="input-icon">🔐</span>
                        <input type="password" name="password" placeholder="Min. 6 karakter" minlength="6">
                    </div>
                    <div class="input-hint">Kosongkan jika tidak ingin mengubah password.</div>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <div class="input-wrap">
                        <span class="input-icon">🔁</span>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password baru">
                    </div>
                </div>
                <button type="submit" class="btn btn-save">💾 Simpan Perubahan</button>
            </form>
        </div>

        <!-- Logout -->
        <div class="info-card">
            <div class="card-section-title">Sesi</div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar dari Akun
                </button>
            </form>
        </div>
    </div>

    <!-- Bottom Nav -->
    <nav class="bottom-nav">
        <button class="nav-btn" onclick="location.href='{{ route('masyarakat.dashboard') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Beranda
        </button>
        <button class="nav-btn" onclick="location.href='{{ route('masyarakat.laporan.create') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Lapor
        </button>
        <button class="nav-btn" onclick="location.href='{{ route('masyarakat.reward.index') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Reward
        </button>
        <button class="nav-btn active">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Profil
        </button>
    </nav>
</body>
</html>
