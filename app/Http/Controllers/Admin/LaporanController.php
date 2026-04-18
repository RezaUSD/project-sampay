<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use App\Models\PointTransaction;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Daftar laporan (inbox verifikasi)
    public function index(Request $request)
    {
        $query = Report::with(['user', 'petugas'])
            ->latest('tanggal_lapor');

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $laporan = $query->paginate(15);

        return view('pages.admin.laporan.index', compact('laporan'));
    }

    // Detail laporan
    public function show(Report $laporan)
    {
        $laporan->load(['user', 'petugas']);
        $petugas = User::where('role', 'Petugas')->get();

        return view('pages.admin.laporan.show', compact('laporan', 'petugas'));
    }

    // Validasi laporan (approve ke petugas)
    public function valid(Request $request, Report $laporan)
    {
        $request->validate([
            'id_petugas' => 'required|exists:users,id_user',
        ]);

        $laporan->update([
            'status'     => 'Diproses',
            'id_petugas' => $request->id_petugas,
        ]);

        return redirect()
            ->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil divalidasi dan diteruskan ke petugas.');
    }

    // Tolak laporan
    public function tolak(Request $request, Report $laporan)
    {
        $request->validate([
            'alasan' => 'required|string|max:255',
        ]);

        $laporan->update(['status' => 'Ditolak']);

        // Catat keterangan penolakan di point_transactions sebagai log (opsional)
        // Tidak ada poin karena ditolak

        return redirect()
            ->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil ditolak.');
    }

    // Tandai selesai & berikan poin
    public function selesai(Request $request, Report $laporan)
    {
        $poinDiberikan = $this->hitungPoin($laporan->kategori);

        $laporan->update(['status' => 'Selesai']);

        // Tambah poin ke user pelapor
        $laporan->user->increment('saldo_poin', $poinDiberikan);

        // Catat transaksi poin
        PointTransaction::create([
            'id_user'        => $laporan->id_user,
            'id_laporan'     => $laporan->id_laporan,
            'tipe_transaksi' => 'Pemasukan',
            'jumlah_poin'    => $poinDiberikan,
            'keterangan'     => 'Reward laporan sampah: ' . $laporan->kategori,
        ]);

        return redirect()
            ->route('admin.laporan.index')
            ->with('success', "Laporan selesai. {$poinDiberikan} poin diberikan ke warga.");
    }

    // Helper hitung poin berdasarkan kategori
    private function hitungPoin(string $kategori): int
    {
        return match ($kategori) {
            'Organik'       => 10,
            'Anorganik'     => 15,
            'Sampah Sungai' => 25,
            default         => 10,
        };
    }
}
