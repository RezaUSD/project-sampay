@extends('layouts.app')

@section('title', 'Detail Petugas - SAMPAY Admin')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('admin.petugas.index') }}" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
            <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $petugas->nama_lengkap }}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Track Record Petugas Lapangan</p>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-4 gap-4 mb-6">
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
            <p class="text-sm text-gray-500 mb-1">Total Ditugaskan</p>
            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $laporan->total() }}</p>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
            <p class="text-sm text-gray-500 mb-1">Selesai</p>
            <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $laporan->getCollection()->where('status','Selesai')->count() }}</p>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
            <p class="text-sm text-gray-500 mb-1">Sedang Diproses</p>
            <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $laporan->getCollection()->where('status','Diproses')->count() }}</p>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
            <p class="text-sm text-gray-500 mb-1">Email</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $petugas->email }}</p>
        </div>
    </div>

    {{-- Tabel Penugasan --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800">
            <h2 class="font-semibold text-gray-900 dark:text-white">Riwayat Penugasan</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Warga</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Kategori</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Status</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Tanggal Lapor</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($laporan as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                        <td class="px-4 py-3 text-gray-500">#{{ $item->id_laporan }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $item->user?->nama_lengkap ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $item->kategori }}</td>
                        <td class="px-4 py-3">
                            @php $sc = match($item->status) { 'Pending'=>'amber','Diproses'=>'blue','Selesai'=>'green','Ditolak'=>'red',default=>'gray' }; @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $sc }}-100 text-{{ $sc }}-800 dark:bg-{{ $sc }}-900/30 dark:text-{{ $sc }}-400">{{ $item->status }}</span>
                        </td>
                        <td class="px-4 py-3 text-xs text-gray-500 dark:text-gray-400">
                            {{ $item->tanggal_lapor ? \Carbon\Carbon::parse($item->tanggal_lapor)->format('d M Y') : '-' }}
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.laporan.show', $item->id_laporan) }}"
                                class="px-3 py-1.5 rounded-lg bg-brand-50 text-brand-700 text-xs font-medium hover:bg-brand-100 transition dark:bg-brand-900/20 dark:text-brand-400">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-gray-400">
                            <p class="text-sm">Belum ada penugasan untuk petugas ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($laporan->hasPages())
        <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-800">{{ $laporan->links() }}</div>
        @endif
    </div>
</div>
@endsection
