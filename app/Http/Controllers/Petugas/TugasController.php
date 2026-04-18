<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    /**
     * Daftar semua tugas yang tersedia & aktif milik petugas
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $tab  = $request->get('tab', 'aktif');

        if ($tab === 'baru') {
            // Laporan pending belum diambil siapapun
            $tugas = Report::whereNull('id_petugas')
                ->where('status', 'Pending')
                ->with('user')
                ->latest('id_laporan')
                ->paginate(10);
        } else {
            // Tugas milik petugas ini yang sedang berjalan
            $tugas = Report::where('id_petugas', $user->id_user)
                ->whereIn('status', ['Diproses', 'Dijemput'])
                ->with('user')
                ->latest('id_laporan')
                ->paginate(10);
        }

        return view('pages.petugas.tugas', compact('tugas', 'tab'));
    }

    /**
     * Detail tugas + form upload bukti
     */
    public function show(Report $laporan)
    {
        $user = Auth::user();

        // Pastikan hanya petugas yang ditugaskan (atau pending) yang bisa lihat
        if ($laporan->id_petugas && $laporan->id_petugas !== $user->id_user) {
            abort(403, 'Tugas ini bukan milik Anda.');
        }

        return view('pages.petugas.tugas-detail', compact('laporan'));
    }

    /**
     * Petugas ambil tugas (status: Pending → Diproses)
     */
    public function ambil(Report $laporan)
    {
        $user = Auth::user();

        if ($laporan->status !== 'Pending' || $laporan->id_petugas) {
            return back()->with('error', 'Tugas tidak tersedia atau sudah diambil.');
        }

        $laporan->update([
            'id_petugas' => $user->id_user,
            'status'     => 'Diproses',
        ]);

        return redirect()->route('petugas.tugas.show', $laporan->id_laporan)
            ->with('success', 'Tugas berhasil diambil! Silakan menuju lokasi.');
    }

    /**
     * Upload foto bukti + selesaikan tugas (status → Dijemput)
     */
    public function selesai(Request $request, Report $laporan)
    {
        $user = Auth::user();

        if ($laporan->id_petugas !== $user->id_user) {
            abort(403);
        }

        $request->validate([
            'foto_sampah_selesai' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Simpan foto bukti
        $foto = $request->file('foto_sampah_selesai');
        $namaFile = 'bukti_' . $laporan->id_laporan . '_' . time() . '.' . $foto->extension();
        $foto->storeAs('public/bukti', $namaFile);

        $laporan->update([
            'foto_sampah_selesai' => $namaFile,
            'status'              => 'Dijemput',
        ]);

        return redirect()->route('petugas.tugas.index')
            ->with('success', 'Bukti terupload! Menunggu verifikasi Admin.');
    }

    /**
     * Riwayat tugas yang sudah selesai
     */
    public function riwayat()
    {
        $user = Auth::user();

        $riwayat = Report::where('id_petugas', $user->id_user)
            ->whereIn('status', ['Dijemput', 'Selesai', 'Ditolak'])
            ->with('user')
            ->latest('id_laporan')
            ->paginate(15);

        return view('pages.petugas.riwayat', compact('riwayat'));
    }
}
