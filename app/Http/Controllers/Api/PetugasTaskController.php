<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\PointTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PetugasTaskController extends Controller
{
    /**
     * Get Daftar Tugas Aktif (Work Orders)
     * Mengambil daftar laporan yg berstatus "Diproses" dan ditugaskan ke petugas ini
     */
    public function getActiveTasks(Request $request)
    {
        $petugasId = $request->user()->id_user;
        $lat = $request->query('lat');
        $lng = $request->query('lng');

        $query = Report::with('user:id_user,nama_lengkap')
            ->where('id_petugas', $petugasId)
            ->where('status', 'Diproses');

        // Jika petugas mengirimkan lokasi gmaps mereka (Haversine formula untuk jarak)
        if ($lat && $lng) {
            $query->select(
                '*',
                DB::raw("( 6371 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) 
                * cos( radians( longitude ) - radians($lng) ) + sin( radians($lat) ) 
                * sin( radians( latitude ) ) ) ) AS distance")
            )
            ->orderBy('distance', 'asc');
        } else {
            $query->latest('tanggal_lapor');
        }

        $tasks = $query->get();

        return response()->json([
            'success' => true,
            'data' => $tasks
        ], 200);
    }

    /**
     * Get Detail Laporan
     */
    public function showTask(Request $request, $id)
    {
        $petugasId = $request->user()->id_user;
        
        $task = Report::with('user:id_user,nama_lengkap,email')->find($id);

        if (!$task) {
            return response()->json(['success' => false, 'message' => 'Tugas tidak ditemukan'], 404);
        }

        if ($task->id_petugas !== $petugasId) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $task
        ], 200);
    }

    /**
     * Submit Bukti Selesai & Update Status
     */
    public function completeTask(Request $request, $id)
    {
        $request->validate([
            'foto_sampah_selesai' => 'required|image|mimes:jpeg,png,jpg|max:5120', // maks 5MB
        ]);

        $petugasId = $request->user()->id_user;
        $task = Report::find($id);

        if (!$task || $task->id_petugas !== $petugasId) {
            return response()->json(['success' => false, 'message' => 'Tugas tidak valid'], 404);
        }

        if ($task->status !== 'Diproses') {
            return response()->json(['success' => false, 'message' => 'Tugas ini tidak sedang diproses'], 400);
        }

        // Upload foto
        $fotoPath = $request->file('foto_sampah_selesai')->store('reports', 'public');

        // Update database (transaksi agar aman)
        DB::beginTransaction();
        try {
            $task->update([
                'status' => 'Selesai',
                'foto_sampah_selesai' => $fotoPath,
            ]);

            // Berikan poin ke warga
            $poinDiberikan = match ($task->kategori) {
                'Organik' => 10,
                'Anorganik' => 15,
                'Sampah Sungai' => 25,
                default => 10,
            };

            $task->user->increment('saldo_poin', $poinDiberikan);

            PointTransaction::create([
                'id_user' => $task->id_user,
                'id_laporan' => $task->id_laporan,
                'tipe_transaksi' => 'Pemasukan',
                'jumlah_poin' => $poinDiberikan,
                'keterangan' => 'Reward penyelesaian laporan sampah: ' . $task->kategori,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Tugas berhasil diselesaikan. Koin otomatis ditransfer ke warga pelapor.',
                'data' => $task
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Riwayat Tugas Selesai
     */
    public function history(Request $request)
    {
        $petugasId = $request->user()->id_user;
        
        $history = Report::with('user:id_user,nama_lengkap')
            ->where('id_petugas', $petugasId)
            ->where('status', 'Selesai')
            ->orderBy('updated_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $history
        ], 200);
    }
}
