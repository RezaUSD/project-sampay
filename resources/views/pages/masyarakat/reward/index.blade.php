<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SAMPAY - Katalog Reward</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0} body{font-family:'Inter',sans-serif;background:#f0fdf4;min-height:100vh;padding-bottom:88px} a{text-decoration:none;color:inherit}

        .topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:16px;position:sticky;top:0;z-index:50;box-shadow:0 1px 8px rgba(0,0,0,0.04)}
        .topbar-inner{display:flex;align-items:center;gap:12px;margin-bottom:10px}
        .back-btn{width:38px;height:38px;border-radius:12px;background:#f8fafc;border:1.5px solid #e2e8f0;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0}
        .topbar-title{font-size:17px;font-weight:800;color:#1e293b}
        .poin-bar{background:linear-gradient(135deg,#fef9c3,#fef3c7);border:1px solid #fde68a;border-radius:12px;padding:10px 14px;display:flex;align-items:center;justify-content:space-between}
        .poin-bar-left{font-size:12px;font-weight:700;color:#92400e}
        .poin-bar-right{font-size:18px;font-weight:900;color:#b45309;display:flex;align-items:center;gap:5px}

        .alert{padding:13px 16px;border-radius:14px;font-size:13px;font-weight:600;margin:14px 16px 0;display:flex;align-items:center;gap:8px}
        .alert-success{background:#d1fae5;border:1px solid #6ee7b7;color:#065f46}
        .alert-error{background:#fee2e2;border:1px solid #fca5a5;color:#991b1b}

        .section{padding:16px}
        .section-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:14px}
        .section-title{font-size:13px;font-weight:800;color:#475569;text-transform:uppercase;letter-spacing:0.07em}
        .section-link{font-size:12px;font-weight:700;color:#0284c7}

        .reward-card{background:#fff;border-radius:20px;margin-bottom:12px;border:1px solid #f1f5f9;box-shadow:0 2px 8px rgba(0,0,0,0.04);overflow:hidden}
        .reward-img{width:100%;height:160px;object-fit:cover;background:#f8fafc;display:block}
        .reward-img-placeholder{width:100%;height:120px;background:linear-gradient(135deg,#f1f5f9,#e2e8f0);display:flex;align-items:center;justify-content:center;font-size:48px}
        .reward-body{padding:14px}
        .reward-top{display:flex;align-items:flex-start;justify-content:space-between;gap:8px;margin-bottom:8px}
        .reward-name{font-size:15px;font-weight:800;color:#1e293b}
        .reward-mitra{font-size:11px;font-weight:600;color:#94a3b8;margin-top:2px}
        .poin-chip{display:inline-flex;align-items:center;gap:5px;background:#fef3c7;color:#92400e;padding:5px 12px;border-radius:99px;font-size:13px;font-weight:800;white-space:nowrap;flex-shrink:0}
        .reward-desc{font-size:12px;color:#64748b;line-height:1.5;margin-bottom:12px}
        .redeem-btn{display:flex;align-items:center;justify-content:center;gap:6px;padding:12px;border-radius:12px;font-size:13px;font-weight:700;border:0;cursor:pointer;width:100%;transition:all 0.2s}
        .redeem-btn.can{background:linear-gradient(135deg,#f59e0b,#d97706);color:#fff}
        .redeem-btn.cannot{background:#f1f5f9;color:#94a3b8;cursor:not-allowed}

        /* Empty */
        .empty{background:#fff;border-radius:20px;padding:56px 24px;text-align:center;border:1px solid #f1f5f9}
        .empty-emoji{font-size:52px;display:block;margin-bottom:14px}
        .empty-title{font-size:16px;font-weight:800;color:#334155;margin-bottom:6px}
        .empty-sub{font-size:13px;color:#94a3b8}

        /* Bottom Nav */
        .bottom-nav{position:fixed;bottom:0;left:0;right:0;background:#fff;border-top:1px solid #e2e8f0;display:flex;justify-content:space-around;padding:10px 0 20px;z-index:100;box-shadow:0 -8px 24px rgba(0,0,0,0.06)}
        .nav-btn{display:flex;flex-direction:column;align-items:center;gap:3px;padding:6px 12px;border:0;background:transparent;cursor:pointer;color:#94a3b8;font-size:10px;font-weight:700;border-radius:12px}
        .nav-btn.active{color:#0284c7}
        .nav-btn svg{width:22px;height:22px;stroke-width:2}
    </style>
</head>
<body>

    <div class="topbar">
        <div class="topbar-inner">
            <button class="back-btn" onclick="location.href='{{ route('masyarakat.dashboard') }}'">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#475569" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <div style="display:flex;align-items:center;gap:8px">
                <img src="{{ asset('images/logo/logo-sampay.png') }}" alt="SAMPAY" style="width:28px;height:28px;object-fit:contain;border-radius:7px">
                <div class="topbar-title">Katalog Reward</div>
            </div>
        </div>
        <div class="poin-bar">
            <div class="poin-bar-left">🪙 Saldo Poin Kamu</div>
            <div class="poin-bar-right">
                {{ number_format($user->saldo_poin ?? 0) }} Pts
            </div>
        </div>
    </div>

    @if(session('success'))<div class="alert alert-success">✅ {{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-error">⚠️ {{ session('error') }}</div>@endif

    <div class="section">
        <div class="section-header">
            <div class="section-title">{{ $rewards->count() }} Reward Tersedia</div>
            <a href="{{ route('masyarakat.redeem.riwayat') }}" class="section-link">Riwayat →</a>
        </div>

        @forelse($rewards as $r)
        <div class="reward-card">
            @if($r->foto_reward)
            <img class="reward-img" src="{{ asset('storage/reward/'.$r->foto_reward) }}" alt="{{ $r->nama_reward }}"
                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
            <div class="reward-img-placeholder" style="display:none">🎁</div>
            @else
            <div class="reward-img-placeholder">🎁</div>
            @endif
            <div class="reward-body">
                <div class="reward-top">
                    <div>
                        <div class="reward-name">{{ $r->nama_reward }}</div>
                        <div class="reward-mitra">dari {{ $r->mitra?->nama_mitra ?? 'Mitra SAMPAY' }}</div>
                    </div>
                    <div class="poin-chip">🪙 {{ number_format($r->harga_poin) }}</div>
                </div>
                @if($r->deskripsi_reward)
                <div class="reward-desc">{{ Str::limit($r->deskripsi_reward, 100) }}</div>
                @endif
                @php $bisa = ($user->saldo_poin ?? 0) >= $r->harga_poin; @endphp
                @if($bisa)
                <form action="{{ route('masyarakat.reward.redeem', $r->id_reward_katalog) }}" method="POST"
                      onsubmit="return confirm('Tukar {{ $r->nama_reward }} seharga {{ number_format($r->harga_poin) }} poin?')">
                    @csrf
                    <button type="submit" class="redeem-btn can">🎁 Tukar Sekarang</button>
                </form>
                @else
                <button class="redeem-btn cannot" disabled>Poin Tidak Cukup (butuh {{ number_format($r->harga_poin) }})</button>
                @endif
            </div>
        </div>
        @empty
        <div class="empty">
            <span class="empty-emoji">🎁</span>
            <div class="empty-title">Belum Ada Reward</div>
            <div class="empty-sub">Reward belum tersedia saat ini. Terus kumpulkan poin!</div>
        </div>
        @endforelse
    </div>

    <nav class="bottom-nav">
        <button class="nav-btn" onclick="location.href='{{ route('masyarakat.dashboard') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Beranda
        </button>
        <button class="nav-btn" onclick="location.href='{{ route('masyarakat.laporan.create') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Lapor
        </button>
        <button class="nav-btn" onclick="location.href='{{ route('masyarakat.laporan.index') }}'">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Riwayat
        </button>
        <button class="nav-btn active">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Reward
        </button>
    </nav>
</body>
</html>
