<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>SAMPAY - Lapor Sampah</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        *{box-sizing:border-box;margin:0;padding:0} 
        body{font-family:'Inter',sans-serif;background:#f0fdf4;min-height:100vh;padding-bottom:120px;-webkit-font-smoothing:antialiased} 
        a{text-decoration:none;color:inherit}
        
        .topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:16px;display:flex;align-items:center;gap:12px;position:sticky;top:0;z-index:9999;box-shadow:0 1px 8px rgba(0,0,0,0.04)}
        .back-btn{width:38px;height:38px;border-radius:12px;background:#f8fafc;border:1.5px solid #e2e8f0;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0}
        .topbar-title{font-size:17px;font-weight:800;color:#1e293b}
        
        .section{padding:16px}
        .form-card{background:#fff;border-radius:24px;padding:20px;margin-bottom:16px;border:1px solid #f1f5f9;box-shadow:0 4px 15px rgba(0,0,0,0.03)}
        .card-title{font-size:12px;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:16px;display:flex;align-items:center;gap:6px}
        
        /* Dropzone Foto */
        .foto-drop{position:relative;border-radius:20px;border:2.5px dashed #cbd5e1;background:#f8fafc;overflow:hidden;aspect-ratio:1.5;cursor:pointer;transition:0.3s}
        .foto-drop.has-photo{border-style:solid;border-color:#0284c7;background:#fff}
        .foto-drop input{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;z-index:5}
        .foto-placeholder{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;pointer-events:none}
        #fotoPreview{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:none}

        /* Map UI */
        #map{width:100%; height:250px; border-radius:20px; border:1px solid #e2e8f0; margin-bottom:12px; z-index:1}
        .gps-card{background:#f0f9ff;border:1.5px solid #bae6fd;border-radius:18px;padding:16px;display:flex;align-items:center;gap:15px}
        .gps-icon{width:42px;height:42px;border-radius:12px;background:#0284c7;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
        .gps-label{font-size:11px;font-weight:700;color:#0369a1;margin-bottom:2px}
        .gps-value{font-size:13px;font-weight:700;color:#1e293b}
        .btn-gps{background:#fff;color:#0284c7;border:1.5px solid #0284c7;border-radius:14px;padding:14px;font-size:14px;font-weight:700;cursor:pointer;width:100%;margin-top:10px;display:flex;align-items:center;justify-content:center;gap:10px}

        /* Kategori */
        .kategori-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px}
        .kategori-pill{border:1.5px solid #e2e8f0;border-radius:16px;padding:16px 8px;text-align:center;cursor:pointer;font-size:12px;font-weight:700;color:#64748b;background:#fff;position:relative;transition:0.2s}
        .kategori-pill input{position:absolute;opacity:0;width:0;height:0}
        .kategori-pill.selected{background:#eff6ff;border-color:#0284c7;color:#0284c7;box-shadow:0 4px 12px rgba(2,132,199,0.1)}
        .kategori-pill-icon{font-size:24px;display:block;margin-bottom:6px}

        textarea{width:100%;padding:16px;border-radius:16px;border:1.5px solid #e2e8f0;font-size:14px;font-family:inherit;color:#1e293b;background:#fff;outline:none;resize:none;height:120px}
        
        /* Floating Action Bar */
        .action-bar{position:fixed;bottom:0;left:0;right:0;background:#fff;padding:20px;border-top:1px solid #e2e8f0;z-index:9999;box-shadow:0 -5px 20px rgba(0,0,0,0.05)}
        .btn-submit{background:linear-gradient(135deg,#0ea5e9,#0369a1);color:#fff;border:0;border-radius:18px;padding:18px;font-size:16px;font-weight:800;cursor:pointer;width:100%;display:flex;align-items:center;justify-content:center;gap:10px;box-shadow:0 6px 20px rgba(2,132,199,0.4)}
        .btn-submit:active{transform:scale(0.97)}

        .error-msg{font-size:12px;color:#ef4444;font-weight:700;margin-top:8px}
    </style>
</head>
<body>

    <div class="topbar">
        <button class="back-btn" onclick="history.back()">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#475569" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <div style="display:flex;align-items:center;gap:8px">
            <img src="{{ asset('images/logo/logo-sampay.png') }}" alt="SAMPAY" style="width:28px;height:28px;object-fit:contain">
            <div class="topbar-title">Lapor Sampah Baru</div>
        </div>
    </div>

    <div class="section">
        <form action="{{ route('masyarakat.laporan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="latitude" id="lat">
            <input type="hidden" name="longitude" id="lng">

            <!-- Foto -->
            <div class="form-card">
                <div class="card-title">📷 Foto Penemuan Sampah</div>
                <div class="foto-drop" id="fotoDrop">
                    <input type="file" name="foto_sampah_masuk" accept="image/*" capture="environment" onchange="previewFoto(this)" required>
                    <div class="foto-placeholder" id="fotoPlaceholder">
                        <span style="font-size:40px">📸</span>
                        <div style="font-size:14px;font-weight:800;color:#475569">Ambil Foto Sampah</div>
                        <div style="font-size:11px;color:#94a3b8">Wajib dilampirkan</div>
                    </div>
                    <img id="fotoPreview" alt="Laporan">
                </div>
                @error('foto_sampah_masuk')<div class="error-msg">{{ $message }}</div>@enderror
            </div>

            <!-- Map Tracker -->
            <div class="form-card">
                <div class="card-title">📍 Lokasi GPS (Otomatis Sinkron)</div>
                <div id="map"></div>
                <div class="gps-card" id="gpsCard">
                    <div class="gps-icon">📍</div>
                    <div style="flex:1">
                        <div class="gps-label">Koordinat Penjemputan</div>
                        <div class="gps-value" id="gpsText">Mengaktifkan sensor GPS...</div>
                    </div>
                </div>
                <button type="button" class="btn-gps" onclick="getGPS(this)">
                    🎯 Sinkronkan Lokasi Saya
                </button>
            </div>

            <!-- Kategori -->
            <div class="form-card">
                <div class="card-title">🗂️ Kategori Sampah</div>
                <div class="kategori-grid">
                    <label class="kategori-pill selected" onclick="selectKategori(this)">
                        <input type="radio" name="kategori" value="Organik" checked>
                        <span class="kategori-pill-icon">🌿</span>Organik
                    </label>
                    <label class="kategori-pill" onclick="selectKategori(this)">
                        <input type="radio" name="kategori" value="Anorganik">
                        <span class="kategori-pill-icon">♻️</span>Anorganik
                    </label>
                    <label class="kategori-pill" onclick="selectKategori(this)">
                        <input type="radio" name="kategori" value="Sampah Sungai">
                        <span class="kategori-pill-icon">🌊</span>Sungai
                    </label>
                </div>
            </div>

            <!-- Keterangan -->
            <div class="form-card">
                <div class="card-title">💬 Keterangan Tambahan</div>
                <textarea name="keterangan_warga" placeholder="Contoh: Depan warung ijo, tumpukan plastik banyak..."></textarea>
            </div>

            <div class="action-bar">
                <button type="submit" class="btn-submit">
                    Kirim Laporan Sampah 🚀
                </button>
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Init Map
        let map = L.map('map', {zoomControl: false}).setView([-3.314, 114.591], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        L.control.zoom({position: 'topright'}).addTo(map);

        let marker = L.marker([-3.314, 114.591], {draggable: true}).addTo(map);
        let accuracyCircle = L.circle([-3.314, 114.591], {radius: 0, fillColor: '#0ea5e9', fillOpacity: 0.1, color: '#0ea5e9', weight: 1}).addTo(map);

        function updateCoords(lat, lng) {
            document.getElementById('lat').value = lat.toFixed(6);
            document.getElementById('lng').value = lng.toFixed(6);
            document.getElementById('gpsText').textContent = lat.toFixed(6) + ', ' + lng.toFixed(6);
        }

        marker.on('dragend', (e) => updateCoords(e.target.getLatLng().lat, e.target.getLatLng().lng));
        map.on('click', (e) => {
            marker.setLatLng(e.latlng);
            updateCoords(e.latlng.lat, e.latlng.lng);
        });

        let watchId = null;
        function getGPS(btn) {
            if (!navigator.geolocation) return alert('GPS Tidak Didukung');
            if(btn) btn.textContent = '⌛ Mencari Satelit...';

            if(watchId) navigator.geolocation.clearWatch(watchId);

            watchId = navigator.geolocation.watchPosition(
                pos => {
                    const lat = pos.coords.latitude;
                    const lng = pos.coords.longitude;
                    const acc = pos.coords.accuracy;

                    map.setView([lat, lng], 18);
                    marker.setLatLng([lat, lng]);
                    accuracyCircle.setLatLng([lat, lng]);
                    accuracyCircle.setRadius(acc);
                    updateCoords(lat, lng);

                    if(btn) {
                        btn.innerHTML = '✅ Lokasi Sinkron Otomatis';
                        btn.style.background = '#dcfce7';
                        btn.style.color = '#15803d';
                        btn.style.borderColor = '#bbf7d0';
                    }
                },
                err => {
                    console.error(err);
                    if(btn) btn.textContent = '🎯 Deteksi Lokasi Saya';
                },
                { enableHighAccuracy: true, timeout: 15000 }
            );
        }

        function previewFoto(input) {
            if (input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    const prev = document.getElementById('fotoPreview');
                    prev.src = e.target.result;
                    prev.style.display = 'block';
                    document.getElementById('fotoPlaceholder').style.opacity = '0';
                    document.getElementById('fotoDrop').classList.add('has-photo');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function selectKategori(el) {
            document.querySelectorAll('.kategori-pill').forEach(p => p.classList.remove('selected'));
            el.classList.add('selected');
        }

        // Jalankan sinkronisasi otomatis saat halaman dimuat
        window.onload = () => setTimeout(() => getGPS(document.querySelector('.btn-gps')), 800);
    </script>
</body>
</html>
