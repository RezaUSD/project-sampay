<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SAMPAY - Riwayat Laporan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0} body{font-family:'Inter',sans-serif;background:#f0fdf4;min-height:100vh;padding-bottom:88px} a{text-decoration:none;color:inherit}

        .topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:16px;display:flex;align-items:center;gap:12px;position:sticky;top:0;z-index:50;box-shadow:0 1px 8px rgba(0,0,0,0.04)}
        .back-btn{width:38px;height:38px;border-radius:12px;background:#f8fafc;border:1.5px solid #e2e8f0;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0}
        .topbar-title{font-size:17px;font-weight:800;color:#1e293b}

        .alert{padding:13px 16px;border-radius:14px;font-size:13px;font-weight:600;margin:14px 16px 0;display:flex;align-items:center;gap:8px}
        .alert-success{background:#d1fae5;border:1px solid #6ee7b7;color:#065f46}

        .section{padding:16px}
        .laporan-card{background:#fff;border-radius:18px;padding:16px;margin-bottom:10px;border:1px solid #f1f5f9;box-shadow:0 1px 4px rgba(0,0,0,0.04);display:flex;gap:12px;align-items:flex-start}
        .laporan-icon{width:44px;height:44px;border-radius:13px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
        .laporan-body{flex:1;min-width:0}
        .laporan-top{display:flex;align-items:flex-start;justify-content:space-between;gap:8px;margin-bottom:6px}
        .laporan-kategori{font-size:14px;font-weight:700;color:#1e293b}
        .badge{display:inline-flex;font-size:10px;font-weight:700;padding:3px 10px;border-radius:99px;text-transform:uppercase;white-space:nowrap;flex-shrink:0}
        .badge-pending{background:#fef3c7;color:#92400e}
        .badge-diproses{background:#dbeafe;color:#1e40af}
        .badge-dijemput{background:#f3e8ff;color:#6b21a8}
        .badge-selesai{background:#d1fae5;color:#065f46}
        .badge-ditolak{background:#fee2e2;color:#991b1b}
        .laporan-meta{font-size:11px;color:#94a3b8;display:flex;align-items:center;gap:6px;flex-wrap:wrap}
        .laporan-keterangan{font-size:12px;color:#64748b;margin-top:6px;font-style:italic;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .laporan-arrow{color:#94a3b8;flex-shrink:0;margin-top:2px}

        /* Empty */
        .empty{background:#fff;border-radius:20px;padding:56px 24px;text-align:center;border:1px solid #f1f5f9}
        .empty-emoji{font-size:52px;display:block;margin-bottom:16px}
        .empty-title{font-size:16px;font-weight:800;color:#334155;margin-bottom:6px}
        .empty-sub{font-size:13px;color:#94a3b8;line-height:1.6}
        .empty-cta{display:inline-flex;align-items:center;gap:6px;margin-top:16px;padding:12px 24px;background:linear-gradient(135deg,#0ea5e9,#0369a1);color:#fff;border-radius:14px;font-size:14px;font-weight:700}

        /* Bottom Nav */
        .bottom-nav{position:fixed;bottom:0;left:0;right:0;background:#fff;border-top:1px solid #e2e8f0;display:flex;justify-content:space-around;padding:10px 0 20px;z-index:100;box-shadow:0 -8px 24px rgba(0,0,0,0.06)}
        .nav-btn{display:flex;flex-direction:column;align-items:center;gap:3px;padding:6px 12px;border:0;background:transparent;cursor:pointer;color:#94a3b8;font-size:10px;font-weight:700;border-radius:12px}
        .nav-btn.active{color:#0284c7}
        .nav-btn svg{width:22px;height:22px;stroke-width:2}

        .lapor-fab{position:fixed;bottom:88px;right:16px;width:56px;height:56px;border-radius:50%;background:linear-gradient(135deg,#0ea5e9,#0369a1);color:#fff;border:0;font-size:24px;cursor:pointer;box-shadow:0 6px 20px rgba(14,165,233,0.4);display:flex;align-items:center;justify-content:center;z-index:99}
    </style>
</head>
<body>

    <div class="topbar">
        <button class="back-btn" onclick="location.href='{{ route('masyarakat.dashboard') }}'">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#475569" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <div style="display:flex;align-items:center;gap:8px">
            <img src="{{ asset('images/logo/logo-sampay.png') }}" alt="SAMPAY" style="width:28px;height:28px;object-fit:contain;border-radius:7px">
            <div class="topbar-title">Riwayat Laporan</div>
        </div>
    </div>

    @if(session('success'))<div class="alert alert-success">✅ {{ session('success') }}</div>@endif

    <div class="section">
        @forelse($laporan as $l)
        @php
            $icon  = match($l->kategori){ 'Organik'=>'🌿','Anorganik'=>'♻️','Sampah Sungai'=>'🌊',default=>'🗑️' };
            $iconBg= match($l->kategori){ 'Organik'=>'#f0fdf4','Anorganik'=>'#eff6ff','Sampah Sungai'=>'#e0f2fe',default=>'#f8fafc' };
            $bc    = match($l->status){'Pending'=>'pending','Diproses'=>'diproses','Dijemput'=>'dijemput','Selesai'=>'selesai','Ditolak'=>'ditolak',default=>'pending'};
        @endphp
        <a href="{{ route('masyarakat.laporan.show', $l->id_laporan) }}" class="laporan-card">
            <div class="laporan-icon" style="background:{{ $iconBg }}">{{ $icon }}</div>
            <div class="laporan-body">
                <div class="laporan-top">
                    <div class="laporan-kategori">{{ $l->kategori }}</div>
                    <span class="badge badge-{{ $bc }}">{{ $l->status }}</span>
                </div>
                <div class="laporan-meta">
                    <span>📅 {{ $l->tanggal_lapor?->format('d M Y') ?? '-' }}</span>
                    <span>·</span>
                    <span>#{{ $l->id_laporan }}</span>
                </div>
                @if($l->keterangan_warga)
                <div class="laporan-keterangan">"{{ $l->keterangan_warga }}"</div>
                @endif
            </div>
            <div class="laporan-arrow">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6"/></svg>
            </div>
        </a>
        @empty
        <div class="empty">
            <span class="empty-emoji">📭</span>
            <div class="empty-title">Belum Ada Laporan</div>
            <div class="empty-sub">Kamu belum pernah melaporkan sampah. Mulai berkontribusi dan kumpulkan poin!</div>
            <a href="{{ route('masyarakat.laporan.create') }}" class="empty-cta">📍 Buat Laporan Pertama</a>
        </div>
        @endforelse

        {{ $laporan->links() }}
    </div>

    <!-- FAB Lapor -->
    <button class="lapor-fab" onclick="location.href='{{ route('masyarakat.laporan.create') }}'" title="Lapor Sampah Baru">+</button>

    <nav class="bottom-nav">
        <button class="nav-btn" onclick="location.href='{{ route('masyarakat.dashboard') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Beranda
        </button>
        <button class="nav-btn" onclick="location.href='{{ route('masyarakat.laporan.create') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Lapor
        </button>
        <button class="nav-btn active">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Riwayat
        </button>
        <button class="nav-btn" onclick="location.href='{{ route('masyarakat.reward.index') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Reward
        </button>
    </nav>
</body>
</html>
