@extends('layouts.dosen')
@section('title', 'Kelas Saya')
@section('active', 'dosen.kelas.index')

@section('content')
@if ($kelasList->isEmpty())
<div class="text-center py-16">
    <p class="text-gray-900 font-medium">Belum ada kelas</p>
    <p class="text-sm text-gray-500 mt-1">Anda belum ditugaskan ke kelas mana pun.</p>
</div>
@else
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($kelasList as $kelas)
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-start justify-between mb-3">
            <div>
                <h3 class="font-semibold text-gray-900">{{ $kelas->nama_kelas }}</h3>
                <p class="text-sm text-gray-500">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</p>
            </div>
        </div>
        <div class="text-sm text-gray-500 mb-4">
            @if ($kelas->mentor)
            <p>Mentor: {{ $kelas->mentor->name }}</p>
            @else
            <p class="text-amber-600">Belum ada mentor</p>
            @endif
            <p class="mt-1">{{ $kelas->sesiMentoring->count() }} sesi &middot; {{ $kelas->mahasiswa->count() }} mahasiswa</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('dosen.kelas.show', $kelas) }}" class="px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors">
                Detail
            </a>
            @if (!$kelas->mentor)
            <a href="{{ route('dosen.kelas.show', $kelas) }}" class="px-4 py-2 text-sm font-medium text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">
                Pilih Mentor
            </a>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection