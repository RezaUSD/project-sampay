<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    // Daftar petugas + track record
    public function index()
    {
        $petugas = User::where('role', 'Petugas')
            ->withCount([
                'tugasLaporan as total_tugas',
                'tugasLaporan as total_selesai' => fn($q) => $q->where('status', 'Selesai'),
                'tugasLaporan as total_diproses' => fn($q) => $q->where('status', 'Diproses'),
            ])
            ->get();

        return view('pages.admin.petugas.index', compact('petugas'));
    }

    // Detail track record petugas
    public function show(User $petugas)
    {
        abort_if($petugas->role !== 'Petugas', 404);

        $laporan = $petugas->tugasLaporan()
            ->with('user')
            ->latest('tanggal_lapor')
            ->paginate(10);

        return view('pages.admin.petugas.show', compact('petugas', 'laporan'));
    }
}
