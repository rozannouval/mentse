@extends('layouts.mahasiswa')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-500 uppercase">Kelas Saya</p>
        <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $totalKelas }}</p>
    </div>
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-500 uppercase">Sesi Tersedia</p>
        <p class="text-3xl font-bold text-blue-600 mt-1">{{ $totalSesiTersedia }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Kelas Saya</h2>
        @forelse ($kelasList as $kelas)
        <div class="border-b border-gray-100 pb-3 mb-3 last:border-0 last:pb-0 last:mb-0">
            <p class="font-medium text-gray-800">{{ $kelas->nama_kelas }}</p>
            <p class="text-xs text-gray-500">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</p>
            <p class="text-xs text-gray-500">Dosen: {{ $kelas->dosen->name ?? '-' }} | Mentor: {{ $kelas->mentor->name ?? '-' }}</p>
        </div>
        @empty
        <p class="text-sm text-gray-400">Anda belum terdaftar di kelas mana pun.</p>
        @endforelse
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Riwayat Sesi Terbaru</h2>
        @forelse ($riwayatSesi as $ps)
        <div class="border-b border-gray-100 pb-3 mb-3 last:border-0 last:pb-0 last:mb-0">
            <p class="font-medium text-gray-800">{{ $ps->sesi->topik ?? '-' }}</p>
            <p class="text-xs text-gray-500">{{ $ps->sesi->kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</p>
            <span class="px-2 py-0.5 text-xs rounded-full 
                {{ $ps->status == 'hadir' ? 'bg-green-100 text-green-700' : '' }}
                {{ $ps->status == 'tidak_hadir' ? 'bg-red-100 text-red-700' : '' }}
                {{ $ps->status == 'terdaftar' ? 'bg-blue-100 text-blue-700' : '' }}">
                {{ ucfirst(str_replace('_', ' ', $ps->status)) }}
            </span>
        </div>
        @empty
        <p class="text-sm text-gray-400">Belum ada sesi yang diikuti.</p>
        @endforelse
    </div>
</div>
@endsection
