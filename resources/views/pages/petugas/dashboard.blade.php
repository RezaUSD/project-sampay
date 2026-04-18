<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SAMPAY Petugas</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0} body{font-family:'Inter',sans-serif;background:#f0fdf4;min-height:100vh;padding-bottom:88px;-webkit-font-smoothing:antialiased} a{text-decoration:none;color:inherit}

        /* ── Header ── */
        .header{background:linear-gradient(160deg,#059669 0%,#047857 60%,#065f46 100%);padding:52px 20px 80px;color:#fff;position:relative;overflow:hidden}
        .header::before{content:'';position:absolute;top:-60px;right:-60px;width:240px;height:240px;border-radius:50%;background:rgba(255,255,255,0.05)}
        .header::after{content:'';position:absolute;bottom:-80px;left:-40px;width:300px;height:300px;border-radius:50%;background:rgba(255,255,255,0.04)}
        .header-inner{position:relative;z-index:2}
        .header-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px}
        .header-logo{display:flex;align-items:center;gap:8px;font-size:16px;font-weight:800;letter-spacing:-0.02em}
        .logo-dot{width:28px;height:28px;border-radius:8px;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;font-size:14px}
        .header-greeting{font-size:13px;opacity:0.75;margin-bottom:6px}
        .header-name{font-size:26px;font-weight:900;letter-spacing:-0.03em;line-height:1.1;margin-bottom:4px}
        .header-role{display:inline-flex;align-items:center;gap:6px;font-size:12px;background:rgba(255,255,255,0.15);padding:4px 12px;border-radius:99px;margin-top:4px}
        .role-dot{width:6px;height:6px;border-radius:50%;background:#86efac}

        /* ── Stats float card ── */
        .stats-card{background:#fff;border-radius:24px;margin:-44px 16px 0;padding:20px;box-shadow:0 8px 32px rgba(5,150,105,0.15);position:relative;z-index:10;display:grid;grid-template-columns:repeat(3,1fr);gap:0}
        .stat-item{text-align:center;padding:0 8px}
        .stat-item:not(:last-child){border-right:1px solid #f1f5f9}
        .stat-num{font-size:28px;font-weight:900;color:#059669;letter-spacing:-0.03em;line-height:1}
        .stat-label{font-size:10px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;margin-top:4px}

        /* ── Section ── */
        .section{padding:24px 16px 0}
        .section-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:14px}
        .section-title{font-size:13px;font-weight:800;color:#475569;text-transform:uppercase;letter-spacing:0.07em}
        .section-link{font-size:12px;font-weight:700;color:#059669}

        /* ── Quick cards ── */
        .quick-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
        .quick-card{background:#fff;border-radius:20px;padding:18px;border:1px solid #f1f5f9;box-shadow:0 1px 6px rgba(0,0,0,0.04);cursor:pointer;transition:transform 0.15s,box-shadow 0.15s;text-decoration:none;display:block}
        .quick-card:active{transform:scale(0.97)}
        .quick-card-icon{width:44px;height:44px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:14px}
        .quick-card-num{font-size:26px;font-weight:900;color:#1e293b;letter-spacing:-0.03em;line-height:1}
        .quick-card-label{font-size:12px;font-weight:600;color:#64748b;margin-top:4px}
        .quick-card-badge{display:inline-flex;align-items:center;gap:4px;font-size:10px;font-weight:700;padding:2px 8px;border-radius:99px;margin-top:8px}

        /* ── Task cards ── */
        .card{background:#fff;border-radius:20px;padding:16px;margin-bottom:10px;border:1px solid #f1f5f9;box-shadow:0 1px 4px rgba(0,0,0,0.04)}
        .card-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:10px}
        .card-user{display:flex;align-items:center;gap:10px}
        .card-avatar{width:38px;height:38px;border-radius:12px;background:linear-gradient(135deg,#d1fae5,#a7f3d0);display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:800;color:#065f46;flex-shrink:0}
        .card-username{font-size:14px;font-weight:700;color:#1e293b}
        .card-email{font-size:11px;color:#94a3b8;margin-top:1px}
        .badge{display:inline-flex;align-items:center;font-size:10px;font-weight:700;padding:3px 10px;border-radius:99px;text-transform:uppercase;letter-spacing:0.04em}
        .badge-pending{background:#fef3c7;color:#92400e}
        .badge-diproses{background:#dbeafe;color:#1e40af}
        .badge-dijemput{background:#f3e8ff;color:#6b21a8}
        .badge-selesai{background:#d1fae5;color:#065f46}
        .card-info{display:flex;align-items:center;gap:6px;font-size:12px;color:#94a3b8;margin-bottom:8px}
        .card-kategori-chip{display:inline-flex;align-items:center;gap:5px;font-size:12px;font-weight:600;color:#475569;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:4px 10px}
        .card-keterangan{font-size:12px;color:#64748b;background:#f8fafc;padding:10px 12px;border-radius:10px;line-height:1.5;margin:10px 0}
        .card-actions{display:flex;gap:8px;margin-top:12px}
        .btn{display:inline-flex;align-items:center;justify-content:center;gap:6px;padding:11px 16px;border-radius:12px;font-size:13px;font-weight:700;border:0;cursor:pointer;transition:all 0.2s;text-decoration:none;flex:1}
        .btn-green{background:linear-gradient(135deg,#059669,#047857);color:#fff}
        .btn-outline{background:#f8fafc;color:#475569;border:1.5px solid #e2e8f0}
        .btn-map{background:#eff6ff;color:#2563eb;border:1.5px solid #bfdbfe}

        /* ── Empty state ── */
        .empty{background:#fff;border-radius:20px;padding:48px 24px;text-align:center;border:1px solid #f1f5f9}
        .empty-emoji{font-size:48px;margin-bottom:16px;display:block}
        .empty-title{font-size:16px;font-weight:800;color:#334155;margin-bottom:6px}
        .empty-sub{font-size:13px;color:#94a3b8;line-height:1.6}
        .empty-cta{display:inline-flex;align-items:center;gap:8px;margin-top:16px;padding:10px 20px;background:linear-gradient(135deg,#059669,#047857);color:#fff;border-radius:12px;font-size:13px;font-weight:700}

        /* ── Alerts ── */
        .alert{padding:13px 16px;border-radius:14px;font-size:13px;font-weight:600;margin:16px 16px 0;display:flex;align-items:center;gap:8px}
        .alert-success{background:#d1fae5;border:1px solid #6ee7b7;color:#065f46}
        .alert-error{background:#fee2e2;border:1px solid #fca5a5;color:#991b1b}

        /* ── Bottom Nav ── */
        .bottom-nav{position:fixed;bottom:0;left:0;right:0;background:#fff;border-top:1px solid #e2e8f0;display:flex;justify-content:space-around;padding:10px 0 20px;z-index:100;box-shadow:0 -8px 24px rgba(0,0,0,0.06)}
        .nav-btn{display:flex;flex-direction:column;align-items:center;gap:3px;padding:6px 12px;border:0;background:transparent;cursor:pointer;color:#94a3b8;font-size:10px;font-weight:700;transition:color 0.2s;border-radius:12px}
        .nav-btn.active{color:#059669}
        .nav-btn svg{width:22px;height:22px;stroke-width:2}
        .nav-btn-form{border:0;background:transparent;padding:0}
    </style>
</head>
<body>

    @if(session('success'))
    <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-error">⚠️ {{ session('error') }}</div>
    @endif

    <!-- Header -->
    <div class="header">
        <div class="header-inner">
            <div class="header-top">
                <div class="header-logo">
                    <img src="{{ asset('images/logo/logo-sampay.png') }}" alt="SAMPAY" style="width:32px;height:32px;object-fit:contain;border-radius:8px;">
                    SAMPAY
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="background:rgba(255,255,255,0.15);border:0;color:#fff;padding:8px 14px;border-radius:10px;font-size:12px;font-weight:700;cursor:pointer;">Keluar</button>
                </form>
            </div>
            <div class="header-greeting">Selamat datang kembali 👋</div>
            <div class="header-name">{{ Auth::user()->nama_lengkap }}</div>
            <div class="header-role">
                <span class="role-dot"></span>
                Petugas Lapangan Aktif
            </div>
        </div>
    </div>

    <!-- Stats Card Float -->
    <div class="stats-card">
        <div class="stat-item">
            <div class="stat-num">{{ $stats['total_selesai'] }}</div>
            <div class="stat-label">Selesai</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">{{ $stats['tugas_aktif'] }}</div>
            <div class="stat-label">Aktif</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">{{ $tugasBaru->count() }}</div>
            <div class="stat-label">Menunggu</div>
        </div>
    </div>

    <!-- Quick Menu -->
    <div class="section">
        <div class="section-header">
            <div class="section-title">Menu Utama</div>
        </div>
        <div class="quick-grid" style="grid-template-columns:1fr 1fr 1fr;">
            <a href="{{ route('petugas.tugas.index') }}?tab=baru" class="quick-card">
                <div class="quick-card-icon" style="background:#fef3c7;">📋</div>
                <div class="quick-card-num">{{ $tugasBaru->count() }}</div>
                <div class="quick-card-label">Tugas Tersedia</div>
                @if($tugasBaru->count() > 0)
                <div class="quick-card-badge" style="background:#fef3c7;color:#92400e;">● Baru</div>
                @endif
            </a>
            <a href="{{ route('petugas.tugas.index') }}" class="quick-card">
                <div class="quick-card-icon" style="background:#dbeafe;">🚛</div>
                <div class="quick-card-num">{{ $stats['tugas_aktif'] }}</div>
                <div class="quick-card-label">Aktif Saya</div>
                @if($stats['tugas_aktif'] > 0)
                <div class="quick-card-badge" style="background:#dbeafe;color:#1e40af;">● Proses</div>
                @endif
            </a>
            <a href="{{ route('petugas.riwayat') }}" class="quick-card">
                <div class="quick-card-icon" style="background:#d1fae5;">📊</div>
                <div class="quick-card-num">{{ $stats['total_selesai'] }}</div>
                <div class="quick-card-label">Riwayat</div>
            </a>
        </div>
    </div>

    <!-- Tugas Aktif -->
    <div class="section" style="padding-top:22px;">
        <div class="section-header">
            <div class="section-title">Tugas Aktif</div>
            @if($tugasAktif->count() > 0)
            <a href="{{ route('petugas.tugas.index') }}" class="section-link">Lihat Semua →</a>
            @endif
        </div>

        @forelse($tugasAktif as $t)
        <div class="card">
            <div class="card-header">
                <div class="card-user">
                    <div class="card-avatar">{{ substr($t->user?->nama_lengkap ?? 'U', 0, 1) }}</div>
                    <div>
                        <div class="card-username">{{ $t->user?->nama_lengkap ?? 'Pengguna' }}</div>
                        <div class="card-email">{{ $t->user?->email ?? '' }}</div>
                    </div>
                </div>
                @php $bc = match($t->status) { 'Diproses'=>'diproses','Dijemput'=>'dijemput',default=>'pending' }; @endphp
                <span class="badge badge-{{ $bc }}">{{ $t->status }}</span>
            </div>

            <div class="card-info">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 0 1-2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z"/><circle cx="12" cy="11" r="3"/></svg>
                {{ $t->latitude && $t->longitude ? number_format($t->latitude,4).', '.number_format($t->longitude,4) : 'Lokasi tidak tersedia' }}
            </div>

            <span class="card-kategori-chip">🗑️ {{ $t->kategori }}</span>

            @if($t->keterangan_warga)
            <div class="card-keterangan">"{{ $t->keterangan_warga }}"</div>
            @endif

            <div class="card-actions">
                @if($t->latitude && $t->longitude)
                <a href="https://maps.google.com/?q={{ $t->latitude }},{{ $t->longitude }}" target="_blank" class="btn btn-map">🗺️ Maps</a>
                @endif
                <a href="{{ route('petugas.tugas.show', $t->id_laporan) }}" class="btn btn-green">Detail & Aksi →</a>
            </div>
        </div>
        @empty
        <div class="empty">
            <span class="empty-emoji">🏖️</span>
            <div class="empty-title">Tidak Ada Tugas Aktif</div>
            <div class="empty-sub">Ambil tugas dari daftar laporan yang tersedia untuk memulai.</div>
            <a href="{{ route('petugas.tugas.index') }}?tab=baru" class="empty-cta">📋 Cek Tugas Tersedia</a>
        </div>
        @endforelse
    </div>

    <!-- Bottom Nav -->
    <nav class="bottom-nav">
        <button class="nav-btn active" onclick="location.href='{{ route('petugas.dashboard') }}'">
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
        <button class="nav-btn" onclick="location.href='{{ route('petugas.profil') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Profil
        </button>
    </nav>

</body>
</html>
