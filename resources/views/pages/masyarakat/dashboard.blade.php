<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SAMPAY - Beranda</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0} body{font-family:'Inter',sans-serif;background:#f0fdf4;min-height:100vh;padding-bottom:88px;-webkit-font-smoothing:antialiased} a{text-decoration:none;color:inherit}

        /* Header */
        .header{background:linear-gradient(160deg,#0ea5e9 0%,#0284c7 50%,#0369a1 100%);padding:52px 20px 80px;color:#fff;position:relative;overflow:hidden}
        .header::before{content:'';position:absolute;top:-60px;right:-60px;width:240px;height:240px;border-radius:50%;background:rgba(255,255,255,0.06)}
        .header::after{content:'';position:absolute;bottom:-80px;left:-40px;width:300px;height:300px;border-radius:50%;background:rgba(255,255,255,0.04)}
        .header-inner{position:relative;z-index:2}
        .header-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px}
        .header-logo{display:flex;align-items:center;gap:8px;font-size:16px;font-weight:800}
        .header-greeting{font-size:13px;opacity:0.75;margin-bottom:6px}
        .header-name{font-size:24px;font-weight:900;letter-spacing:-0.03em;line-height:1.1;margin-bottom:6px}

        /* Poin badge */
        .poin-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.2);backdrop-filter:blur(8px);padding:8px 16px;border-radius:99px;font-size:13px;font-weight:700}
        .poin-num{font-size:18px;font-weight:900}

        /* Stats float */
        .stats-card{background:#fff;border-radius:24px;margin:-44px 16px 0;padding:20px;box-shadow:0 8px 32px rgba(14,165,233,0.15);position:relative;z-index:10;display:grid;grid-template-columns:repeat(3,1fr)}
        .stat-item{text-align:center;padding:0 8px}
        .stat-item:not(:last-child){border-right:1px solid #f1f5f9}
        .stat-num{font-size:26px;font-weight:900;color:#0284c7;letter-spacing:-0.03em;line-height:1}
        .stat-label{font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;margin-top:4px}

        /* Section */
        .section{padding:24px 16px 0}
        .section-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:14px}
        .section-title{font-size:13px;font-weight:800;color:#475569;text-transform:uppercase;letter-spacing:0.07em}
        .section-link{font-size:12px;font-weight:700;color:#0284c7}

        /* Action button besar */
        .lapor-btn{background:linear-gradient(135deg,#0ea5e9,#0369a1);border-radius:20px;padding:20px;color:#fff;display:flex;align-items:center;gap:16px;border:0;width:100%;cursor:pointer;text-align:left;box-shadow:0 6px 20px rgba(14,165,233,0.35);transition:transform 0.15s}
        .lapor-btn:active{transform:scale(0.98)}
        .lapor-btn-icon{width:52px;height:52px;border-radius:16px;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;font-size:24px;flex-shrink:0}
        .lapor-btn-text{flex:1}
        .lapor-btn-title{font-size:16px;font-weight:800;margin-bottom:3px}
        .lapor-btn-sub{font-size:12px;opacity:0.8}
        .lapor-btn-arrow{font-size:20px;opacity:0.7}

        /* Quick grid 3 col */
        .quick-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:10px}
        .quick-card{background:#fff;border-radius:18px;padding:16px 12px;border:1px solid #f1f5f9;box-shadow:0 1px 6px rgba(0,0,0,0.04);cursor:pointer;transition:transform 0.15s;text-decoration:none;display:block;text-align:center}
        .quick-card:active{transform:scale(0.96)}
        .quick-card-icon{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;margin:0 auto 10px}
        .quick-card-label{font-size:11px;font-weight:700;color:#64748b}

        /* Recent laporan */
        .laporan-card{background:#fff;border-radius:18px;padding:14px;margin-bottom:10px;border:1px solid #f1f5f9;box-shadow:0 1px 4px rgba(0,0,0,0.04);display:flex;align-items:center;gap:12px}
        .laporan-icon{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
        .laporan-info{flex:1;min-width:0}
        .laporan-kategori{font-size:13px;font-weight:700;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .laporan-date{font-size:11px;color:#94a3b8;margin-top:2px}
        .badge{display:inline-flex;font-size:10px;font-weight:700;padding:3px 9px;border-radius:99px;text-transform:uppercase}
        .badge-pending{background:#fef3c7;color:#92400e}
        .badge-diproses{background:#dbeafe;color:#1e40af}
        .badge-dijemput{background:#f3e8ff;color:#6b21a8}
        .badge-selesai{background:#d1fae5;color:#065f46}
        .badge-ditolak{background:#fee2e2;color:#991b1b}

        /* Empty */
        .empty{background:#fff;border-radius:18px;padding:36px 20px;text-align:center;border:1px solid #f1f5f9}
        .empty-emoji{font-size:40px;margin-bottom:10px;display:block}
        .empty-title{font-size:14px;font-weight:700;color:#475569}

        /* Alert */
        .alert{padding:12px 16px;border-radius:14px;font-size:13px;font-weight:600;margin:16px 16px 0;display:flex;align-items:center;gap:8px}
        .alert-success{background:#d1fae5;border:1px solid #6ee7b7;color:#065f46}

        /* Bottom Nav */
        .bottom-nav{position:fixed;bottom:0;left:0;right:0;background:#fff;border-top:1px solid #e2e8f0;display:flex;justify-content:space-around;padding:10px 0 20px;z-index:100;box-shadow:0 -8px 24px rgba(0,0,0,0.06)}
        .nav-btn{display:flex;flex-direction:column;align-items:center;gap:3px;padding:6px 12px;border:0;background:transparent;cursor:pointer;color:#94a3b8;font-size:10px;font-weight:700;border-radius:12px;transition:color 0.2s}
        .nav-btn.active{color:#0284c7}
        .nav-btn svg{width:22px;height:22px;stroke-width:2}
    </style>
</head>
<body>

    @if(session('success'))
    <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    <!-- Header -->
    <div class="header">
        <div class="header-inner">
            <div class="header-top">
                <div class="header-logo">
                    <img src="{{ asset('images/logo/logo-sampay.png') }}" alt="SAMPAY" style="width:30px;height:30px;object-fit:contain;border-radius:8px;">
                    SAMPAY
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="background:rgba(255,255,255,0.15);border:0;color:#fff;padding:8px 14px;border-radius:10px;font-size:12px;font-weight:700;cursor:pointer;">Keluar</button>
                </form>
            </div>
            <div class="header-greeting">Halo, Selamat Datang 👋</div>
            <div class="header-name">{{ Auth::user()->nama_lengkap }}</div>
            <div class="poin-badge" style="margin-top:10px;">
                <span>🪙</span>
                <span>Saldo Poin:</span>
                <span class="poin-num">{{ number_format($stats['saldo_poin']) }}</span>
                <span>Pts</span>
            </div>
        </div>
    </div>

    <!-- Stats Float Card -->
    <div class="stats-card">
        <div class="stat-item">
            <div class="stat-num">{{ $stats['total_laporan'] }}</div>
            <div class="stat-label">Total Laporan</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">{{ $stats['pending'] }}</div>
            <div class="stat-label">Diproses</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">{{ $stats['selesai'] }}</div>
            <div class="stat-label">Selesai</div>
        </div>
    </div>

    <!-- Tombol Lapor -->
    <div class="section">
        <a href="{{ route('masyarakat.laporan.create') }}" class="lapor-btn">
            <div class="lapor-btn-icon">📍</div>
            <div class="lapor-btn-text">
                <div class="lapor-btn-title">Lapor Sampah Sekarang</div>
                <div class="lapor-btn-sub">Foto + Lokasi GPS otomatis terdeteksi</div>
            </div>
            <div class="lapor-btn-arrow">→</div>
        </a>
    </div>

    <!-- Quick Menu -->
    <div class="section" style="padding-top:18px;">
        <div class="section-header">
            <div class="section-title">Menu</div>
        </div>
        <div class="quick-grid">
            <a href="{{ route('masyarakat.laporan.index') }}" class="quick-card">
                <div class="quick-card-icon" style="background:#eff6ff;">📋</div>
                <div class="quick-card-label">Riwayat Laporan</div>
            </a>
            <a href="{{ route('masyarakat.reward.index') }}" class="quick-card">
                <div class="quick-card-icon" style="background:#fef9c3;">🎁</div>
                <div class="quick-card-label">Tukar Reward</div>
            </a>
            <a href="{{ route('masyarakat.profil') }}" class="quick-card">
                <div class="quick-card-icon" style="background:#f0fdf4;">👤</div>
                <div class="quick-card-label">Profil Saya</div>
            </a>
        </div>
    </div>

    <!-- Laporan Terbaru -->
    <div class="section" style="padding-top:22px;">
        <div class="section-header">
            <div class="section-title">Laporan Terbaru</div>
            @if(count($recentLaporan) > 0)
            <a href="{{ route('masyarakat.laporan.index') }}" class="section-link">Lihat Semua →</a>
            @endif
        </div>

        @forelse($recentLaporan as $l)
        @php
            $icon = match($l->kategori) { 'Organik'=>'🌿','Anorganik'=>'♻️','Sampah Sungai'=>'🌊',default=>'🗑️' };
            $iconBg = match($l->kategori) { 'Organik'=>'#f0fdf4','Anorganik'=>'#eff6ff','Sampah Sungai'=>'#e0f2fe',default=>'#f8fafc' };
            $badgeClass = match($l->status) {'Pending'=>'pending','Diproses'=>'diproses','Dijemput'=>'dijemput','Selesai'=>'selesai','Ditolak'=>'ditolak',default=>'pending'};
        @endphp
        <a href="{{ route('masyarakat.laporan.show', $l->id_laporan) }}" class="laporan-card">
            <div class="laporan-icon" style="background:{{ $iconBg }}">{{ $icon }}</div>
            <div class="laporan-info">
                <div class="laporan-kategori">{{ $l->kategori }}</div>
                <div class="laporan-date">{{ $l->tanggal_lapor?->diffForHumans() ?? '-' }}</div>
            </div>
            <span class="badge badge-{{ $badgeClass }}">{{ $l->status }}</span>
        </a>
        @empty
        <div class="empty">
            <span class="empty-emoji">📭</span>
            <div class="empty-title">Belum ada laporan</div>
        </div>
        @endforelse
    </div>

    <!-- Bottom Nav -->
    <nav class="bottom-nav">
        <button class="nav-btn active">
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
        <button class="nav-btn" onclick="location.href='{{ route('masyarakat.profil') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Profil
        </button>
    </nav>

</body>
</html>
