<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SAMPAY - Profil Saya</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Inter',sans-serif;background:#f0fdf4;min-height:100vh;padding-bottom:100px;-webkit-font-smoothing:antialiased}
        a{text-decoration:none;color:inherit}

        /* ── Header ── */
        .header{background:linear-gradient(160deg,#059669 0%,#047857 60%,#065f46 100%);padding:52px 20px 80px;color:#fff;position:relative;overflow:hidden;text-align:center}
        .header::before{content:'';position:absolute;top:-60px;right:-60px;width:240px;height:240px;border-radius:50%;background:rgba(255,255,255,0.05)}
        .header::after{content:'';position:absolute;bottom:-80px;left:-40px;width:300px;height:300px;border-radius:50%;background:rgba(255,255,255,0.04)}
        .header-inner{position:relative;z-index:2}
        .header-topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:28px}
        .topbar-title{font-size:18px;font-weight:800}
        .back-btn{width:38px;height:38px;border-radius:12px;background:rgba(255,255,255,0.15);border:0;display:flex;align-items:center;justify-content:center;cursor:pointer}

        /* Avatar */
        .avatar-wrap{display:flex;justify-content:center;margin-bottom:16px}
        .avatar{width:90px;height:90px;border-radius:50%;background:rgba(255,255,255,0.2);border:3px solid rgba(255,255,255,0.4);display:flex;align-items:center;justify-content:center;font-size:36px;font-weight:900;color:#fff;letter-spacing:-1px;backdrop-filter:blur(8px)}
        .profile-name{font-size:22px;font-weight:900;letter-spacing:-0.03em;margin-bottom:6px}
        .profile-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,0.15);padding:5px 14px;border-radius:99px;font-size:12px;font-weight:700}
        .profile-badge-dot{width:7px;height:7px;border-radius:50%;background:#86efac}
        .profile-email{font-size:13px;opacity:0.7;margin-top:8px}

        /* ── Float card ── */
        .float-content{margin:-36px 16px 0;position:relative;z-index:10}

        /* ── Info read-only card ── */
        .info-card{background:#fff;border-radius:20px;padding:20px;margin-bottom:14px;border:1px solid #f1f5f9;box-shadow:0 4px 16px rgba(5,150,105,0.08)}
        .card-section-title{font-size:11px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:16px}
        .info-row{display:flex;align-items:center;gap:14px;padding:12px 0;border-bottom:1px solid #f8fafc}
        .info-row:last-child{border-bottom:0;padding-bottom:0}
        .info-row:first-of-type{padding-top:0}
        .info-icon{width:40px;height:40px;border-radius:12px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
        .info-text{flex:1;min-width:0}
        .info-label{font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px}
        .info-value{font-size:14px;font-weight:700;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .info-lock{width:16px;height:16px;color:#cbd5e1;flex-shrink:0}

        /* ── Edit form card ── */
        .form-card{background:#fff;border-radius:20px;padding:20px;margin-bottom:14px;border:1px solid #f1f5f9;box-shadow:0 4px 16px rgba(5,150,105,0.08)}
        .form-group{margin-bottom:16px}
        .form-group:last-of-type{margin-bottom:0}
        label{display:block;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:7px}
        .input-wrap{position:relative}
        .input-icon{position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:16px;pointer-events:none}
        input[type=text],input[type=password]{width:100%;padding:13px 14px 13px 42px;border-radius:12px;border:1.5px solid #e2e8f0;font-size:14px;font-family:inherit;color:#1e293b;background:#fff;transition:border-color 0.2s,box-shadow 0.2s;outline:none;-webkit-appearance:none}
        input[type=text]:focus,input[type=password]:focus{border-color:#059669;box-shadow:0 0 0 3px rgba(5,150,105,0.12)}
        input::placeholder{color:#cbd5e1}
        .input-hint{font-size:11px;color:#94a3b8;margin-top:5px;padding-left:2px}
        .divider{display:flex;align-items:center;gap:12px;margin:20px 0 4px}
        .divider-line{flex:1;height:1px;background:#f1f5f9}
        .divider-text{font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;white-space:nowrap}

        /* ── Buttons ── */
        .btn{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:14px;border-radius:14px;font-size:14px;font-weight:800;border:0;cursor:pointer;transition:all 0.2s;letter-spacing:-0.01em}
        .btn-save{background:linear-gradient(135deg,#059669,#047857);color:#fff;box-shadow:0 4px 14px rgba(5,150,105,0.3)}
        .btn-save:hover{opacity:0.92;transform:translateY(-1px)}
        .btn-save:active{transform:translateY(0)}
        .btn-danger{background:#fff;color:#dc2626;border:1.5px solid #fecaca}
        .btn-danger:hover{background:#fef2f2}

        /* Alert */
        .alert{padding:13px 16px;border-radius:14px;font-size:13px;font-weight:600;margin-bottom:14px;display:flex;align-items:center;gap:8px}
        .alert-success{background:#d1fae5;border:1px solid #6ee7b7;color:#065f46}
        .alert-error{background:#fee2e2;border:1px solid #fca5a5;color:#991b1b}

        /* ── Bottom Nav ── */
        .bottom-nav{position:fixed;bottom:0;left:0;right:0;background:#fff;border-top:1px solid #e2e8f0;display:flex;justify-content:space-around;padding:10px 0 20px;z-index:100;box-shadow:0 -8px 24px rgba(0,0,0,0.06)}
        .nav-btn{display:flex;flex-direction:column;align-items:center;gap:3px;padding:6px 12px;border:0;background:transparent;cursor:pointer;color:#94a3b8;font-size:10px;font-weight:700;border-radius:12px;transition:color 0.2s}
        .nav-btn.active{color:#059669}
        .nav-btn svg{width:22px;height:22px;stroke-width:2}
    </style>
</head>
<body>

    <!-- Header / Hero -->
    <div class="header">
        <div class="header-inner">
            <div class="header-topbar">
                <button class="back-btn" onclick="location.href='{{ route('petugas.dashboard') }}'">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <div style="display:flex;align-items:center;gap:8px;">
                    <img src="{{ asset('images/logo/logo-sampay.png') }}" alt="SAMPAY" style="width:28px;height:28px;object-fit:contain;border-radius:7px;">
                    <div class="topbar-title">SAMPAY</div>
                </div>
                <div style="width:38px"></div>
            </div>

            <div class="avatar-wrap">
                <div class="avatar">{{ strtoupper(substr($user->nama_lengkap, 0, 2)) }}</div>
            </div>
            <div class="profile-name">{{ $user->nama_lengkap }}</div>
            <div style="display:flex;justify-content:center;margin-top:6px;">
                <div class="profile-badge">
                    <span class="profile-badge-dot"></span>
                    {{ $user->role }}
                </div>
            </div>
            <div class="profile-email">{{ $user->email }}</div>
        </div>
    </div>

    <!-- Float content -->
    <div class="float-content">

        <!-- Flash message -->
        @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if($errors->any())
        <div class="alert alert-error">⚠️ Terdapat kesalahan pada form. Periksa kembali.</div>
        @endif

        <!-- Info akun (read only) -->
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
                <div class="info-icon">🪪</div>
                <div class="info-text">
                    <div class="info-label">Role Pengguna</div>
                    <div class="info-value">{{ $user->role }}</div>
                </div>
                <svg class="info-lock" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
        </div>

        <!-- Form Edit -->
        <div class="form-card">
            <div class="card-section-title">Edit Informasi</div>

            <form action="{{ route('petugas.profil.update') }}" method="POST" id="profileForm">
                @csrf

                <!-- Nama -->
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <div class="input-wrap">
                        <span class="input-icon">✏️</span>
                        <input type="text" id="nama" name="nama_lengkap"
                               value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
                               placeholder="Nama lengkap kamu"
                               required>
                    </div>
                    @error('nama_lengkap')
                    <div style="font-size:12px;color:#dc2626;font-weight:600;margin-top:5px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Divider Password -->
                <div class="divider">
                    <div class="divider-line"></div>
                    <div class="divider-text">Ganti Password (opsional)</div>
                    <div class="divider-line"></div>
                </div>

                <!-- Password Baru -->
                <div class="form-group" style="margin-top:16px">
                    <label for="password">Password Baru</label>
                    <div class="input-wrap">
                        <span class="input-icon">🔐</span>
                        <input type="password" id="password" name="password"
                               placeholder="Min. 6 karakter"
                               minlength="6">
                    </div>
                    <div class="input-hint">Kosongkan jika tidak ingin mengubah password.</div>
                    @error('password')
                    <div style="font-size:12px;color:#dc2626;font-weight:600;margin-top:5px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-wrap">
                        <span class="input-icon">🔁</span>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               placeholder="Ulangi password baru">
                    </div>
                </div>

                <button type="submit" class="btn btn-save" style="margin-top:20px;">
                    💾 Simpan Perubahan
                </button>
            </form>
        </div>

        <!-- Logout -->
        <div class="form-card">
            <div class="card-section-title">Sesi & Keamanan</div>
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
        <button class="nav-btn" onclick="location.href='{{ route('petugas.dashboard') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Beranda
        </button>
        <button class="nav-btn" onclick="location.href='{{ route('petugas.tugas.index') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            Tugas
        </button>
        <button class="nav-btn" onclick="location.href='{{ route('petugas.riwayat') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Riwayat
        </button>
        <button class="nav-btn active" onclick="location.href='{{ route('petugas.profil') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Profil
        </button>
    </nav>

</body>
</html>
