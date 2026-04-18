<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\RewardKatalog;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $recentLaporan = Report::where('id_user', $user->id_user)
            ->orderBy('tanggal_lapor', 'desc')
            ->take(3)
            ->get();

        $stats = [
            'total_laporan' => Report::where('id_user', $user->id_user)->count(),
            'pending'       => Report::where('id_user', $user->id_user)
                                     ->whereIn('status', ['Pending', 'Diproses', 'Dijemput'])
                                     ->count(),
            'selesai'       => Report::where('id_user', $user->id_user)
                                     ->where('status', 'Selesai')
                                     ->count(),
            'saldo_poin'    => $user->saldo_poin ?? 0,
        ];

        $totalReward = RewardKatalog::count();

        return view('pages.masyarakat.dashboard', compact('recentLaporan', 'stats', 'totalReward'));
    }
}
