@extends('layouts.app')

@section('title', 'Approval Redeem - SAMPAY Admin')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Approval Redeem</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Verifikasi dan setujui penukaran poin warga</p>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800">{{ session('success') }}</div>
    @endif

    {{-- Filter Status --}}
    <div class="mb-4">
        <form method="GET" class="flex flex-wrap gap-2">
            @foreach(['', 'Pending', 'Selesai', 'Ditolak'] as $s)
            <a href="{{ route('admin.redeem.index') }}{{ $s ? '?status='.$s : '' }}"
                class="px-4 py-2 rounded-lg text-sm font-medium transition
                {{ request('status') === $s || (request('status') === null && $s === '') ?
                    'bg-brand-500 text-white' :
                    'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300' }}">
                {{ $s ?: 'Semua' }}
            </a>
            @endforeach
        </form>
    </div>

    {{-- Tabel Redeem --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Warga</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Reward</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Poin</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Mitra</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Status</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Tanggal</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($redeems as $redeem)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                        <td class="px-4 py-3">
                            <p class="font-medium text-gray-900 dark:text-white">{{ $redeem->user?->nama_lengkap ?? '-' }}</p>
                            <p class="text-xs text-gray-400">Saldo: {{ number_format($redeem->user?->saldo_poin ?? 0) }} poin</p>
                        </td>
                        <td class="px-4 py-3">
                            <p class="font-medium text-gray-900 dark:text-white">{{ $redeem->rewardKatalog?->nama_reward ?? 'Reward dihapus' }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <span class="font-semibold text-amber-600 dark:text-amber-400">{{ number_format($redeem->jumlah_poin) }}</span>
                        </td>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">
                            {{ $redeem->rewardKatalog?->mitra?->nama_mitra ?? '-' }}
                        </td>
                        <td class="px-4 py-3">
                            @php $sc = match($redeem->status_redeem) { 'Pending'=>'amber','Selesai'=>'green','Ditolak'=>'red','Persetujuan'=>'blue',default=>'gray' }; @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $sc }}-100 text-{{ $sc }}-800 dark:bg-{{ $sc }}-900/30 dark:text-{{ $sc }}-400">
                                {{ $redeem->status_redeem }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-xs text-gray-500">
                            {{ $redeem->tanggal_redeem ? \Carbon\Carbon::parse($redeem->tanggal_redeem)->format('d M Y') : '-' }}
                        </td>
                        <td class="px-4 py-3">
                            @if($redeem->status_redeem === 'Pending')
                            <div class="flex gap-2">
                                <form action="{{ route('admin.redeem.approve', $redeem->id_redeem) }}" method="POST"
                                    onsubmit="return confirm('Setujui redeem ini? Poin akan dikurangi dari saldo warga.')">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-green-100 text-green-700 text-xs font-medium hover:bg-green-200 transition">
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('admin.redeem.tolak', $redeem->id_redeem) }}" method="POST"
                                    onsubmit="return confirm('Tolak redeem ini?')">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-100 text-red-700 text-xs font-medium hover:bg-red-200 transition">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                            @else
                                <span class="text-xs text-gray-400">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-12 text-center text-gray-400">
                            <p class="text-sm">Tidak ada pengajuan redeem.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($redeems->hasPages())
        <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-800">{{ $redeems->withQueryString()->links() }}</div>
        @endif
    </div>
</div>
@endsection
