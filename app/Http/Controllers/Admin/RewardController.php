<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RewardKatalog;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RewardController extends Controller
{
    // Daftar katalog reward
    public function index()
    {
        $rewards = RewardKatalog::with('mitra')->latest('id_reward_katalog')->paginate(12);
        $mitras  = Mitra::all();

        return view('pages.admin.reward.index', compact('rewards', 'mitras'));
    }

    // Simpan reward baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_mitra'        => 'nullable|exists:mitras,id_mitra',
            'nama_reward'     => 'required|string|max:255',
            'harga_poin'      => 'required|integer|min:1',
            'deskripsi_reward'=> 'nullable|string',
            'foto_reward'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto_reward')) {
            $validated['foto_reward'] = $request->file('foto_reward')
                ->store('rewards', 'public');
        }

        RewardKatalog::create($validated);

        return redirect()->route('admin.reward.index')
            ->with('success', 'Reward berhasil ditambahkan.');
    }

    // Update reward
    public function update(Request $request, RewardKatalog $reward)
    {
        $validated = $request->validate([
            'id_mitra'        => 'nullable|exists:mitras,id_mitra',
            'nama_reward'     => 'required|string|max:255',
            'harga_poin'      => 'required|integer|min:1',
            'deskripsi_reward'=> 'nullable|string',
            'foto_reward'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto_reward')) {
            // Hapus foto lama
            if ($reward->foto_reward) {
                Storage::disk('public')->delete($reward->foto_reward);
            }
            $validated['foto_reward'] = $request->file('foto_reward')
                ->store('rewards', 'public');
        }

        $reward->update($validated);

        return redirect()->route('admin.reward.index')
            ->with('success', 'Reward berhasil diperbarui.');
    }

    // Hapus reward
    public function destroy(RewardKatalog $reward)
    {
        if ($reward->foto_reward) {
            Storage::disk('public')->delete($reward->foto_reward);
        }

        $reward->delete();

        return redirect()->route('admin.reward.index')
            ->with('success', 'Reward berhasil dihapus.');
    }
}
