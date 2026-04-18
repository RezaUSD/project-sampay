@extends('layouts.app')

@section('title', 'Manajemen User - SAMPAY Admin')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Manajemen User</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola akun Warga, Petugas, dan Admin</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="px-4 py-2 rounded-xl bg-brand-500 text-white text-sm font-semibold hover:bg-brand-600 transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            Tambah User
        </button>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800 dark:bg-green-900/20 dark:text-green-400">{{ session('success') }}</div>
    @endif

    {{-- Filter --}}
    <div class="mb-4">
        <form method="GET" class="flex flex-wrap gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / email..."
                class="rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
            @foreach(['', 'Warga', 'Petugas', 'Admin Pusat'] as $r)
            <a href="{{ route('admin.user.index') }}{{ $r ? '?role='.$r : '' }}"
                class="px-4 py-2 rounded-lg text-sm font-medium transition
                {{ request('role') === $r || (request('role') === null && $r === '') ?
                    'bg-brand-500 text-white' :
                    'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300' }}">
                {{ $r ?: 'Semua' }}
            </a>
            @endforeach
        </form>
    </div>

    {{-- Tabel --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">User</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Role</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Saldo Poin</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Terdaftar</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center shrink-0">
                                    <span class="text-brand-600 dark:text-brand-400 font-semibold text-sm">{{ substr($user->nama_lengkap, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $user->nama_lengkap }}</p>
                                    <p class="text-xs text-gray-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            @php $rc = match($user->role) { 'Admin Pusat'=>'red','Petugas'=>'purple','Warga'=>'blue',default=>'gray' }; @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $rc }}-100 text-{{ $rc }}-800 dark:bg-{{ $rc }}-900/30 dark:text-{{ $rc }}-400">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-4 py-3 font-semibold text-amber-600 dark:text-amber-400">
                            {{ number_format($user->saldo_poin) }} poin
                        </td>
                        <td class="px-4 py-3 text-xs text-gray-500 dark:text-gray-400">
                            {{ $user->tanggal_registrasi ? \Carbon\Carbon::parse($user->tanggal_registrasi)->format('d M Y') : '-' }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <button onclick="openEdit({{ $user->id_user }}, '{{ addslashes($user->nama_lengkap) }}', '{{ $user->email }}', '{{ $user->role }}')"
                                    class="px-3 py-1.5 rounded-lg bg-blue-100 text-blue-700 text-xs font-medium hover:bg-blue-200 transition dark:bg-blue-900/20 dark:text-blue-400">
                                    Edit
                                </button>
                                @if($user->id_user !== auth()->id())
                                <form action="{{ route('admin.user.destroy', $user->id_user) }}" method="POST"
                                    onsubmit="return confirm('Hapus user {{ $user->nama_lengkap }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-100 text-red-700 text-xs font-medium hover:bg-red-200 transition dark:bg-red-900/20 dark:text-red-400">
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center text-gray-400">
                            <p class="text-sm">Belum ada user terdaftar.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-800">{{ $users->withQueryString()->links() }}</div>
        @endif
    </div>
</div>

{{-- Modal Tambah User --}}
<div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Tambah User Baru</h3>
        <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300" placeholder="Nama lengkap">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                    <input type="email" name="email" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300" placeholder="email@domain.com">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                    <input type="password" name="password" required minlength="6" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300" placeholder="Min. 6 karakter">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
                    <select name="role" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                        <option value="Warga">Warga</option>
                        <option value="Petugas">Petugas</option>
                        <option value="Admin Pusat">Admin Pusat</option>
                    </select>
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

{{-- Modal Edit User --}}
<div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Edit User</h3>
        <form id="formEdit" method="POST">
            @csrf @method('PUT')
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
                    <input type="text" id="edit_nama" name="nama_lengkap" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                    <input type="email" id="edit_email" name="email" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Password Baru (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" minlength="6" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300" placeholder="Kosongkan jika tidak diubah">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
                    {{-- Role tidak bisa diubah --}}
                    <div id="edit_role_display" class="w-full rounded-lg border border-gray-200 bg-gray-50 dark:bg-gray-800 dark:border-gray-700 px-3 py-2 text-sm text-gray-500 dark:text-gray-400 flex items-center gap-2">
                        <span id="edit_role_text"></span>
                        <span class="text-xs text-gray-400 italic">(tidak dapat diubah)</span>
                    </div>
                    <input type="hidden" id="edit_role" name="role">
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

<script>
function openEdit(id, nama, email, role) {
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_role').value = role;       // hidden input
    document.getElementById('edit_role_text').textContent = role; // tampilan
    document.getElementById('formEdit').action = `/admin/user/${id}`;
    document.getElementById('modalEdit').classList.remove('hidden');
}
</script>
@endsection
