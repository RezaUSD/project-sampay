@extends('layouts.app')

@section('title', 'Manajemen Mitra - SAMPAY Admin')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Manajemen Mitra</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Data perusahaan CSR yang mendukung sistem SAMPAY</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="px-4 py-2 rounded-xl bg-brand-500 text-white text-sm font-semibold hover:bg-brand-600 transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            Tambah Mitra
        </button>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800">{{ session('success') }}</div>
    @endif

    {{-- Tabel Mitra --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Mitra</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Total Kontribusi</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Reward Aktif</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($mitras as $mitra)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                @if($mitra->foto_logo_mitra)
                                    <img src="{{ asset('storage/' . $mitra->foto_logo_mitra) }}" alt="{{ $mitra->nama_mitra }}"
                                        class="w-10 h-10 rounded-full object-cover border border-gray-200">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center">
                                        <span class="text-brand-600 dark:text-brand-400 font-bold">{{ substr($mitra->nama_mitra, 0, 1) }}</span>
                                    </div>
                                @endif
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $mitra->nama_mitra }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="font-semibold text-green-700 dark:text-green-400">Rp {{ number_format($mitra->kontribusi_dana, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300">
                            {{ $mitra->reward_katalog_count }} reward
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                {{-- Tambah Kontribusi --}}
                                <button onclick="openKontribusi({{ $mitra->id_mitra }}, '{{ addslashes($mitra->nama_mitra) }}')"
                                    class="px-3 py-1.5 rounded-lg bg-green-100 text-green-700 text-xs font-medium hover:bg-green-200 transition">
                                    + Dana
                                </button>
                                {{-- Edit --}}
                                <button onclick="openEdit({{ $mitra->id_mitra }}, '{{ addslashes($mitra->nama_mitra) }}', {{ $mitra->kontribusi_dana }})"
                                    class="px-3 py-1.5 rounded-lg bg-blue-100 text-blue-700 text-xs font-medium hover:bg-blue-200 transition">
                                    Edit
                                </button>
                                {{-- Hapus --}}
                                <form action="{{ route('admin.mitra.destroy', $mitra->id_mitra) }}" method="POST"
                                    onsubmit="return confirm('Hapus mitra {{ $mitra->nama_mitra }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-100 text-red-700 text-xs font-medium hover:bg-red-200 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-12 text-center text-gray-400">
                            <p class="text-sm">Belum ada data mitra. Tambahkan mitra pertama!</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($mitras->hasPages())
        <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-800">{{ $mitras->links() }}</div>
        @endif
    </div>
</div>

{{-- Modal Tambah Mitra --}}
<div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Tambah Mitra Baru</h3>
        <form action="{{ route('admin.mitra.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Mitra / Perusahaan</label>
                    <input type="text" name="nama_mitra" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300" placeholder="PT. Contoh Jaya">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Kontribusi Dana Awal (Rp)</label>
                    <input type="number" name="kontribusi_dana" required min="0" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300" placeholder="5000000">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Logo Mitra</label>
                    <input type="file" name="foto_logo_mitra" accept="image/*" class="w-full text-sm text-gray-500">
                </div>
            </div>
            <div class="flex gap-3 mt-5">
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="flex-1 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50 transition">Batal</button>
                <button type="submit" class="flex-1 py-2 rounded-lg bg-brand-500 text-white text-sm font-semibold hover:bg-brand-600 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Mitra --}}
<div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Edit Mitra</h3>
        <form id="formEdit" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Mitra</label>
                    <input type="text" id="edit_nama" name="nama_mitra" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Total Kontribusi Dana (Rp)</label>
                    <input type="number" id="edit_kontribusi" name="kontribusi_dana" required min="0" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Logo Baru (opsional)</label>
                    <input type="file" name="foto_logo_mitra" accept="image/*" class="w-full text-sm text-gray-500">
                </div>
            </div>
            <div class="flex gap-3 mt-5">
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')"
                    class="flex-1 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50 transition">Batal</button>
                <button type="submit" class="flex-1 py-2 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition">Update</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Tambah Kontribusi --}}
<div id="modalKontribusi" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-sm mx-4 p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Tambah Kontribusi Dana</h3>
        <p id="labelKontribusi" class="text-sm text-gray-500 mb-4"></p>
        <form id="formKontribusi" method="POST">
            @csrf
            <div>
                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Jumlah Dana Baru (Rp)</label>
                <input type="number" name="jumlah" required min="1" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300" placeholder="1000000">
            </div>
            <div class="flex gap-3 mt-5">
                <button type="button" onclick="document.getElementById('modalKontribusi').classList.add('hidden')"
                    class="flex-1 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50 transition">Batal</button>
                <button type="submit" class="flex-1 py-2 rounded-lg bg-green-600 text-white text-sm font-semibold hover:bg-green-700 transition">Catat</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEdit(id, nama, kontribusi) {
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_kontribusi').value = kontribusi;
    document.getElementById('formEdit').action = `/admin/mitra/${id}`;
    document.getElementById('modalEdit').classList.remove('hidden');
}
function openKontribusi(id, nama) {
    document.getElementById('labelKontribusi').textContent = `Mitra: ${nama}`;
    document.getElementById('formKontribusi').action = `/admin/mitra/${id}/kontribusi`;
    document.getElementById('modalKontribusi').classList.remove('hidden');
}
</script>
@endsection
