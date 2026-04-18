<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Sampah SAMPAY</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; font-size: 12px; color: #1f2937; background: white; }
        .header { background: #1d4ed8; color: white; padding: 20px 30px; margin-bottom: 24px; }
        .header h1 { font-size: 20px; font-weight: 700; }
        .header p { font-size: 11px; opacity: 0.8; margin-top: 4px; }
        .meta { display: flex; gap: 20px; padding: 0 30px; margin-bottom: 20px; }
        .meta-item { background: #f3f4f6; border-radius: 8px; padding: 10px 16px; flex: 1; }
        .meta-item label { font-size: 10px; text-transform: uppercase; color: #6b7280; display: block; }
        .meta-item span { font-size: 14px; font-weight: 600; }
        table { width: calc(100% - 60px); margin: 0 30px; border-collapse: collapse; }
        thead { background: #1d4ed8; color: white; }
        thead th { padding: 10px 12px; text-align: left; font-size: 11px; font-weight: 600; }
        tbody tr:nth-child(even) { background: #f9fafb; }
        tbody td { padding: 9px 12px; border-bottom: 1px solid #e5e7eb; vertical-align: top; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 10px; font-weight: 600; }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-diproses { background: #dbeafe; color: #1e40af; }
        .badge-selesai { background: #d1fae5; color: #065f46; }
        .badge-ditolak { background: #fee2e2; color: #991b1b; }
        .footer { text-align: center; padding: 20px 30px; margin-top: 20px; color: #9ca3af; font-size: 10px; border-top: 1px solid #e5e7eb; }
        @media print {
            body { print-color-adjust: exact; -webkit-print-color-adjust: exact; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="background:#f3f4f6;padding:12px 30px;display:flex;justify-content:space-between;align-items:center;">
        <span style="font-size:13px;color:#374151;">Klik tombol untuk mencetak atau simpan sebagai PDF</span>
        <button onclick="window.print()" style="background:#1d4ed8;color:white;border:none;padding:8px 20px;border-radius:8px;cursor:pointer;font-size:13px;font-weight:600;">
            🖨 Print / Save PDF
        </button>
    </div>

    <div class="header">
        <h1>📋 Laporan Sampah — SAMPAY</h1>
        <p>Sistem Pengelolaan Sampah Banjarmasin &nbsp;|&nbsp; Periode: {{ $dari }} s/d {{ $sampai }}</p>
    </div>

    <div class="meta">
        <div class="meta-item">
            <label>Total Laporan</label>
            <span>{{ $laporan->count() }}</span>
        </div>
        <div class="meta-item">
            <label>Laporan Selesai</label>
            <span>{{ $laporan->where('status', 'Selesai')->count() }}</span>
        </div>
        <div class="meta-item">
            <label>Laporan Pending</label>
            <span>{{ $laporan->where('status', 'Pending')->count() }}</span>
        </div>
        <div class="meta-item">
            <label>Tanggal Cetak</label>
            <span>{{ now()->format('d M Y, H:i') }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Warga</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Petugas</th>
                <th>Tanggal Lapor</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>
                    <strong>{{ $item->user?->nama_lengkap ?? '-' }}</strong><br>
                    <span style="color:#6b7280;">{{ $item->user?->email }}</span>
                </td>
                <td>{{ $item->kategori }}</td>
                <td>
                    @php $cls = strtolower($item->status); @endphp
                    <span class="badge badge-{{ $cls }}">{{ $item->status }}</span>
                </td>
                <td>{{ $item->petugas?->nama_lengkap ?? '-' }}</td>
                <td>{{ $item->tanggal_lapor ? \Carbon\Carbon::parse($item->tanggal_lapor)->format('d/m/Y') : '-' }}</td>
                <td>{{ Str::limit($item->keterangan_warga ?? '-', 30) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;padding:20px;color:#9ca3af;">Tidak ada data laporan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak dari Sistem SAMPAY — {{ now()->format('d M Y H:i:s') }} | Banjarmasin
    </div>
</body>
</html>
