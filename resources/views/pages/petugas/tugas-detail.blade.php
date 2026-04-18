<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SAMPAY - Detail Tugas #{{ $laporan->id_laporan }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0} body{font-family:'Inter',sans-serif;background:#f0fdf4;min-height:100vh;padding-bottom:100px} a{text-decoration:none;color:inherit}

        /* Topbar */
        .topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:16px;display:flex;align-items:center;gap:12px;position:sticky;top:0;z-index:50;box-shadow:0 1px 8px rgba(0,0,0,0.04)}
        .back-btn{width:38px;height:38px;border-radius:12px;background:#f8fafc;border:1.5px solid #e2e8f0;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0}
        .topbar-info{flex:1;min-width:0}
        .topbar-title{font-size:16px;font-weight:800;color:#1e293b}
        .topbar-sub{font-size:11px;color:#94a3b8;margin-top:1px}

        /* Status Banner */
        .status-banner{display:flex;align-items:center;gap:10px;padding:14px 16px;font-size:13px;font-weight:700}
        .status-banner.pending{background:#fef3c7;color:#92400e}
        .status-banner.diproses{background:#dbeafe;color:#1e40af}
        .status-banner.dijemput{background:#f3e8ff;color:#6b21a8}
        .status-banner.selesai{background:#d1fae5;color:#065f46}
        .status-banner.ditolak{background:#fee2e2;color:#991b1b}
        .status-dot{width:8px;height:8px;border-radius:50%;background:currentColor}

        /* Alerts */
        .alert{padding:13px 16px;border-radius:14px;font-size:13px;font-weight:600;margin:14px 16px 0;display:flex;align-items:center;gap:8px}
        .alert-success{background:#d1fae5;border:1px solid #6ee7b7;color:#065f46}
        .alert-error{background:#fee2e2;border:1px solid #fca5a5;color:#991b1b}

        /* Cards */
        .section{padding:16px}
        .info-card{background:#fff;border-radius:20px;padding:18px;margin-bottom:14px;border:1px solid #f1f5f9;box-shadow:0 1px 6px rgba(0,0,0,0.04)}
        .card-title{font-size:12px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:0.07em;margin-bottom:14px;display:flex;align-items:center;gap:6px}

        .info-row{display:flex;align-items:flex-start;gap:12px;margin-bottom:12px;padding-bottom:12px;border-bottom:1px solid #f8fafc}
        .info-row:last-child{margin-bottom:0;padding-bottom:0;border-bottom:0}
        .info-icon{width:36px;height:36px;border-radius:10px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0}
        .info-label{font-size:11px;font-weight:700;color:#94a3b8;margin-bottom:3px;text-transform:uppercase;letter-spacing:0.04em}
        .info-value{font-size:14px;font-weight:600;color:#1e293b;line-height:1.4}
        .info-value.green{color:#059669}

        /* Foto grid */
        .foto-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px}
        .foto-box{border-radius:14px;overflow:hidden;background:#f8fafc;border:1px solid #e2e8f0;aspect-ratio:1;position:relative}
        .foto-box img{width:100%;height:100%;object-fit:cover;display:block}
        .foto-box-empty{width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px;color:#94a3b8;font-size:11px;font-weight:600;padding:16px;text-align:center}
        .foto-box-empty span{font-size:28px}
        .foto-label{font-size:11px;font-weight:700;color:#475569;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.04em}

        /* Map */
        .map-wrap{border-radius:14px;overflow:hidden;border:1px solid #e2e8f0;height:200px;margin-bottom:10px}
        .map-wrap iframe{width:100%;height:100%;border:0;display:block}
        .map-link{display:flex;align-items:center;justify-content:center;gap:8px;background:#eff6ff;border:1.5px solid #bfdbfe;color:#2563eb;padding:12px;border-radius:12px;font-size:13px;font-weight:700}

        /* Upload form */
        .upload-card{background:#fff;border-radius:20px;padding:18px;margin-bottom:14px;border:2px dashed #e2e8f0}
        .upload-card.has-photo{border-style:solid;border-color:#6ee7b7}
        .upload-title{font-size:14px;font-weight:800;color:#1e293b;margin-bottom:14px;display:flex;align-items:center;gap:8px}
        .drop-zone{background:#f8fafc;border-radius:14px;padding:28px 20px;text-align:center;cursor:pointer;border:1.5px dashed #cbd5e1;transition:border-color 0.2s}
        .drop-zone.active{border-color:#059669;background:#f0fdf4}
        .drop-zone-icon{font-size:36px;margin-bottom:8px;display:block}
        .drop-zone-text{font-size:13px;font-weight:700;color:#475569;margin-bottom:4px}
        .drop-zone-sub{font-size:11px;color:#94a3b8}
        .drop-zone input{display:none}
        .preview-img{width:100%;border-radius:12px;margin-top:12px;display:none;border:2px solid #6ee7b7}
        .error-msg{font-size:12px;color:#dc2626;font-weight:600;margin-top:6px}

        /* Buttons */
        .btn{display:flex;align-items:center;justify-content:center;gap:8px;padding:14px;border-radius:14px;font-size:14px;font-weight:700;border:0;cursor:pointer;transition:all 0.2s;width:100%;margin-top:10px}
        .btn-green{background:linear-gradient(135deg,#059669,#047857);color:#fff}
        .btn-green:disabled{opacity:0.4;cursor:not-allowed}
        .btn-orange{background:linear-gradient(135deg,#f59e0b,#d97706);color:#fff}

        /* Fixed bottom */
        .fixed-cta{position:fixed;bottom:0;left:0;right:0;background:#fff;border-top:1px solid #e2e8f0;padding:16px;box-shadow:0 -8px 24px rgba(0,0,0,0.06)}
    </style>
</head>
<body>

    <!-- Topbar -->
    <div class="topbar">
        <button class="back-btn" onclick="history.back()">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#475569" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <div style="display:flex;align-items:center;gap:8px;flex:1;">
            <img src="{{ asset('images/logo/logo-sampay.png') }}" alt="SAMPAY" style="width:28px;height:28px;object-fit:contain;border-radius:7px;">
            <div class="topbar-info">
                <div class="topbar-title">Detail Tugas</div>
                <div class="topbar-sub">Laporan #{{ $laporan->id_laporan }}</div>
            </div>
        </div>
    </div>

    @php
        $statusClass = strtolower($laporan->status);
        $statusIcon = match($laporan->status) {
            'Pending' => '⏳', 'Diproses' => '🚛', 'Dijemput' => '📦',
            'Selesai' => '✅', 'Ditolak' => '❌', default => '●'
        };
        $isMine = $laporan->id_petugas == Auth::user()->id_user;
    @endphp

    <div class="status-banner {{ $statusClass }}">
        <span class="status-dot"></span>
        {{ $statusIcon }} {{ $laporan->status }} — {{ $isMine && in_array($laporan->status,['Diproses','Dijemput']) ? 'Tugas Anda' : ($laporan->status === 'Pending' ? 'Menunggu Diambil' : 'Selesai') }}
    </div>

    @if(session('success'))<div class="alert alert-success">✅ {{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-error">⚠️ {{ session('error') }}</div>@endif

    <div class="section">

        <!-- Info Pelapor -->
        <div class="info-card">
            <div class="card-title">👤 Info Pelapor</div>
            <div class="info-row">
                <div class="info-icon">🙍</div>
                <div><div class="info-label">Nama Warga</div><div class="info-value">{{ $laporan->user?->nama_lengkap ?? '-' }}</div></div>
            </div>
            <div class="info-row">
                <div class="info-icon">📂</div>
                <div><div class="info-label">Kategori Sampah</div><div class="info-value green">{{ $laporan->kategori }}</div></div>
            </div>
            @if($laporan->keterangan_warga)
            <div class="info-row">
                <div class="info-icon">💬</div>
                <div><div class="info-label">Keterangan</div><div class="info-value" style="font-style:italic;color:#475569">"{{ $laporan->keterangan_warga }}"</div></div>
            </div>
            @endif
            <div class="info-row">
                <div class="info-icon">📊</div>
                <div><div class="info-label">Status Saat Ini</div><div class="info-value">{{ $laporan->status }}</div></div>
            </div>
        </div>

        <!-- Foto -->
        <div class="info-card">
            <div class="card-title">📷 Dokumentasi Foto</div>
            <div class="foto-grid">
                <div>
                    <div class="foto-label">Foto Laporan Warga</div>
                    <div class="foto-box">
                        @if($laporan->foto_sampah_masuk)
                        <img src="{{ asset('storage/sampah/'.$laporan->foto_sampah_masuk) }}"
                             onerror="this.parentElement.querySelector('.foto-box-empty') && this.parentElement.querySelector('.foto-box-empty').style.display='flex'; this.style.display='none'"
                             alt="Foto laporan">
                        @else
                        <div class="foto-box-empty"><span>📷</span>Belum ada foto</div>
                        @endif
                    </div>
                </div>
                <div>
                    <div class="foto-label">Foto Bukti Jemput</div>
                    <div class="foto-box">
                        @if($laporan->foto_sampah_selesai)
                        <img src="{{ asset('storage/bukti/'.$laporan->foto_sampah_selesai) }}"
                             onerror="this.parentElement.querySelector('.foto-box-empty') && this.parentElement.querySelector('.foto-box-empty').style.display='flex'; this.style.display='none'"
                             alt="Foto bukti">
                        @else
                        <div class="foto-box-empty"><span>📤</span>Belum diupload</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Lokasi -->
        @if($laporan->latitude && $laporan->longitude)
        <div class="info-card">
            <div class="card-title">📍 Lokasi Penjemputan</div>
            <div class="map-wrap">
                <iframe src="https://maps.google.com/maps?q={{ $laporan->latitude }},{{ $laporan->longitude }}&z=16&output=embed" allowfullscreen loading="lazy"></iframe>
            </div>
            <a href="https://maps.google.com/?q={{ $laporan->latitude }},{{ $laporan->longitude }}" target="_blank" class="map-link">
                <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 0 1-2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z"/><circle cx="12" cy="11" r="3"/></svg>
                Buka di Google Maps untuk Navigasi
            </a>
        </div>
        @else
        <div class="info-card">
            <div class="card-title">📍 Lokasi Penjemputan</div>
            <div style="text-align:center;padding:24px;color:#94a3b8;font-size:13px;">📭 Data lokasi tidak tersedia</div>
        </div>
        @endif

        <!-- Upload Bukti (hanya jika status Diproses dan tugas milik petugas ini) -->
        @if($laporan->status === 'Diproses' && $isMine)
        <div class="upload-card" id="uploadCard">
            <div class="upload-title">📸 Upload Bukti Penjemputan</div>
            <form action="{{ route('petugas.tugas.selesai', $laporan->id_laporan) }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                <div class="drop-zone" id="dropZone" onclick="document.getElementById('fotoInput').click()">
                    <span class="drop-zone-icon">📷</span>
                    <div class="drop-zone-text">Ketuk untuk Ambil/Pilih Foto</div>
                    <div class="drop-zone-sub">Foto dari kamera atau galeri · Maks 5MB</div>
                    <input type="file" id="fotoInput" name="foto_sampah_selesai" accept="image/*" capture="environment" onchange="handleFoto(this)">
                </div>
                <img id="previewImg" class="preview-img" alt="Preview foto bukti">
                @error('foto_sampah_selesai')<div class="error-msg">{{ $message }}</div>@enderror
                <button type="submit" class="btn btn-green" id="submitBtn" disabled>
                    ✅ Tandai Selesai & Upload Bukti
                </button>
            </form>
        </div>
        @endif

        @if($laporan->status === 'Dijemput' && $isMine)
        <div class="info-card" style="background:#f0fdf4;border-color:#bbf7d0;">
            <div style="text-align:center;padding:8px">
                <div style="font-size:32px;margin-bottom:8px">📦</div>
                <div style="font-size:15px;font-weight:800;color:#065f46;margin-bottom:4px">Bukti Sudah Diupload!</div>
                <div style="font-size:13px;color:#16a34a">Menunggu verifikasi dari Admin Pusat.</div>
            </div>
        </div>
        @endif
    </div>

    <!-- Fixed CTA: Ambil Tugas (hanya jika Pending dan belum ada yang ambil) -->
    @if($laporan->status === 'Pending' && !$laporan->id_petugas)
    <div class="fixed-cta">
        <form action="{{ route('petugas.tugas.ambil', $laporan->id_laporan) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-orange">🚛 Ambil Tugas Ini Sekarang</button>
        </form>
    </div>
    @endif

    <script>
    function handleFoto(input) {
        if (!input.files[0]) return;
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('previewImg');
            img.src = e.target.result;
            img.style.display = 'block';
            document.getElementById('submitBtn').disabled = false;
            document.getElementById('dropZone').classList.add('active');
            document.getElementById('uploadCard').classList.add('has-photo');
        };
        reader.readAsDataURL(input.files[0]);
    }
    </script>
</body>
</html>
