@extends('layouts.mahasiswa')
@section('title', 'Feedback Saya')
@section('active', 'mahasiswa.feedback.index')

@section('content')
@if ($feedbackList->isEmpty())
<div class="text-center py-16">
    <p class="text-gray-900 font-medium">Belum ada feedback</p>
    <p class="text-sm text-gray-500 mt-1">Feedback akan muncul setelah Anda mengisi evaluasi sesi mentoring.</p>
</div>
@else
<div class="space-y-4">
    @foreach ($feedbackList as $fb)
    @php $sesi = $fb->pesertaSesi->sesi; @endphp
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-start justify-between mb-4">
            <div>
                <p class="text-[15px] font-semibold text-gray-900">{{ $sesi->topik ?? '-' }}</p>
                <p class="text-sm text-gray-500 mt-0.5">
                    {{ $sesi->kelas->mataKuliah->nama_mata_kuliah ?? '-' }}
                    &middot; {{ $sesi->kelas->mentor->name ?? '-' }}
                </p>
            </div>
            <p class="text-xs text-gray-400 whitespace-nowrap">{{ $fb->created_at->format('d M Y') }}</p>
        </div>

        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <p class="text-xs text-gray-500 mb-1">Komunikasi</p>
                <div class="flex items-center gap-0.5">
                    @for ($i = 1; $i <= 5; $i++)
                    <span class="text-sm {{ $i <= $fb->komunikasi ? 'text-amber-400' : 'text-gray-200' }}">★</span>
                    @endfor
                </div>
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-1">Materi</p>
                <div class="flex items-center gap-0.5">
                    @for ($i = 1; $i <= 5; $i++)
                    <span class="text-sm {{ $i <= $fb->penguasaan_materi ? 'text-amber-400' : 'text-gray-200' }}">★</span>
                    @endfor
                </div>
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-1">Penyampaian</p>
                <div class="flex items-center gap-0.5">
                    @for ($i = 1; $i <= 5; $i++)
                    <span class="text-sm {{ $i <= $fb->kejelasan_penyampaian ? 'text-amber-400' : 'text-gray-200' }}">★</span>
                    @endfor
                </div>
            </div>
        </div>

        @if ($fb->komentar)
        <div class="border-t border-gray-100 pt-3">
            <p class="text-xs text-gray-500 mb-1">Komentar</p>
            <p class="text-sm text-gray-700 leading-relaxed">{{ $fb->komentar }}</p>
        </div>
        @endif
    </div>
    @endforeach
</div>
@endif
@endsection