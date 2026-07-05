@extends('layouts.mentor')
@section('title', 'Dashboard Mentor')
@section('active', 'mentor.dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <x-stat title="Kelas Saya" :value="$kelasList->count()" color="amber" icon="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
    <x-stat title="Total Sesi" :value="$totalSesi" color="blue" />
    <x-stat title="Sesi Aktif" :value="$sesiAktif" color="green" />
    <x-stat title="Total Peserta" :value="$totalPeserta" color="violet" />
</div>

@if ($avgRating && ($avgRating->avg_kom || $avgRating->avg_mat || $avgRating->avg_peny))
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-xl border border-slate-100 p-5 shadow-sm text-center">
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Komunikasi</p>
        <div class="flex items-center justify-center gap-0.5 mt-2">
            @for ($i = 1; $i <= 5; $i++)
            <span class="text-lg {{ $i <= round($avgRating->avg_kom ?? 0) ? 'text-amber-400' : 'text-slate-200' }}">&#9733;</span>
            @endfor
        </div>
        <p class="text-lg font-bold text-slate-900 mt-1">{{ number_format($avgRating->avg_kom ?? 0, 1) }}</p>
    </div>
    <div class="bg-white rounded-xl border border-slate-100 p-5 shadow-sm text-center">
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Penguasaan Materi</p>
        <div class="flex items-center justify-center gap-0.5 mt-2">
            @for ($i = 1; $i <= 5; $i++)
            <span class="text-lg {{ $i <= round($avgRating->avg_mat ?? 0) ? 'text-amber-400' : 'text-slate-200' }}">&#9733;</span>
            @endfor
        </div>
        <p class="text-lg font-bold text-slate-900 mt-1">{{ number_format($avgRating->avg_mat ?? 0, 1) }}</p>
    </div>
    <div class="bg-white rounded-xl border border-slate-100 p-5 shadow-sm text-center">
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Kejelasan Penyampaian</p>
        <div class="flex items-center justify-center gap-0.5 mt-2">
            @for ($i = 1; $i <= 5; $i++)
            <span class="text-lg {{ $i <= round($avgRating->avg_peny ?? 0) ? 'text-amber-400' : 'text-slate-200' }}">&#9733;</span>
            @endfor
        </div>
        <p class="text-lg font-bold text-slate-900 mt-1">{{ number_format($avgRating->avg_peny ?? 0, 1) }}</p>
    </div>
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl border border-slate-100 shadow-sm">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-base font-semibold text-slate-900">Jadwal Sesi Mendatang</h2>
            <a href="{{ route('mentor.sesi.create') }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-lg transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Buat Sesi
            </a>
        </div>
        <div class="p-5">
            @forelse ($sesiMendatang as $sesi)
            <div class="flex items-center justify-between py-3 border-b border-slate-50 last:border-0">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-slate-900">{{ $sesi->topik }}</p>
                        <p class="text-xs text-slate-500">{{ $sesi->kelas->nama_kelas }} &middot; {{ \Carbon\Carbon::parse($sesi->tanggal)->format('d M Y') }} &middot; {{ $sesi->jam_mulai }}-{{ $sesi->jam_selesai }}</p>
                    </div>
                </div>
                <x-badge type="{{ $sesi->status }}">{{ ucfirst($sesi->status) }}</x-badge>
            </div>
            @empty
            <p class="text-sm text-slate-400 text-center py-6">Belum ada sesi mendatang.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-100 shadow-sm">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-base font-semibold text-slate-900">Feedback Terbaru</h2>
            <a href="{{ route('mentor.feedback') }}" class="text-xs text-amber-600 hover:text-amber-700 font-medium">Lihat Semua</a>
        </div>
        <div class="p-5">
            @forelse ($recentFeedback as $fb)
            <div class="flex items-start gap-3 py-3 border-b border-slate-50 last:border-0">
                <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-xs font-bold text-amber-600 flex-shrink-0">
                    {{ strtoupper(substr($fb->pesertaSesi->mahasiswa->name ?? '?', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-900">{{ $fb->pesertaSesi->mahasiswa->name ?? '-' }}</p>
                        <div class="flex gap-0.5">
                            @for ($i = 1; $i <= 5; $i++)
                            <span class="text-xs {{ $i <= $fb->komunikasi ? 'text-amber-400' : 'text-slate-200' }}">&#9733;</span>
                            @endfor
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">{{ $fb->pesertaSesi->sesi->topik ?? '-' }}</p>
                    <p class="text-xs text-slate-400 mt-0.5 line-clamp-1">"{{ $fb->komentar }}"</p>
                </div>
            </div>
            @empty
            <p class="text-sm text-slate-400 text-center py-6">Belum ada feedback.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
