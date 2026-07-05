@extends('layouts.mentor')
@section('title', 'Dashboard Mentor')
@section('active', 'mentor.dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <x-stat title="Kelas Saya" :value="$kelasList->count()" color="amber" />
    <x-stat title="Total Sesi" :value="$totalSesi" color="blue" />
    <x-stat title="Sesi Aktif" :value="$sesiAktif" color="emerald" />
    <x-stat title="Total Peserta" :value="$totalPeserta" color="violet" />
</div>

@if ($avgRating && ($avgRating->avg_kom || $avgRating->avg_mat || $avgRating->avg_peny))
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-lg border border-gray-200 p-4 text-center">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Komunikasi</p>
        <div class="flex items-center justify-center gap-1 mt-1">
            @for ($i = 1; $i <= 5; $i++)
            <span class="text-lg {{ $i <= round($avgRating->avg_kom ?? 0) ? 'text-amber-400' : 'text-gray-200' }}">&#9733;</span>
            @endfor
        </div>
        <p class="text-lg font-bold text-gray-900 mt-0.5">{{ number_format($avgRating->avg_kom ?? 0, 1) }}</p>
    </div>
    <div class="bg-white rounded-lg border border-gray-200 p-4 text-center">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Penguasaan Materi</p>
        <div class="flex items-center justify-center gap-1 mt-1">
            @for ($i = 1; $i <= 5; $i++)
            <span class="text-lg {{ $i <= round($avgRating->avg_mat ?? 0) ? 'text-amber-400' : 'text-gray-200' }}">&#9733;</span>
            @endfor
        </div>
        <p class="text-lg font-bold text-gray-900 mt-0.5">{{ number_format($avgRating->avg_mat ?? 0, 1) }}</p>
    </div>
    <div class="bg-white rounded-lg border border-gray-200 p-4 text-center">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Kejelasan Penyampaian</p>
        <div class="flex items-center justify-center gap-1 mt-1">
            @for ($i = 1; $i <= 5; $i++)
            <span class="text-lg {{ $i <= round($avgRating->avg_peny ?? 0) ? 'text-amber-400' : 'text-gray-200' }}">&#9733;</span>
            @endfor
        </div>
        <p class="text-lg font-bold text-gray-900 mt-0.5">{{ number_format($avgRating->avg_peny ?? 0, 1) }}</p>
    </div>
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-base font-semibold text-gray-900">Jadwal Sesi Mendatang</h2>
            <a href="{{ route('mentor.sesi.create') }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Buat Sesi
            </a>
        </div>
        <div class="p-5">
            @forelse ($sesiMendatang as $sesi)
            <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">{{ $sesi->topik }}</p>
                        <p class="text-xs text-gray-500">{{ $sesi->kelas->nama_kelas }} &middot; {{ \Carbon\Carbon::parse($sesi->tanggal)->format('d M Y') }} &middot; {{ $sesi->jam_mulai }}-{{ $sesi->jam_selesai }}</p>
                    </div>
                </div>
                <x-badge type="{{ $sesi->status }}">{{ ucfirst($sesi->status) }}</x-badge>
            </div>
            @empty
            <p class="text-sm text-gray-400 text-center py-6">Belum ada sesi mendatang.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-900">Feedback Terbaru</h2>
        </div>
        <div class="p-5">
            @forelse ($recentFeedback as $fb)
            <div class="flex items-start gap-3 py-3 border-b border-gray-50 last:border-0">
                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-500 flex-shrink-0">
                    {{ strtoupper(substr($fb->pesertaSesi->mahasiswa->name ?? '?', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-900">{{ $fb->pesertaSesi->mahasiswa->name ?? '-' }}</p>
                        <div class="flex gap-0.5">
                            @for ($i = 1; $i <= 5; $i++)
                            <span class="text-xs {{ $i <= $fb->komunikasi ? 'text-amber-400' : 'text-gray-200' }}">&#9733;</span>
                            @endfor
                        </div>
                    </div>
                    <p class="text-xs text-gray-500">{{ $fb->pesertaSesi->sesi->topik ?? '-' }}</p>
                    <p class="text-xs text-gray-400 mt-0.5 line-clamp-1">"{{ $fb->komentar }}"</p>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-400 text-center py-6">Belum ada feedback.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
