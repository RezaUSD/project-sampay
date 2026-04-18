@extends('layouts.app')

@section('title', 'Manajemen Petugas - SAMPAY Admin')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Manajemen Petugas</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Track record kinerja petugas lapangan</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse($petugas as $p)
        <a href="{{ route('admin.petugas.show', $p->id_user) }}"
            class="block rounded-2xl border border-gray-200 bg-white p-5 hover:shadow-md transition dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center shrink-0">
                    <span class="text-purple-600 dark:text-purple-400 font-bold text-lg">{{ substr($p->nama_lengkap, 0, 1) }}</span>
                </div>
                <div class="min-w-0">
                    <p class="font-semibold text-gray-900 dark:text-white truncate">{{ $p->nama_lengkap }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ $p->email }}</p>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-2 text-center">
                <div class="rounded-xl bg-gray-50 dark:bg-gray-800/50 p-2">
                    <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $p->total_tugas }}</p>
                    <p class="text-[10px] text-gray-400 mt-0.5">Total</p>
                </div>
                <div class="rounded-xl bg-green-50 dark:bg-green-900/20 p-2">
                    <p class="text-xl font-bold text-green-600 dark:text-green-400">{{ $p->total_selesai }}</p>
                    <p class="text-[10px] text-green-500 mt-0.5">Selesai</p>
                </div>
                <div class="rounded-xl bg-blue-50 dark:bg-blue-900/20 p-2">
                    <p class="text-xl font-bold text-blue-600 dark:text-blue-400">{{ $p->total_diproses }}</p>
                    <p class="text-[10px] text-blue-500 mt-0.5">Aktif</p>
                </div>
            </div>
            @if($p->total_tugas > 0)
            <div class="mt-3">
                <div class="flex justify-between text-xs text-gray-500 mb-1">
                    <span>Tingkat Penyelesaian</span>
                    <span>{{ round(($p->total_selesai / $p->total_tugas) * 100) }}%</span>
                </div>
                <div class="w-full h-1.5 rounded-full bg-gray-200 dark:bg-gray-700">
                    <div class="h-1.5 rounded-full bg-green-500"
                        style="width: {{ round(($p->total_selesai / $p->total_tugas) * 100) }}%"></div>
                </div>
            </div>
            @endif
        </a>
        @empty
        <div class="col-span-3 text-center py-16 text-gray-400 dark:text-gray-500">
            <svg class="mx-auto w-16 h-16 mb-4 opacity-40" fill="none" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <p>Belum ada petugas terdaftar.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
