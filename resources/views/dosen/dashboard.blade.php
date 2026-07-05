@extends('layouts.dosen')
@section('title', 'Dashboard Dosen')
@section('active', 'dosen.dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <x-stat title="Kelas Saya" :value="$totalKelas" color="violet" />
    <x-stat title="Total Sesi" :value="$totalSesi" color="blue" />
    <x-stat title="Sesi Aktif" :value="$sesiAktif" color="emerald" />
    <x-stat title="Kelas Tanpa Mentor" :value="$kelasTanpaMentor" color="amber" />
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-900">Kelas Saya</h2>
        </div>
        <div class="p-5">
            @forelse ($kelasList as $kelas)
            <a href="{{ route('dosen.kelas.show', $kelas) }}" class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0 hover:bg-gray-50/50 -mx-2 px-2 rounded-lg transition-colors">
                <div class="flex-1">
                    <p class="font-medium text-gray-900">{{ $kelas->nama_kelas }}</p>
                    <p class="text-xs text-gray-500">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</p>
                </div>
                <div class="text-right text-xs">
                    @if ($kelas->mentor)
                    <span class="text-emerald-600 font-medium">{{ $kelas->mentor->name }}</span>
                    @else
                    <span class="text-amber-600 font-medium">Cari Mentor</span>
                    @endif
                    <p class="text-gray-400 mt-0.5">{{ $kelas->sesiMentoring->count() }} sesi</p>
                </div>
            </a>
            @empty
            <p class="text-sm text-gray-400 text-center py-6">Anda belum memiliki kelas.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 lg:col-span-2">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-base font-semibold text-gray-900">Feedback Terbaru</h2>
            <a href="{{ route('dosen.monitoring') }}" class="text-xs text-violet-600 hover:text-violet-800 font-medium">Lihat Semua</a>
        </div>
        <div class="p-5">
            @forelse ($recentFeedback as $fb)
            <div class="flex items-start gap-3 py-3 border-b border-gray-50 last:border-0">
                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-500 flex-shrink-0 mt-0.5">
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
                    <p class="text-xs text-gray-500">{{ $fb->pesertaSesi->sesi->topik ?? '-' }} &middot; {{ $fb->pesertaSesi->sesi->kelas->nama_kelas ?? '-' }}</p>
                    <p class="text-xs text-gray-400 mt-1 line-clamp-1">"{{ $fb->komentar }}"</p>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-400 text-center py-6">Belum ada feedback.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
