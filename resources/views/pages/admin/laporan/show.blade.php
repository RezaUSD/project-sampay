@extends('layouts.app')

@section('title', 'Detail Laporan #{{ $laporan->id_laporan }} - SAMPAY Admin')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    {{-- Breadcrumb --}}
    <div class="mb-6 flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
        <a href="{{ route('admin.laporan.index') }}" class="hover:text-brand-500 transition">Verifikasi Laporan</a>
        <span>/</span>
        <span class="text-gray-900 dark:text-white">Laporan #{{ $laporan->id_laporan }}</span>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-800">
            @foreach($errors->all() as $error) <p>{{ $error }}</p> @endforeach
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Kolom Kiri: Info Laporan --}}
        <div class="xl:col-span-2 space-y-5">

            {{-- Foto Sampah --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Foto Laporan</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-2 uppercase tracking-wide">Foto Masuk (dari Warga)</p>
                        @if($laporan->foto_sampah_masuk)
                            <a href="{{ asset('storage/' . $laporan->foto_sampah_masuk) }}" target="_blank">
                                <img src="{{ asset('storage/' . $laporan->foto_sampah_masuk) }}" alt="Foto Masuk"
                                    class="w-full aspect-square object-cover rounded-xl border border-gray-200 hover:opacity-80 transition">
                            </a>
                        @else
                            <div class="w-full aspect-square rounded-xl border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-400 dark:border-gray-600">
                                <span class="text-sm">Tidak ada foto</span>
                            </div>
                        @endif
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-2 uppercase tracking-wide">Foto Selesai (dari Petugas)</p>
                        @if($laporan->foto_sampah_selesai)
                            <a href="{{ asset('storage/' . $laporan->foto_sampah_selesai) }}" target="_blank">
                                <img src="{{ asset('storage/' . $laporan->foto_sampah_selesai) }}" alt="Foto Selesai"
                                    class="w-full aspect-square object-cover rounded-xl border border-gray-200 hover:opacity-80 transition">
                            </a>
                        @else
                            <div class="w-full aspect-square rounded-xl border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-400 dark:border-gray-600">
                                <span class="text-sm">Belum ada</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Detail Info --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Detail Informasi</h2>
                <dl class="grid grid-cols-2 gap-4">
                    <div>
                        <dt class="text-xs text-gray-500 uppercase tracking-wide mb-1">Kategori Sampah</dt>
                        <dd class="font-semibold text-gray-900 dark:text-white">{{ $laporan->kategori }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500 uppercase tracking-wide mb-1">Status</dt>
                        <dd>
                            @php $sc = match($laporan->status) { 'Pending'=>'amber','Diproses'=>'blue','Selesai'=>'green','Ditolak'=>'red',default=>'gray' }; @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $sc }}-100 text-{{ $sc }}-800 dark:bg-{{ $sc }}-900/30 dark:text-{{ $sc }}-400">{{ $laporan->status }}</span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500 uppercase tracking-wide mb-1">Tanggal Lapor</dt>
                        <dd class="font-medium text-gray-900 dark:text-white">{{ $laporan->tanggal_lapor ? \Carbon\Carbon::parse($laporan->tanggal_lapor)->format('d M Y, H:i') : '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500 uppercase tracking-wide mb-1">Koordinat</dt>
                        <dd class="font-mono text-sm text-gray-900 dark:text-white">{{ $laporan->latitude }}, {{ $laporan->longitude }}</dd>
                    </div>
                    <div class="col-span-2">
                        <dt class="text-xs text-gray-500 uppercase tracking-wide mb-1">Keterangan Warga</dt>
                        <dd class="text-gray-700 dark:text-gray-300">{{ $laporan->keterangan_warga ?: 'Tidak ada keterangan.' }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Mini Map --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-3">Lokasi Laporan</h2>
                <div id="detailMap" class="w-full rounded-xl" style="height: 250px;"></div>
                <a href="https://maps.google.com?q={{ $laporan->latitude }},{{ $laporan->longitude }}" target="_blank"
                    class="mt-3 inline-flex items-center gap-1.5 text-sm text-brand-500 hover:text-brand-600 transition">
                    Buka di Google Maps →
                </a>
            </div>
        </div>

        {{-- Kolom Kanan: Aksi --}}
        <div class="space-y-5">

            {{-- Info Pelapor --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Warga Pelapor</h2>
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center">
                        <span class="text-brand-600 dark:text-brand-400 font-semibold text-sm">{{ substr($laporan->user?->nama_lengkap ?? '?', 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $laporan->user?->nama_lengkap ?? 'Tidak diketahui' }}</p>
                        <p class="text-xs text-gray-400">{{ $laporan->user?->email }}</p>
                    </div>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Saldo Poin: <span class="font-semibold text-gray-900 dark:text-white">{{ number_format($laporan->user?->saldo_poin ?? 0) }} poin</span></p>
            </div>

            {{-- Panel Aksi (hanya tampil jika Pending) --}}
            @if($laporan->status === 'Pending')
            <div class="rounded-2xl border-2 border-amber-200 bg-amber-50 p-5 dark:border-amber-800 dark:bg-amber-900/10">
                <h2 class="text-base font-semibold text-amber-800 dark:text-amber-400 mb-4">⚠️ Aksi Verifikasi</h2>

                {{-- Form Valid + Assign Petugas --}}
                <form action="{{ route('admin.laporan.valid', $laporan->id_laporan) }}" method="POST" class="mb-4">
                    @csrf
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">Assign ke Petugas</label>
                    <select name="id_petugas" required
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm mb-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                        <option value="">-- Pilih Petugas --</option>
                        @foreach($petugas as $p)
                            <option value="{{ $p->id_user }}">{{ $p->nama_lengkap }}</option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="w-full py-2.5 rounded-lg bg-green-600 text-white text-sm font-semibold hover:bg-green-700 transition">
                        ✅ Valid & Teruskan ke Petugas
                    </button>
                </form>

                {{-- Form Tolak --}}
                <form action="{{ route('admin.laporan.tolak', $laporan->id_laporan) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menolak laporan ini?')">
                    @csrf
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">Alasan Penolakan</label>
                    <input type="text" name="alasan" placeholder="Contoh: Foto tidak jelas" required
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm mb-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                    <button type="submit"
                        class="w-full py-2.5 rounded-lg bg-red-600 text-white text-sm font-semibold hover:bg-red-700 transition">
                        ❌ Tolak Laporan
                    </button>
                </form>
            </div>
            @endif

            {{-- Selesaikan (jika Diproses) --}}
            @if($laporan->status === 'Diproses')
            <div class="rounded-2xl border-2 border-blue-200 bg-blue-50 p-5 dark:border-blue-800 dark:bg-blue-900/10">
                <h2 class="text-base font-semibold text-blue-800 dark:text-blue-400 mb-2">🔵 Sedang Diproses</h2>
                <p class="text-sm text-blue-700 dark:text-blue-300 mb-4">Ditangani oleh <strong>{{ $laporan->petugas?->nama_lengkap }}</strong></p>
                <form action="{{ route('admin.laporan.selesai', $laporan->id_laporan) }}" method="POST"
                    onsubmit="return confirm('Tandai laporan ini sebagai selesai dan berikan poin ke warga?')">
                    @csrf
                    <button type="submit"
                        class="w-full py-2.5 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition">
                        ✅ Tandai Selesai & Berikan Poin
                    </button>
                </form>
            </div>
            @endif

            {{-- Sudah Selesai/Ditolak --}}
            @if(in_array($laporan->status, ['Selesai', 'Ditolak']))
            <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800/50">
                <p class="text-sm text-gray-500 dark:text-gray-400 text-center">
                    Laporan ini sudah berstatus <strong>{{ $laporan->status }}</strong> dan tidak dapat diubah lagi.
                </p>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Leaflet Map for detail --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const lat = {{ $laporan->latitude }};
    const lng = {{ $laporan->longitude }};
    const map = L.map('detailMap').setView([lat, lng], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    L.marker([lat, lng]).addTo(map)
        .bindPopup('{{ $laporan->kategori }} — {{ $laporan->status }}')
        .openPopup();
});
</script>
@endsection
