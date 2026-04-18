<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Redeem;
use App\Models\PointTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanExportController extends Controller
{
    public function index()
    {
        $totalLaporan   = Report::count();
        $totalSelesai   = Report::where('status', 'Selesai')->count();
        $totalPoin      = PointTransaction::where('tipe_transaksi', 'Pemasukan')->sum('jumlah_poin');
        $totalRedeem    = Redeem::where('status_redeem', 'Selesai')->count();

        return view('pages.admin.export.index', compact(
            'totalLaporan', 'totalSelesai', 'totalPoin', 'totalRedeem'
        ));
    }

    public function exportLaporan(Request $request)
    {
        $request->validate([
            'dari'   => 'nullable|date',
            'sampai' => 'nullable|date|after_or_equal:dari',
        ]);

        $query = Report::with(['user', 'petugas']);

        if ($request->filled('dari')) {
            $query->whereDate('tanggal_lapor', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('tanggal_lapor', '<=', $request->sampai);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $laporan  = $query->orderBy('tanggal_lapor', 'desc')->get();
        $dari     = $request->dari ?? 'Semua';
        $sampai   = $request->sampai ?? 'Semua';

        return view('pages.admin.export.laporan-pdf', compact('laporan', 'dari', 'sampai'));
    }

    public function exportTransaksi(Request $request)
    {
        $request->validate([
            'dari'   => 'nullable|date',
            'sampai' => 'nullable|date|after_or_equal:dari',
        ]);

        $query = PointTransaction::with(['user', 'laporan', 'redeem']);

        if ($request->filled('dari')) {
            $query->whereDate('tanggal_transaksi', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('tanggal_transaksi', '<=', $request->sampai);
        }

        $transaksi = $query->orderBy('tanggal_transaksi', 'desc')->get();
        $dari      = $request->dari ?? 'Semua';
        $sampai    = $request->sampai ?? 'Semua';

        return view('pages.admin.export.transaksi-pdf', compact('transaksi', 'dari', 'sampai'));
    }
}
