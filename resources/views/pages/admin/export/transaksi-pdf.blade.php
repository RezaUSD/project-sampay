<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi Poin SAMPAY</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; font-size: 12px; color: #1f2937; background: white; }
        .header { background: #d97706; color: white; padding: 20px 30px; margin-bottom: 24px; }
        .header h1 { font-size: 20px; font-weight: 700; }
        .header p { font-size: 11px; opacity: 0.8; margin-top: 4px; }
        .meta { display: flex; gap: 20px; padding: 0 30px; margin-bottom: 20px; }
        .meta-item { background: #f3f4f6; border-radius: 8px; padding: 10px 16px; flex: 1; }
        .meta-item label { font-size: 10px; text-transform: uppercase; color: #6b7280; display: block; }
        .meta-item span { font-size: 14px; font-weight: 600; }
        table { width: calc(100% - 60px); margin: 0 30px; border-collapse: collapse; }
        thead { background: #d97706; color: white; }
        thead th { padding: 10px 12px; text-align: left; font-size: 11px; font-weight: 600; }
        tbody tr:nth-child(even) { background: #f9fafb; }
        tbody td { padding: 9px 12px; border-bottom: 1px solid #e5e7eb; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 10px; font-weight: 600; }
        .badge-in { background: #d1fae5; color: #065f46; }
        .badge-out { background: #fee2e2; color: #991b1b; }
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
        <button onclick="window.print()" style="background:#d97706;color:white;border:none;padding:8px 20px;border-radius:8px;cursor:pointer;font-size:13px;font-weight:600;">
            🖨 Print / Save PDF
        </button>
    </div>

    <div class="header">
        <h1>💰 Laporan Transaksi Poin — SAMPAY</h1>
        <p>Sistem Pengelolaan Sampah Banjarmasin &nbsp;|&nbsp; Periode: {{ $dari }} s/d {{ $sampai }}</p>
    </div>

    <div class="meta">
        <div class="meta-item">
            <label>Total Transaksi</label>
            <span>{{ $transaksi->count() }}</span>
        </div>
        <div class="meta-item">
            <label>Total Poin Masuk</label>
            <span>{{ number_format($transaksi->where('tipe_transaksi','Pemasukan')->sum('jumlah_poin')) }}</span>
        </div>
        <div class="meta-item">
            <label>Total Poin Keluar</label>
            <span>{{ number_format($transaksi->where('tipe_transaksi','Pengeluaran')->sum('jumlah_poin')) }}</span>
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
                <th>Tipe</th>
                <th>Jumlah Poin</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $i => $t)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $t->user?->nama_lengkap ?? '-' }}</strong></td>
                <td>
                    @if($t->tipe_transaksi === 'Pemasukan')
                        <span class="badge badge-in">+ Pemasukan</span>
                    @else
                        <span class="badge badge-out">- Pengeluaran</span>
                    @endif
                </td>
                <td><strong>{{ number_format($t->jumlah_poin) }} poin</strong></td>
                <td>{{ $t->keterangan ?? '-' }}</td>
                <td>{{ $t->tanggal_transaksi ? \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d/m/Y H:i') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:20px;color:#9ca3af;">Tidak ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak dari Sistem SAMPAY — {{ now()->format('d M Y H:i:s') }} | Banjarmasin
    </div>
</body>
</html>
