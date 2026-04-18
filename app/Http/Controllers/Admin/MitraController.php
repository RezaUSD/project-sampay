<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MitraController extends Controller
{
    // Daftar mitra
    public function index()
    {
        $mitras = Mitra::withCount('rewardKatalog')
            ->orderByDesc('kontribusi_dana')
            ->paginate(10);

        return view('pages.admin.mitra.index', compact('mitras'));
    }

    // Simpan mitra baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mitra'      => 'required|string|max:255',
            'foto_logo_mitra' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kontribusi_dana' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('foto_logo_mitra')) {
            $validated['foto_logo_mitra'] = $request->file('foto_logo_mitra')
                ->store('mitras', 'public');
        }

        Mitra::create($validated);

        return redirect()->route('admin.mitra.index')
            ->with('success', 'Mitra berhasil ditambahkan.');
    }

    // Update mitra
    public function update(Request $request, Mitra $mitra)
    {
        $validated = $request->validate([
            'nama_mitra'      => 'required|string|max:255',
            'foto_logo_mitra' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kontribusi_dana' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('foto_logo_mitra')) {
            if ($mitra->foto_logo_mitra) {
                Storage::disk('public')->delete($mitra->foto_logo_mitra);
            }
            $validated['foto_logo_mitra'] = $request->file('foto_logo_mitra')
                ->store('mitras', 'public');
        }

        $mitra->update($validated);

        return redirect()->route('admin.mitra.index')
            ->with('success', 'Data mitra berhasil diperbarui.');
    }

    // Tambah kontribusi dana (log)
    public function tambahKontribusi(Request $request, Mitra $mitra)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $mitra->increment('kontribusi_dana', $request->jumlah);

        return redirect()->route('admin.mitra.index')
            ->with('success', 'Kontribusi dana berhasil dicatat.');
    }

    // Hapus mitra
    public function destroy(Mitra $mitra)
    {
        if ($mitra->foto_logo_mitra) {
            Storage::disk('public')->delete($mitra->foto_logo_mitra);
        }

        $mitra->delete();

        return redirect()->route('admin.mitra.index')
            ->with('success', 'Mitra berhasil dihapus.');
    }
}
