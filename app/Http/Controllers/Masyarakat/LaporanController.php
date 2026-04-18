<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    /** Daftar semua laporan milik user */
    public function index()
    {
        $laporan = Report::where('id_user', Auth::user()->id_user)
            ->orderBy('tanggal_lapor', 'desc')
            ->paginate(10);

        return view('pages.masyarakat.laporan.index', compact('laporan'));
    }

    /** Form buat laporan baru */
    public function create()
    {
        return view('pages.masyarakat.laporan.create');
    }

    /** Simpan laporan baru */
    public function store(Request $request)
    {
        $request->validate([
            'kategori'         => 'required|in:Organik,Anorganik,Sampah Sungai',
            'keterangan_warga' => 'nullable|string|max:500',
            'latitude'         => 'required|numeric',
            'longitude'        => 'required|numeric',
            'foto_sampah_masuk'=> 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'foto_sampah_masuk.required' => 'Foto laporan wajib diupload.',
            'foto_sampah_masuk.max'      => 'Ukuran foto maksimal 5MB.',
            'latitude.required'          => 'Lokasi GPS wajib dideteksi. Aktifkan GPS Anda.',
        ]);

        // Upload foto
        $foto = $request->file('foto_sampah_masuk');
        $namaFoto = time().'_'.$foto->hashName();
        $foto->storeAs('sampah', $namaFoto, 'public');

        Report::create([
            'id_user'          => Auth::user()->id_user,
            'foto_sampah_masuk'=> $namaFoto,
            'latitude'         => $request->latitude,
            'longitude'        => $request->longitude,
            'kategori'         => $request->kategori,
            'keterangan_warga' => $request->keterangan_warga,
            'status'           => 'Pending',
        ]);

        return redirect()->route('masyarakat.laporan.index')
                         ->with('success', 'Laporan berhasil dikirim! Petugas akan segera menjemput sampah Anda.');
    }

    /** Detail satu laporan */
    public function show($id)
    {
        $laporan = Report::where('id_user', Auth::user()->id_user)
            ->with('petugas')
            ->findOrFail($id);

        return view('pages.masyarakat.laporan.show', compact('laporan'));
    }
}
