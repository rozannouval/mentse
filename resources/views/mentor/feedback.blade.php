@extends('layouts.mentor')
@section('title', 'Feedback Mahasiswa')
@section('active', 'mentor.feedback')

@section('content')
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

<div class="bg-white rounded-xl border border-slate-100 shadow-sm">
    <div class="px-5 py-4 border-b border-slate-100">
        <h2 class="text-base font-semibold text-slate-900">Semua Feedback</h2>
    </div>
    <div class="divide-y divide-slate-50">
        @forelse ($feedbackList as $fb)
        <div class="p-5 hover:bg-slate-50/50 transition-colors">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center text-sm font-bold text-amber-600 flex-shrink-0">
                        {{ strtoupper(substr($fb->pesertaSesi->mahasiswa->name ?? '?', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900">{{ $fb->pesertaSesi->mahasiswa->name ?? '-' }}</p>
                        <p class="text-xs text-slate-500">{{ $fb->pesertaSesi->sesi->topik ?? '-' }} &middot; {{ $fb->pesertaSesi->sesi->kelas->nama_kelas ?? '-' }}</p>
                    </div>
                </div>
                <div class="flex gap-0.5">
                    @for ($i = 1; $i <= 5; $i++)
                    <span class="text-xs {{ $i <= $fb->komunikasi ? 'text-amber-400' : 'text-slate-200' }}">&#9733;</span>
                    @endfor
                </div>
            </div>
            <div class="mt-3 pl-12">
                <div class="flex gap-4 text-xs text-slate-500 mb-2">
                    <span>Komunikasi: <strong class="text-slate-700">{{ $fb->komunikasi }}</strong></span>
                    <span>Materi: <strong class="text-slate-700">{{ $fb->penguasaan_materi }}</strong></span>
                    <span>Penyampaian: <strong class="text-slate-700">{{ $fb->kejelasan_penyampaian }}</strong></span>
                </div>
                @if ($fb->komentar)
                <p class="text-sm text-slate-600 bg-slate-50 rounded-lg p-3 italic">"{{ $fb->komentar }}"</p>
                @endif
                <p class="text-xs text-slate-400 mt-2">{{ $fb->created_at->diffForHumans() }}</p>
            </div>
        </div>
        @empty
        <div class="p-10 text-center">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
            </svg>
            <p class="text-sm text-slate-500 font-medium">Belum ada feedback</p>
            <p class="text-xs text-slate-400 mt-1">Feedback dari mahasiswa akan muncul di sini.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
