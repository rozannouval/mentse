@extends('layouts.dosen')
@section('title', 'Kelas Saya')
@section('active', 'dosen.kelas.index')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-lg border border-gray-200 border-l-4 border-l-violet-500 p-4">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Kelas</p>
        <p class="text-xl font-bold text-gray-900 mt-0.5">{{ $kelasList->count() }}</p>
    </div>
    <div class="bg-white rounded-lg border border-gray-200 border-l-4 border-l-emerald-500 p-4">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Ada Mentor</p>
        <p class="text-xl font-bold text-gray-900 mt-0.5">{{ $kelasList->filter(fn($k) => $k->mentor_id)->count() }}</p>
    </div>
    <div class="bg-white rounded-lg border border-gray-200 border-l-4 border-l-amber-500 p-4">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Butuh Mentor</p>
        <p class="text-xl font-bold text-gray-900 mt-0.5">{{ $kelasList->filter(fn($k) => !$k->mentor_id)->count() }}</p>
    </div>
</div>

<div class="space-y-4">
    @forelse ($kelasList as $kelas)
    <div class="bg-white rounded-lg border border-gray-200 p-5">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-violet-50 flex items-center justify-center">
                    <span class="text-lg font-bold text-violet-600">{{ strtoupper(substr($kelas->nama_kelas, 0, 1)) }}</span>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">{{ $kelas->nama_kelas }}</h3>
                    <p class="text-sm text-gray-500">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right text-sm">
                    @if ($kelas->mentor)
                    <div class="flex items-center gap-2">
                        <span class="text-gray-500">Mentor:</span>
                        <span class="font-medium text-emerald-600">{{ $kelas->mentor->name }}</span>
                    </div>
                    @else
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        <span class="text-amber-600 font-medium">Belum ada mentor</span>
                    </div>
                    @endif
                </div>
                <a href="{{ route('dosen.kelas.show', $kelas) }}" class="inline-flex items-center gap-1 px-4 py-2 bg-violet-600 hover:bg-violet-700 text-white text-sm font-medium rounded-lg transition-colors">
                    {{ $kelas->mentor ? 'Detail' : 'Pilih Mentor' }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-lg border border-gray-200 p-8 text-center">
        <p class="text-gray-500 font-medium">Belum ada kelas.</p>
    </div>
    @endforelse
</div>
@endsection
