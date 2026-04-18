<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Redeem;
use App\Models\RewardKatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    /** Katalog reward yang bisa ditukar */
    public function index()
    {
        $rewards = RewardKatalog::with('mitra')->orderBy('harga_poin', 'asc')->get();
        $user    = Auth::user();

        return view('pages.masyarakat.reward.index', compact('rewards', 'user'));
    }

    /** Proses tukar poin */
    public function redeem($id)
    {
        $user   = Auth::user();
        $reward = RewardKatalog::findOrFail($id);

        if ($user->saldo_poin < $reward->harga_poin) {
            return back()->with('error', 'Poin tidak cukup. Butuh '.$reward->harga_poin.' poin, kamu punya '.$user->saldo_poin.' poin.');
        }

        // Cek apakah sudah ada redeem pending untuk reward yang sama
        $existing = Redeem::where('id_user', $user->id_user)
                          ->where('id_reward_katalog', $reward->id_reward_katalog)
                          ->where('status_redeem', 'Pending')
                          ->exists();

        if ($existing) {
            return back()->with('error', 'Kamu sudah mengajukan penukaran reward ini dan masih menunggu persetujuan.');
        }

        // Kurangi poin user
        $user->decrement('saldo_poin', $reward->harga_poin);

        // Buat record redeem
        Redeem::create([
            'id_user'           => $user->id_user,
            'id_reward_katalog' => $reward->id_reward_katalog,
            'jumlah_poin'       => $reward->harga_poin,
            'status_redeem'     => 'Pending',
        ]);

        return back()->with('success', 'Penukaran reward "'.$reward->nama_reward.'" berhasil diajukan! Menunggu konfirmasi admin.');
    }

    /** Riwayat redeem user */
    public function riwayat()
    {
        $riwayat = Redeem::where('id_user', Auth::user()->id_user)
            ->with('rewardKatalog.mitra')
            ->orderBy('id_redeem', 'desc')
            ->paginate(10);

        return view('pages.masyarakat.reward.riwayat', compact('riwayat'));
    }
}
