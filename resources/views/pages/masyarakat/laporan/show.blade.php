<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SAMPAY - Detail Laporan #{{ $laporan->id_laporan }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0} body{font-family:'Inter',sans-serif;background:#f0fdf4;min-height:100vh;padding-bottom:32px} a{text-decoration:none;color:inherit}

        .topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:16px;display:flex;align-items:center;gap:12px;position:sticky;top:0;z-index:50;box-shadow:0 1px 8px rgba(0,0,0,0.04)}
        .back-btn{width:38px;height:38px;border-radius:12px;background:#f8fafc;border:1.5px solid #e2e8f0;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0}
        .topbar-info{flex:1}
        .topbar-title{font-size:16px;font-weight:800;color:#1e293b}
        .topbar-sub{font-size:11px;color:#94a3b8;margin-top:1px}

        /* Status banner */
        .status-banner{padding:14px 16px;font-size:13px;font-weight:700;display:flex;align-items:center;gap:10px}
        .status-banner.pending{background:#fef3c7;color:#92400e}
        .status-banner.diproses{background:#dbeafe;color:#1e40af}
        .status-banner.dijemput{background:#f3e8ff;color:#6b21a8}
        .status-banner.selesai{background:#d1fae5;color:#065f46}
        .status-banner.ditolak{background:#fee2e2;color:#991b1b}
        .status-dot{width:8px;height:8px;border-radius:50%;background:currentColor;flex-shrink:0}

        .section{padding:16px}
        .info-card{background:#fff;border-radius:20px;padding:18px;margin-bottom:14px;border:1px solid #f1f5f9;box-shadow:0 1px 6px rgba(0,0,0,0.04)}
        .card-title{font-size:12px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:0.07em;margin-bottom:14px}
        .info-row{display:flex;align-items:flex-start;gap:12px;padding:10px 0;border-bottom:1px solid #f8fafc}
        .info-row:last-child{border-bottom:0;padding-bottom:0}
        .info-row:first-of-type{padding-top:0}
        .info-icon{width:36px;height:36px;border-radius:10px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0}
        .info-label{font-size:11px;font-weight:700;color:#94a3b8;margin-bottom:3px;text-transform:uppercase;letter-spacing:0.04em}
        .info-value{font-size:14px;font-weight:600;color:#1e293b}

        /* Foto */
        .foto-box{border-radius:14px;overflow:hidden;border:1px solid #e2e8f0;max-height:260px}
        .foto-box img{width:100%;height:100%;object-fit:cover;display:block}
        .foto-label{font-size:11px;font-weight:700;color:#475569;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.04em}
        .foto-empty{background:#f8fafc;border-radius:14px;padding:28px;text-align:center;color:#94a3b8;font-size:12px;border:1px dashed #e2e8f0}

        /* Timeline */
        .timeline{position:relative;padding-left:24px}
        .timeline::before{content:'';position:absolute;left:7px;top:4px;bottom:4px;width:2px;background:#e2e8f0;border-radius:2px}
        .timeline-item{position:relative;margin-bottom:16px}
        .timeline-item:last-child{margin-bottom:0}
        .timeline-dot{position:absolute;left:-24px;top:3px;width:16px;height:16px;border-radius:50%;border:2px solid #e2e8f0;background:#fff;display:flex;align-items:center;justify-content:center}
        .timeline-dot.done{background:#0284c7;border-color:#0284c7}
        .timeline-dot.current{background:#f59e0b;border-color:#f59e0b}
        .timeline-dot.rejected{background:#dc2626;border-color:#dc2626}
        .timeline-dot svg{width:8px;height:8px;stroke:#fff}
        .timeline-label{font-size:13px;font-weight:700;color:#1e293b}
        .timeline-sub{font-size:11px;color:#94a3b8;margin-top:2px}

        /* Map */
        .map-wrap{border-radius:14px;overflow:hidden;border:1px solid #e2e8f0;height:180px;margin-bottom:8px}
        .map-wrap iframe{width:100%;height:100%;border:0;display:block}
        .map-link{display:flex;align-items:center;justify-content:center;gap:8px;background:#eff6ff;border:1.5px solid #bfdbfe;color:#2563eb;padding:12px;border-radius:12px;font-size:13px;font-weight:700}
    </style>
</head>
<body>

    <div class="topbar">
        <button class="back-btn" onclick="location.href='{{ route('masyarakat.laporan.index') }}'">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#475569" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <div style="display:flex;align-items:center;gap:8px;flex:1">
            <img src="{{ asset('images/logo/logo-sampay.png') }}" alt="SAMPAY" style="width:28px;height:28px;object-fit:contain;border-radius:7px">
            <div class="topbar-info">
                <div class="topbar-title">Detail Laporan</div>
                <div class="topbar-sub">#{{ $laporan->id_laporan }}</div>
            </div>
        </div>
    </div>

    @php
        $sc = strtolower($laporan->status);
        $si = match($laporan->status){'Pending'=>'⏳','Diproses'=>'🚛','Dijemput'=>'📦','Selesai'=>'✅','Ditolak'=>'❌',default=>'●'};
    @endphp
    <div class="status-banner {{ $sc }}">
        <span class="status-dot"></span>
        {{ $si }} Status: {{ $laporan->status }}
    </div>

    <div class="section">

        <!-- Info Laporan -->
        <div class="info-card">
            <div class="card-title">📋 Informasi Laporan</div>
            <div class="info-row">
                <div class="info-icon">📂</div>
                <div><div class="info-label">Kategori</div><div class="info-value">{{ $laporan->kategori }}</div></div>
            </div>
            <div class="info-row">
                <div class="info-icon">📅</div>
                <div><div class="info-label">Tanggal Lapor</div><div class="info-value">{{ $laporan->tanggal_lapor?->format('d M Y, H:i') ?? '-' }}</div></div>
            </div>
            @if($laporan->keterangan_warga)
            <div class="info-row">
                <div class="info-icon">💬</div>
                <div><div class="info-label">Keterangan</div><div class="info-value" style="font-style:italic">"{{ $laporan->keterangan_warga }}"</div></div>
            </div>
            @endif
            @if($laporan->petugas)
            <div class="info-row">
                <div class="info-icon">👷</div>
                <div><div class="info-label">Petugas</div><div class="info-value">{{ $laporan->petugas->nama_lengkap }}</div></div>
            </div>
            @endif
        </div>

        <!-- Tracking Timeline -->
        <div class="info-card">
            <div class="card-title">📍 Tracking Status</div>
            <div class="timeline">
                @php
                    $steps = [
                        ['Laporan Dikirim','Laporan kamu sudah diterima sistem','Pending'],
                        ['Diproses Petugas','Petugas sedang menuju lokasi kamu','Diproses'],
                        ['Sampah Dijemput','Petugas sudah mengambil sampah','Dijemput'],
                        ['Selesai & Poin Diberikan','Admin sudah verifikasi, poin masuk ke akun','Selesai'],
                    ];
                    $currentIdx = match($laporan->status) {'Pending'=>0,'Diproses'=>1,'Dijemput'=>2,'Selesai'=>3,'Ditolak'=>99,default=>0};
                @endphp
                @if($laporan->status === 'Ditolak')
                <div class="timeline-item">
                    <div class="timeline-dot rejected">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <div class="timeline-label">Laporan Ditolak</div>
                    <div class="timeline-sub">Laporan tidak dapat diproses.</div>
                </div>
                @else
                @foreach($steps as $idx => $step)
                <div class="timeline-item">
                    <div class="timeline-dot {{ $idx < $currentIdx ? 'done' : ($idx === $currentIdx ? 'current' : '') }}">
                        @if($idx < $currentIdx)
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        @endif
                    </div>
                    <div class="timeline-label" style="color:{{ $idx <= $currentIdx ? '#1e293b' : '#94a3b8' }}">{{ $step[0] }}</div>
                    <div class="timeline-sub">{{ $idx === $currentIdx ? $step[1] : ($idx < $currentIdx ? '✓ Selesai' : 'Menunggu') }}</div>
                </div>
                @endforeach
                @endif
            </div>
        </div>

        <!-- Foto -->
        <div class="info-card">
            <div class="card-title">📷 Foto Dokumentasi</div>
            <div class="foto-label">Foto Laporan Awal</div>
            @if($laporan->foto_sampah_masuk)
            <div class="foto-box">
                <img src="{{ asset('storage/sampah/'.$laporan->foto_sampah_masuk) }}" alt="Foto laporan">
            </div>
            @else
            <div class="foto-empty">Foto tidak tersedia</div>
            @endif

            @if($laporan->foto_sampah_selesai)
            <div class="foto-label" style="margin-top:14px">Foto Bukti Penjemputan</div>
            <div class="foto-box">
                <img src="{{ asset('storage/bukti/'.$laporan->foto_sampah_selesai) }}" alt="Foto bukti">
            </div>
            @endif
        </div>

        <!-- Lokasi -->
        @if($laporan->latitude && $laporan->longitude)
        <div class="info-card">
            <div class="card-title">📍 Lokasi Laporan</div>
            <div class="map-wrap">
                <iframe src="https://maps.google.com/maps?q={{ $laporan->latitude }},{{ $laporan->longitude }}&z=16&output=embed" allowfullscreen loading="lazy"></iframe>
            </div>
            <a href="https://maps.google.com/?q={{ $laporan->latitude }},{{ $laporan->longitude }}" target="_blank" class="map-link">
                🗺️ Buka di Google Maps
            </a>
        </div>
        @endif

    </div>

</body>
</html>
