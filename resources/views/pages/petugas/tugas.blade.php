<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SAMPAY - {{ $tab === 'baru' ? 'Tugas Tersedia' : 'Tugas Aktif Saya' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0} body{font-family:'Inter',sans-serif;background:#f0fdf4;min-height:100vh;padding-bottom:88px} a{text-decoration:none;color:inherit}

        /* Topbar */
        .topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:16px;position:sticky;top:0;z-index:50;box-shadow:0 1px 8px rgba(0,0,0,0.04)}
        .topbar-inner{display:flex;align-items:center;gap:12px;margin-bottom:14px}
        .back-btn{width:38px;height:38px;border-radius:12px;background:#f8fafc;border:1.5px solid #e2e8f0;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0}
        .topbar-title{font-size:18px;font-weight:800;color:#1e293b}

        /* Tabs */
        .tabs{display:flex;gap:0;background:#f8fafc;border-radius:14px;padding:4px}
        .tab{flex:1;padding:9px 12px;text-align:center;font-size:13px;font-weight:700;color:#94a3b8;border-radius:11px;cursor:pointer;transition:all 0.2s;text-decoration:none;display:block}
        .tab.active{background:#fff;color:#059669;box-shadow:0 1px 6px rgba(0,0,0,0.08)}

        /* Cards */
        .section{padding:16px}
        .card{background:#fff;border-radius:20px;padding:16px;margin-bottom:12px;border:1px solid #f1f5f9;box-shadow:0 1px 6px rgba(0,0,0,0.04)}
        .card-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:10px}
        .card-user{display:flex;align-items:center;gap:10px}
        .card-avatar{width:40px;height:40px;border-radius:12px;background:linear-gradient(135deg,#d1fae5,#a7f3d0);display:flex;align-items:center;justify-content:center;font-size:17px;font-weight:800;color:#065f46;flex-shrink:0}
        .card-username{font-size:14px;font-weight:700;color:#1e293b}
        .card-email{font-size:11px;color:#94a3b8;margin-top:1px}
        .badge{display:inline-flex;align-items:center;font-size:10px;font-weight:700;padding:4px 10px;border-radius:99px;text-transform:uppercase;white-space:nowrap}
        .badge-pending{background:#fef3c7;color:#92400e}
        .badge-diproses{background:#dbeafe;color:#1e40af}
        .badge-dijemput{background:#f3e8ff;color:#6b21a8}
        .badge-selesai{background:#d1fae5;color:#065f46}
        .card-meta{display:flex;align-items:center;flex-wrap:wrap;gap:8px;margin-bottom:10px}
        .meta-chip{display:inline-flex;align-items:center;gap:5px;font-size:12px;color:#64748b;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:4px 10px;font-weight:500}
        .card-keterangan{font-size:12px;color:#64748b;background:#f8fafc;border-left:3px solid #059669;padding:10px 12px;border-radius:0 10px 10px 0;line-height:1.5;margin:10px 0;font-style:italic}
        .card-actions{display:flex;gap:8px;margin-top:12px}
        .btn{display:inline-flex;align-items:center;justify-content:center;gap:6px;padding:11px 16px;border-radius:12px;font-size:13px;font-weight:700;border:0;cursor:pointer;transition:all 0.2s;text-decoration:none;flex:1}
        .btn-green{background:linear-gradient(135deg,#059669,#047857);color:#fff}
        .btn-map{background:#eff6ff;color:#2563eb;border:1.5px solid #bfdbfe;flex:0;padding:11px 14px}

        /* Empty */
        .empty{background:#fff;border-radius:20px;padding:56px 24px;text-align:center;border:1px solid #f1f5f9}
        .empty-emoji{font-size:52px;display:block;margin-bottom:16px}
        .empty-title{font-size:16px;font-weight:800;color:#334155;margin-bottom:6px}
        .empty-sub{font-size:13px;color:#94a3b8;line-height:1.6}
        .empty-link{display:inline-flex;align-items:center;gap:6px;margin-top:16px;padding:10px 20px;background:linear-gradient(135deg,#059669,#047857);color:#fff;border-radius:12px;font-size:13px;font-weight:700}

        /* Bottom Nav */
        .bottom-nav{position:fixed;bottom:0;left:0;right:0;background:#fff;border-top:1px solid #e2e8f0;display:flex;justify-content:space-around;padding:10px 0 20px;z-index:100;box-shadow:0 -8px 24px rgba(0,0,0,0.06)}
        .nav-btn{display:flex;flex-direction:column;align-items:center;gap:3px;padding:6px 12px;border:0;background:transparent;cursor:pointer;color:#94a3b8;font-size:10px;font-weight:700;border-radius:12px}
        .nav-btn.active{color:#059669}
        .nav-btn svg{width:22px;height:22px;stroke-width:2}

        /* Pagination */
        .pagination{padding:8px 0 4px;display:flex;justify-content:center}
    </style>
</head>
<body>

    <!-- Topbar -->
    <div class="topbar">
        <div class="topbar-inner">
            <button class="back-btn" onclick="location.href='{{ route('petugas.dashboard') }}'">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#475569" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <div style="display:flex;align-items:center;gap:8px;">
                <img src="{{ asset('images/logo/logo-sampay.png') }}" alt="SAMPAY" style="width:28px;height:28px;object-fit:contain;border-radius:7px;">
                <div class="topbar-title">Daftar Tugas</div>
            </div>
        </div>
        <div class="tabs">
            <a href="{{ route('petugas.tugas.index') }}?tab=aktif" class="tab {{ $tab === 'aktif' ? 'active' : '' }}">🚛 Tugas Saya</a>
            <a href="{{ route('petugas.tugas.index') }}?tab=baru" class="tab {{ $tab === 'baru' ? 'active' : '' }}">📋 Tersedia</a>
        </div>
    </div>

    <div class="section">
        @forelse($tugas as $t)
        <div class="card">
            <div class="card-header">
                <div class="card-user">
                    <div class="card-avatar">{{ substr($t->user?->nama_lengkap ?? 'U', 0, 1) }}</div>
                    <div>
                        <div class="card-username">{{ $t->user?->nama_lengkap ?? 'Pengguna' }}</div>
                        <div class="card-email">Laporan #{{ $t->id_laporan }}</div>
                    </div>
                </div>
                @php $bc = match($t->status){'Pending'=>'pending','Diproses'=>'diproses','Dijemput'=>'dijemput','Selesai'=>'selesai',default=>'pending'}; @endphp
                <span class="badge badge-{{ $bc }}">{{ $t->status }}</span>
            </div>

            <div class="card-meta">
                <span class="meta-chip">🗑️ {{ $t->kategori }}</span>
                @if($t->latitude && $t->longitude)
                <span class="meta-chip">📍 {{ number_format($t->latitude,4) }}, {{ number_format($t->longitude,4) }}</span>
                @else
                <span class="meta-chip">📍 Lokasi tidak tersedia</span>
                @endif
            </div>

            @if($t->keterangan_warga)
            <div class="card-keterangan">"{{ $t->keterangan_warga }}"</div>
            @endif

            <div class="card-actions">
                @if($t->latitude && $t->longitude)
                <a href="https://maps.google.com/?q={{ $t->latitude }},{{ $t->longitude }}" target="_blank" class="btn btn-map">🗺️</a>
                @endif
                <a href="{{ route('petugas.tugas.show', $t->id_laporan) }}" class="btn btn-green">Lihat Detail & Aksi</a>
            </div>
        </div>
        @empty
        <div class="empty">
            @if($tab === 'baru')
            <span class="empty-emoji">🎉</span>
            <div class="empty-title">Semua Sudah Tertangani!</div>
            <div class="empty-sub">Tidak ada laporan pending yang menunggu diambil saat ini.</div>
            @else
            <span class="empty-emoji">☕</span>
            <div class="empty-title">Tidak Ada Tugas Aktif</div>
            <div class="empty-sub">Kamu belum mengambil tugas apapun. Cek daftar tugas yang tersedia!</div>
            <a href="{{ route('petugas.tugas.index') }}?tab=baru" class="empty-link">📋 Lihat Tugas Tersedia</a>
            @endif
        </div>
        @endforelse

        <div class="pagination">{{ $tugas->withQueryString()->links() }}</div>
    </div>

    <nav class="bottom-nav">
        <button class="nav-btn" onclick="location.href='{{ route('petugas.dashboard') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Beranda
        </button>
        <button class="nav-btn active" onclick="location.href='{{ route('petugas.tugas.index') }}'">
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
