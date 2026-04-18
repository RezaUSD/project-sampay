<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redeem;
use App\Models\PointTransaction;
use Illuminate\Http\Request;

class RedeemController extends Controller
{
    // Daftar pengajuan redeem
    public function index(Request $request)
    {
        $query = Redeem::with(['user', 'rewardKatalog.mitra'])
            ->latest('tanggal_redeem');

        if ($request->filled('status')) {
            $query->where('status_redeem', $request->status);
        }

        $redeems = $query->paginate(15);

        return view('pages.admin.redeem.index', compact('redeems'));
    }

    // Approve redeem (ubah ke Selesai)
    public function approve(Redeem $redeem)
    {
        abort_if($redeem->status_redeem !== 'Pending', 403, 'Redeem tidak dalam status Pending.');

        $redeem->update(['status_redeem' => 'Selesai']);

        // Kurangi saldo poin user
        $redeem->user->decrement('saldo_poin', $redeem->jumlah_poin);

        // Catat transaksi poin pengeluaran
        PointTransaction::create([
            'id_user'        => $redeem->id_user,
            'id_redeem'      => $redeem->id_redeem,
            'tipe_transaksi' => 'Pengeluaran',
            'jumlah_poin'    => $redeem->jumlah_poin,
            'keterangan'     => 'Penukaran reward: ' . $redeem->rewardKatalog?->nama_reward,
        ]);

        return redirect()->route('admin.redeem.index')
            ->with('success', 'Redeem berhasil disetujui. Poin telah dikurangi dari saldo user.');
    }

    // Tolak redeem
    public function tolak(Redeem $redeem)
    {
        abort_if($redeem->status_redeem !== 'Pending', 403, 'Redeem tidak dalam status Pending.');

        $redeem->update(['status_redeem' => 'Ditolak']);

        return redirect()->route('admin.redeem.index')
            ->with('success', 'Redeem berhasil ditolak.');
    }
}
