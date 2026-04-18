<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Tugas aktif yang sedang dikerjakan petugas ini
        $tugasAktif = Report::where('id_petugas', $user->id_user)
            ->whereIn('status', ['Diproses', 'Dijemput'])
            ->with('user')
            ->latest('id_laporan')
            ->get();

        // Laporan pending yang belum diambil siapapun
        $tugasBaru = Report::whereNull('id_petugas')
            ->where('status', 'Pending')
            ->with('user')
            ->latest('id_laporan')
            ->take(5)
            ->get();

        // Statistik petugas ini
        $stats = [
            'total_selesai'  => Report::where('id_petugas', $user->id_user)->where('status', 'Selesai')->count(),
            'tugas_aktif'    => $tugasAktif->count(),
            'total_diproses' => Report::where('id_petugas', $user->id_user)->whereIn('status', ['Diproses','Dijemput'])->count(),
        ];

        return view('pages.petugas.dashboard', compact('tugasAktif', 'tugasBaru', 'stats'));
    }
}
