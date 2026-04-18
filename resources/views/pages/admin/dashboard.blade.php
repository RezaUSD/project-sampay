@extends('layouts.app')

@section('title', 'Dashboard - SAMPAY Admin')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    {{-- Page Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard Overview</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Selamat datang di Sistem Pengelolaan Sampah SAMPAY — Banjarmasin</p>
    </div>

    {{-- Alert/Flash Message --}}
    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800 dark:bg-green-900/20 dark:border-green-800 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    {{-- Widget Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
        {{-- Total Laporan --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Laporan</span>
                <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/20">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.25 5.5A2.25 2.25 0 015.5 3.25h13a2.25 2.25 0 012.25 2.25v13a2.25 2.25 0 01-2.25 2.25h-13A2.25 2.25 0 013.25 18.5v-13zm2.25-.75a.75.75 0 00-.75.75v13c0 .414.336.75.75.75h13a.75.75 0 00.75-.75v-13a.75.75 0 00-.75-.75h-13zM7 8.75A.75.75 0 017.75 8h8.5a.75.75 0 010 1.5h-8.5A.75.75 0 017 8.75zm0 3.25a.75.75 0 01.75-.75h8.5a.75.75 0 010 1.5h-8.5A.75.75 0 017 12zm.75 2.5a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5z" fill="currentColor"/></svg>
                </span>
            </div>
            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($totalLaporan) }}</p>
            <p class="text-xs text-amber-600 dark:text-amber-400 mt-1 font-medium">{{ $laporanPending }} pending verifikasi</p>
        </div>

        {{-- Total User Warga --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Warga Terdaftar</span>
                <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-green-50 dark:bg-green-900/20">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M8 7a4 4 0 118 0A4 4 0 018 7zm-4 12a8 8 0 1116 0H4z" fill="currentColor"/></svg>
                </span>
            </div>
            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($totalUserAktif) }}</p>
            <p class="text-xs text-green-600 dark:text-green-400 mt-1 font-medium">Total warga aktif</p>
        </div>

        {{-- Total Petugas --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Petugas Lapangan</span>
                <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-900/20">
                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M9 3a3 3 0 016 0v1h3a1 1 0 011 1v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a1 1 0 011-1h3V3zm3-1a1 1 0 00-1 1v1h2V3a1 1 0 00-1-1zM6 6v13h12V6H6zm2 3a1 1 0 000 2h8a1 1 0 100-2H8zm0 4a1 1 0 000 2h5a1 1 0 100-2H8z" fill="currentColor"/></svg>
                </span>
            </div>
            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($totalPetugas) }}</p>
            <p class="text-xs text-purple-600 dark:text-purple-400 mt-1 font-medium">Aktif di lapangan</p>
        </div>

        {{-- Total Dana Mitra --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Dana CSR Mitra</span>
                <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-900/20">
                    <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h16a2 2 0 012 2v.5a.5.5 0 01-.5.5H2.5A.5.5 0 012 6.5V6zm0 3.5V18a2 2 0 002 2h16a2 2 0 002-2V9.5H2zM8 13a1 1 0 011-1h6a1 1 0 110 2H9a1 1 0 01-1-1z" fill="currentColor"/></svg>
                </span>
            </div>
            <p class="text-3xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalDanaMitra, 0, ',', '.') }}</p>
            <p class="text-xs text-orange-600 dark:text-orange-400 mt-1 font-medium">Total kontribusi mitra</p>
        </div>
    </div>

    {{-- Chart + GIS Map Row --}}
    <div class="grid grid-cols-1 xl:grid-cols-5 gap-4 mb-6">

        {{-- Grafik Tren Laporan --}}
        <div class="xl:col-span-2 rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-1">Tren Laporan</h2>
            <p class="text-xs text-gray-400 mb-4">6 bulan terakhir</p>
            <canvas id="trendChart" height="200"></canvas>
        </div>

        {{-- GIS Heatmap --}}
        <div class="xl:col-span-3 rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-1">Peta Konsentrasi Sampah</h2>
            <p class="text-xs text-gray-400 mb-4">Banjarmasin — titik laporan aktif</p>
            <div id="sampayMap" class="w-full rounded-xl z-10" style="height: 280px;"></div>
        </div>
    </div>

    {{-- Statistik Kategori + Latest Laporan --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">

        {{-- Distribusi Kategori --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Distribusi Kategori</h2>
            <canvas id="kategoriChart" height="220"></canvas>
            <div class="mt-4 space-y-2">
                @foreach($statistikKategori as $stat)
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600 dark:text-gray-400">{{ $stat->kategori }}</span>
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $stat->total }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="xl:col-span-2 rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Aksi Cepat</h2>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('admin.laporan.index') }}?status=Pending"
                    class="flex items-center gap-3 p-4 rounded-xl bg-amber-50 border border-amber-200 hover:bg-amber-100 transition dark:bg-amber-900/20 dark:border-amber-800">
                    <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-amber-500 text-white shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"><path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    <div>
                        <p class="text-xs text-amber-700 dark:text-amber-400">Laporan Pending</p>
                        <p class="text-2xl font-bold text-amber-800 dark:text-amber-300">{{ $laporanPending }}</p>
                    </div>
                </a>
                <a href="{{ route('admin.redeem.index') }}?status=Pending"
                    class="flex items-center gap-3 p-4 rounded-xl bg-blue-50 border border-blue-200 hover:bg-blue-100 transition dark:bg-blue-900/20 dark:border-blue-800">
                    <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-500 text-white shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"><path d="M20 12V22H4V12M22 7H2v5h20V7zM12 22V7M12 7H7.5a2.5 2.5 0 010-5C11 2 12 7 12 7zM12 7h4.5a2.5 2.5 0 000-5C13 2 12 7 12 7z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    <div>
                        <p class="text-xs text-blue-700 dark:text-blue-400">Redeem Pending</p>
                        <p class="text-2xl font-bold text-blue-800 dark:text-blue-300">{{ \App\Models\Redeem::pending()->count() }}</p>
                    </div>
                </a>
                <a href="{{ route('admin.petugas.index') }}"
                    class="flex items-center gap-3 p-4 rounded-xl bg-purple-50 border border-purple-200 hover:bg-purple-100 transition dark:bg-purple-900/20 dark:border-purple-800">
                    <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-purple-500 text-white shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    <div>
                        <p class="text-xs text-purple-700 dark:text-purple-400">Total Petugas</p>
                        <p class="text-2xl font-bold text-purple-800 dark:text-purple-300">{{ $totalPetugas }}</p>
                    </div>
                </a>
                <a href="{{ route('admin.mitra.index') }}"
                    class="flex items-center gap-3 p-4 rounded-xl bg-green-50 border border-green-200 hover:bg-green-100 transition dark:bg-green-900/20 dark:border-green-800">
                    <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-green-500 text-white shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><polyline points="9 22 9 12 15 12 15 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    <div>
                        <p class="text-xs text-green-700 dark:text-green-400">Kelola Mitra</p>
                        <p class="text-2xl font-bold text-green-800 dark:text-green-300">{{ \App\Models\Mitra::count() }}</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
{{-- Leaflet.js CDN --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.heat/dist/leaflet-heat.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // =====================
    // Grafik Tren Laporan
    // =====================
    const trendData = @json($trendLaporan);
    const bulanLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

    const labels = trendData.map(d => bulanLabels[d.bulan - 1] + ' ' + d.tahun);
    const values = trendData.map(d => d.total);

    const isDark = document.documentElement.classList.contains('dark');
    const textColor = isDark ? '#9ca3af' : '#6b7280';
    const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';

    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: labels.length ? labels : ['Belum ada data'],
            datasets: [{
                label: 'Jumlah Laporan',
                data: values.length ? values : [0],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#3b82f6',
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: textColor, stepSize: 1 },
                    grid: { color: gridColor }
                },
                x: { ticks: { color: textColor }, grid: { display: false } }
            }
        }
    });

    // =====================
    // Pie Chart Kategori
    // =====================
    const kategoriData = @json($statistikKategori);
    new Chart(document.getElementById('kategoriChart'), {
        type: 'doughnut',
        data: {
            labels: kategoriData.map(k => k.kategori),
            datasets: [{
                data: kategoriData.map(k => k.total),
                backgroundColor: ['#22c55e', '#3b82f6', '#8b5cf6'],
                borderWidth: 2,
                borderColor: isDark ? '#1f2937' : '#fff',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom', labels: { color: textColor } }
            }
        }
    });

    // =====================
    // Leaflet Map (GIS)
    // =====================
    const map = L.map('sampayMap').setView([-3.3194, 114.5908], 13); // Banjarmasin

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const heatmapData = @json($heatmapData);
    const heatPoints = heatmapData.map(p => [p.latitude, p.longitude, 1]);

    if (heatPoints.length > 0) {
        L.heatLayer(heatPoints, {
            radius: 25,
            blur: 15,
            gradient: { 0.4: 'blue', 0.65: 'lime', 1: 'red' }
        }).addTo(map);

        // Tambahkan marker juga
        heatmapData.forEach(p => {
            const color = p.status === 'Pending' ? '#f59e0b' : '#3b82f6';
            const circle = L.circleMarker([p.latitude, p.longitude], {
                radius: 6, fillColor: color, color: '#fff',
                weight: 2, opacity: 1, fillOpacity: 0.8
            }).addTo(map);
            circle.bindPopup(`<b>${p.kategori}</b><br>Status: ${p.status}`);
        });
    } else {
        // Tampilkan marker default Banjarmasin jika tidak ada data
        L.marker([-3.3194, 114.5908])
            .addTo(map)
            .bindPopup('Banjarmasin — Belum ada laporan aktif')
            .openPopup();
    }
});
</script>
@endsection
