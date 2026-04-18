<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SAMPAY - Riwayat Tugas</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Inter',sans-serif;background:#f1f5f9;min-height:100vh;padding-bottom:80px}
        a{text-decoration:none;color:inherit}

        .topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:16px;display:flex;align-items:center;gap:12px;position:sticky;top:0;z-index:50}
        .topbar-back{width:36px;height:36px;border-radius:10px;background:#f8fafc;border:1px solid #e2e8f0;display:flex;align-items:center;justify-content:center;cursor:pointer}
        .topbar-title{font-size:17px;font-weight:800;color:#1e293b}

        .section{padding:16px}
        .card{background:#fff;border-radius:18px;padding:16px;margin-bottom:10px;border:1px solid #f0f4f8;box-shadow:0 1px 4px rgba(0,0,0,0.04);display:flex;gap:14px;align-items:flex-start}
        .card-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
        .card-icon.selesai{background:#d1fae5}
        .card-icon.ditolak{background:#fee2e2}
        .card-icon.dijemput{background:#f3e8ff}
        .card-body{flex:1;min-width:0}
        .card-nama{font-size:14px;font-weight:700;color:#1e293b;margin-bottom:3px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .card-meta{font-size:12px;color:#94a3b8;margin-bottom:6px}
        .card-badge{display:inline-flex;font-size:10px;font-weight:700;padding:2px 10px;border-radius:99px;text-transform:uppercase}
        .badge-selesai{background:#d1fae5;color:#065f46}
        .badge-dijemput{background:#f3e8ff;color:#6b21a8}
        .badge-ditolak{background:#fee2e2;color:#991b1b}
        .card-link{font-size:12px;font-weight:600;color:#059669;margin-top:8px;display:block}

        .empty{background:#fff;border-radius:20px;padding:48px 20px;text-align:center;border:1px solid #f0f4f8}
        .empty-icon{font-size:40px;margin-bottom:12px}
        .empty-title{font-size:15px;font-weight:700;color:#334155;margin-bottom:4px}
        .empty-sub{font-size:13px;color:#94a3b8}

        .bottom-nav{position:fixed;bottom:0;left:0;right:0;background:#fff;border-top:1px solid #e2e8f0;display:flex;justify-content:space-around;padding:8px 0 16px;z-index:100;box-shadow:0 -4px 20px rgba(0,0,0,0.06)}
        .nav-item{display:flex;flex-direction:column;align-items:center;gap:3px;padding:6px 16px;border-radius:12px;border:0;background:transparent;cursor:pointer;color:#94a3b8;font-size:10px;font-weight:600;transition:color 0.2s}
        .nav-item.active{color:#059669}
        .nav-item svg{width:22px;height:22px}
    </style>
</head>
<body>

    <div class="topbar">
        <button class="topbar-back" onclick="location.href='{{ route('petugas.dashboard') }}'">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#475569" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <div class="topbar-title">Riwayat Tugas</div>
    </div>

    <div class="section">
        @forelse($riwayat as $r)
        @php
            $iconClass = match($r->status) {
                'Selesai' => 'selesai',
                'Ditolak' => 'ditolak',
                default   => 'dijemput',
            };
            $icon = match($r->status) {
                'Selesai' => '✅',
                'Ditolak' => '❌',
                default   => '📦',
            };
            $badgeClass = 'badge-'.strtolower($r->status);
        @endphp
        <div class="card">
            <div class="card-icon {{ $iconClass }}">{{ $icon }}</div>
            <div class="card-body">
                <div class="card-nama">{{ $r->user?->nama_lengkap ?? '-' }}</div>
                <div class="card-meta">{{ $r->kategori }} · #{{ $r->id_laporan }}</div>
                <span class="card-badge {{ $badgeClass }}">{{ $r->status }}</span>
                <a href="{{ route('petugas.tugas.show', $r->id_laporan) }}" class="card-link">Lihat Detail →</a>
            </div>
        </div>
        @empty
        <div class="empty">
            <div class="empty-icon">📭</div>
            <div class="empty-title">Belum Ada Riwayat</div>
            <div class="empty-sub">Tugas yang sudah diselesaikan atau ditolak akan muncul di sini.</div>
        </div>
        @endforelse

        {{ $riwayat->links() }}
    </div>

    <nav class="bottom-nav">
        <button class="nav-item" onclick="location.href='{{ route('petugas.dashboard') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Beranda
        </button>
        <button class="nav-item" onclick="location.href='{{ route('petugas.tugas.index') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Tugas
        </button>
        <button class="nav-item active" onclick="location.href='{{ route('petugas.riwayat') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Riwayat
        </button>
        <button class="nav-item" onclick="location.href='{{ route('petugas.profil') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Profil
        </button>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Keluar
            </button>
        </form>
    </nav>

</body>
</html>
