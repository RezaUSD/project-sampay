@extends('layouts.app')

@section('title', 'Verifikasi Laporan - SAMPAY Admin')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Verifikasi Laporan</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Inbox laporan masuk dari warga</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800 dark:bg-green-900/20 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filter Bar --}}
    <div class="mb-4 flex flex-wrap gap-3">
        <form method="GET" action="{{ route('admin.laporan.index') }}" class="flex flex-wrap gap-2 w-full sm:w-auto">
            <select name="status" class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                <option value="">Semua Status</option>
                @foreach(['Pending', 'Diproses', 'Selesai', 'Ditolak'] as $s)
                    <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
            <select name="kategori" class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                <option value="">Semua Kategori</option>
                @foreach(['Organik', 'Anorganik', 'Sampah Sungai'] as $k)
                    <option value="{{ $k }}" {{ request('kategori') == $k ? 'selected' : '' }}>{{ $k }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 rounded-lg bg-brand-500 text-white text-sm font-medium hover:bg-brand-600 transition">Filter</button>
            <a href="{{ route('admin.laporan.index') }}" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 transition dark:bg-gray-800 dark:text-gray-300">Reset</a>
        </form>
    </div>

    {{-- Tabel Laporan --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400">#</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400">Warga</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400">Foto</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400">Kategori</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400">Status</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400">Petugas</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400">Tanggal</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($laporan as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                        <td class="px-4 py-3 text-gray-500 dark:text-gray-400">{{ $item->id_laporan }}</td>
                        <td class="px-4 py-3">
                            <p class="font-medium text-gray-900 dark:text-white">{{ $item->user?->nama_lengkap ?? '-' }}</p>
                            <p class="text-xs text-gray-400">{{ $item->user?->email }}</p>
                        </td>
                        <td class="px-4 py-3">
                            @if($item->foto_sampah_masuk)
                                <a href="{{ asset('storage/' . $item->foto_sampah_masuk) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $item->foto_sampah_masuk) }}" alt="Foto"
                                        class="w-14 h-14 object-cover rounded-lg border border-gray-200 hover:opacity-80 transition">
                                </a>
                            @else
                                <span class="text-gray-400 text-xs">Tidak ada</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $catColor = match($item->kategori) {
                                    'Organik'       => 'green',
                                    'Anorganik'     => 'blue',
                                    'Sampah Sungai' => 'purple',
                                    default         => 'gray'
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                bg-{{ $catColor }}-100 text-{{ $catColor }}-800
                                dark:bg-{{ $catColor }}-900/30 dark:text-{{ $catColor }}-400">
                                {{ $item->kategori }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $statusColor = match($item->status) {
                                    'Pending'  => 'amber',
                                    'Diproses' => 'blue',
                                    'Selesai'  => 'green',
                                    'Ditolak'  => 'red',
                                    default    => 'gray'
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                bg-{{ $statusColor }}-100 text-{{ $statusColor }}-800
                                dark:bg-{{ $statusColor }}-900/30 dark:text-{{ $statusColor }}-400">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">
                            {{ $item->petugas?->nama_lengkap ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-xs text-gray-500 dark:text-gray-400">
                            {{ $item->tanggal_lapor ? \Carbon\Carbon::parse($item->tanggal_lapor)->format('d M Y') : '-' }}
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.laporan.show', $item->id_laporan) }}"
                                class="inline-flex items-center px-3 py-1.5 rounded-lg bg-brand-50 text-brand-700 text-xs font-medium hover:bg-brand-100 transition dark:bg-brand-900/20 dark:text-brand-400">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-12 text-center text-gray-400 dark:text-gray-500">
                            <svg class="mx-auto w-12 h-12 mb-3 opacity-40" fill="none" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 000 4h6a2 2 0 000-4M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <p class="text-sm">Tidak ada laporan ditemukan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($laporan->hasPages())
        <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-800">
            {{ $laporan->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
