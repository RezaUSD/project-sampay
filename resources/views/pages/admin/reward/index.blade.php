@extends('layouts.app')

@section('title', 'Katalog Reward - SAMPAY Admin')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Katalog Reward</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola daftar hadiah yang bisa ditukar warga</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="px-4 py-2 rounded-xl bg-brand-500 text-white text-sm font-semibold hover:bg-brand-600 transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            Tambah Reward
        </button>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800">{{ session('success') }}</div>
    @endif

    {{-- Grid Reward --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse($rewards as $reward)
        <div class="rounded-2xl border border-gray-200 bg-white overflow-hidden dark:border-gray-800 dark:bg-white/[0.03]">
            @if($reward->foto_reward)
                @php
                    $path = Str::startsWith($reward->foto_reward, ['http://', 'https://']) 
                            ? $reward->foto_reward 
                            : (Str::startsWith($reward->foto_reward, 'images/') ? asset($reward->foto_reward) : asset('storage/' . $reward->foto_reward));
                @endphp
                <img src="{{ $path }}" alt="{{ $reward->nama_reward }}" class="w-full h-40 object-cover">
            @else
                <div class="w-full h-40 bg-gradient-to-br from-brand-100 to-purple-100 dark:from-brand-900/30 dark:to-purple-900/30 flex items-center justify-center">
                    <svg class="w-12 h-12 text-brand-300" fill="none" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="currentColor"/></svg>
                </div>
            @endif
            <div class="p-4">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">{{ $reward->nama_reward }}</h3>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $reward->mitra?->nama_mitra ?? 'Tanpa Mitra' }}</p>
                    </div>
                    <span class="shrink-0 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400">
                        {{ number_format($reward->harga_poin) }} poin
                    </span>
                </div>
                @if($reward->deskripsi_reward)
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-3 line-clamp-2">{{ $reward->deskripsi_reward }}</p>
                @endif
                <div class="flex gap-2 pt-3 border-t border-gray-100 dark:border-gray-800">
                    <button onclick="openEdit({{ $reward->id_reward_katalog }}, '{{ addslashes($reward->nama_reward) }}', {{ $reward->id_mitra ?? 'null' }}, {{ $reward->harga_poin }}, '{{ addslashes($reward->deskripsi_reward ?? '') }}')"
                        class="flex-1 py-1.5 rounded-lg text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 transition dark:bg-blue-900/20 dark:text-blue-400">
                        Edit
                    </button>
                    <form action="{{ route('admin.reward.destroy', $reward->id_reward_katalog) }}" method="POST"
                        onsubmit="return confirm('Hapus reward ini?')" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="w-full py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-700 hover:bg-red-100 transition dark:bg-red-900/20 dark:text-red-400">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-16 text-gray-400">
            <p>Belum ada reward. Tambahkan yang pertama!</p>
        </div>
        @endforelse
    </div>

    @if($rewards->hasPages())
    <div class="mt-4">{{ $rewards->links() }}</div>
    @endif
</div>

{{-- Modal Tambah Reward --}}
<div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Tambah Reward Baru</h3>
        <form action="{{ route('admin.reward.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Reward</label>
                    <input type="text" name="nama_reward" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300" placeholder="Voucher Belanja 50rb">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Mitra (Opsional)</label>
                    <select name="id_mitra" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                        <option value="">-- Tanpa Mitra --</option>
                        @foreach($mitras as $m)
                            <option value="{{ $m->id_mitra }}">{{ $m->nama_mitra }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Harga Poin</label>
                    <input type="number" name="harga_poin" required min="1" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300" placeholder="100">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                    <textarea name="deskripsi_reward" rows="2" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300" placeholder="Deskripsi reward..."></textarea>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Foto Reward</label>
                    <input type="file" name="foto_reward" accept="image/*" class="w-full text-sm text-gray-500">
                </div>
            </div>
            <div class="flex gap-3 mt-5">
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="flex-1 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50 transition dark:border-gray-600 dark:text-gray-300">
                    Batal
                </button>
                <button type="submit" class="flex-1 py-2 rounded-lg bg-brand-500 text-white text-sm font-semibold hover:bg-brand-600 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Reward --}}
<div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Edit Reward</h3>
        <form id="formEdit" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Reward</label>
                    <input type="text" id="edit_nama" name="nama_reward" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Mitra</label>
                    <select id="edit_mitra" name="id_mitra" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                        <option value="">-- Tanpa Mitra --</option>
                        @foreach($mitras as $m)
                            <option value="{{ $m->id_mitra }}">{{ $m->nama_mitra }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Harga Poin</label>
                    <input type="number" id="edit_poin" name="harga_poin" required min="1" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                    <textarea id="edit_deskripsi" name="deskripsi_reward" rows="2" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Foto Baru (opsional)</label>
                    <input type="file" name="foto_reward" accept="image/*" class="w-full text-sm text-gray-500">
                </div>
            </div>
            <div class="flex gap-3 mt-5">
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')"
                    class="flex-1 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50 transition dark:border-gray-600 dark:text-gray-300">
                    Batal
                </button>
                <button type="submit" class="flex-1 py-2 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEdit(id, nama, mitraId, poin, deskripsi) {
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_mitra').value = mitraId ?? '';
    document.getElementById('edit_poin').value = poin;
    document.getElementById('edit_deskripsi').value = deskripsi;
    document.getElementById('formEdit').action = `/admin/reward/${id}/update`;
    document.getElementById('modalEdit').classList.remove('hidden');
}
</script>
@endsection
