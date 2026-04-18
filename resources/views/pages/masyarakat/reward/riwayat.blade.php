<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SAMPAY - Riwayat Penukaran</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0} body{font-family:'Inter',sans-serif;background:#f0fdf4;min-height:100vh;padding-bottom:32px} a{text-decoration:none;color:inherit}

        .topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:16px;display:flex;align-items:center;gap:12px;position:sticky;top:0;z-index:50;box-shadow:0 1px 8px rgba(0,0,0,0.04)}
        .back-btn{width:38px;height:38px;border-radius:12px;background:#f8fafc;border:1.5px solid #e2e8f0;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0}
        .topbar-title{font-size:17px;font-weight:800;color:#1e293b}

        .section{padding:16px}
        .card{background:#fff;border-radius:18px;padding:14px;margin-bottom:10px;border:1px solid #f1f5f9;box-shadow:0 1px 4px rgba(0,0,0,0.04);display:flex;gap:12px;align-items:flex-start}
        .card-icon{width:44px;height:44px;border-radius:13px;background:#fef9c3;display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0}
        .card-body{flex:1;min-width:0}
        .card-name{font-size:14px;font-weight:700;color:#1e293b;margin-bottom:4px}
        .card-meta{font-size:12px;color:#64748b;display:flex;align-items:center;gap:6px;flex-wrap:wrap}
        .badge{display:inline-flex;font-size:10px;font-weight:700;padding:3px 10px;border-radius:99px;text-transform:uppercase}
        .badge-pending{background:#fef3c7;color:#92400e}
        .badge-disetujui{background:#d1fae5;color:#065f46}
        .badge-ditolak{background:#fee2e2;color:#991b1b}
        .poin-chip{font-weight:800;color:#b45309}

        .empty{background:#fff;border-radius:20px;padding:56px 24px;text-align:center;border:1px solid #f1f5f9}
        .empty-emoji{font-size:52px;display:block;margin-bottom:14px}
        .empty-title{font-size:16px;font-weight:800;color:#334155;margin-bottom:6px}
        .empty-sub{font-size:13px;color:#94a3b8}
    </style>
</head>
<body>

    <div class="topbar">
        <button class="back-btn" onclick="location.href='{{ route('masyarakat.reward.index') }}'">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#475569" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <div style="display:flex;align-items:center;gap:8px">
            <img src="{{ asset('images/logo/logo-sampay.png') }}" alt="SAMPAY" style="width:28px;height:28px;object-fit:contain;border-radius:7px">
            <div class="topbar-title">Riwayat Penukaran</div>
        </div>
    </div>

    <div class="section">
        @forelse($riwayat as $r)
        @php
            $bc = match($r->status_redeem){'Pending'=>'pending','Disetujui'=>'disetujui','Ditolak'=>'ditolak',default=>'pending'};
        @endphp
        <div class="card">
            <div class="card-icon">🎁</div>
            <div class="card-body">
                <div class="card-name">{{ $r->rewardKatalog?->nama_reward ?? 'Reward' }}</div>
                <div class="card-meta">
                    <span class="poin-chip">🪙 {{ number_format($r->jumlah_poin) }} Pts</span>
                    <span>·</span>
                    <span>{{ $r->rewardKatalog?->mitra?->nama_mitra ?? '-' }}</span>
                </div>
                <div style="margin-top:6px;display:flex;align-items:center;gap:8px">
                    <span class="badge badge-{{ $bc }}">{{ $r->status_redeem }}</span>
                </div>
            </div>
        </div>
        @empty
        <div class="empty">
            <span class="empty-emoji">🎫</span>
            <div class="empty-title">Belum Ada Penukaran</div>
            <div class="empty-sub">Kamu belum pernah menukar poin. Kumpulkan poin dan tukar reward menarik!</div>
        </div>
        @endforelse

        {{ $riwayat->links() }}
    </div>

</body>
</html>
