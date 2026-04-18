<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use App\Models\Mitra;
use App\Models\Redeem;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Widget statistik
        $totalLaporan   = Report::count();
        $totalUserAktif = User::where('role', 'Warga')->count();
        $totalPetugas   = User::where('role', 'Petugas')->count();
        $totalDanaMitra = Mitra::sum('kontribusi_dana');
        $laporanPending = Report::pending()->count();

        // Grafik tren laporan 6 bulan terakhir
        $trendLaporan = Report::select(
                DB::raw('MONTH(tanggal_lapor) as bulan'),
                DB::raw('YEAR(tanggal_lapor) as tahun'),
                DB::raw('COUNT(*) as total')
            )
            ->where('tanggal_lapor', '>=', now()->subMonths(6))
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get();

        // Data heatmap (koordinat laporan yang masih pending/diproses)
        $heatmapData = Report::whereIn('status', ['Pending', 'Diproses'])
            ->select('latitude', 'longitude', 'status', 'kategori')
            ->get();

        // Statistik per kategori
        $statistikKategori = Report::select('kategori', DB::raw('COUNT(*) as total'))
            ->groupBy('kategori')
            ->get();

        return view('pages.admin.dashboard', compact(
            'totalLaporan',
            'totalUserAktif',
            'totalPetugas',
            'totalDanaMitra',
            'laporanPending',
            'trendLaporan',
            'heatmapData',
            'statistikKategori'
        ));
    }
}
