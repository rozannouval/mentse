@extends('layouts.mentor')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-500 uppercase">Kelas Saya</p>
        <p class="text-3xl font-bold text-amber-600 mt-1">{{ $kelasList->count() }}</p>
    </div>
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-500 uppercase">Total Sesi</p>
        <p class="text-3xl font-bold text-blue-600 mt-1">{{ $totalSesi }}</p>
    </div>
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-500 uppercase">Total Peserta</p>
        <p class="text-3xl font-bold text-green-600 mt-1">{{ $totalPeserta }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Kelas Saya</h2>
        @foreach ($kelasList as $kelas)
        <div class="border-b border-gray-100 pb-3 mb-3 last:border-0 last:pb-0 last:mb-0">
            <p class="font-medium text-gray-800">{{ $kelas->nama_kelas }}</p>
            <p class="text-xs text-gray-500">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</p>
            <p class="text-xs text-gray-500">Dosen: {{ $kelas->dosen->name ?? '-' }}</p>
        </div>
        @endforeach
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Sesi Mendatang</h2>
            <a href="{{ route('mentor.sesi.create') }}" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded text-sm font-semibold transition cursor-pointer">
                + Buat Sesi
            </a>
        </div>
        @forelse ($sesiMendatang as $sesi)
        <div class="border-b border-gray-100 pb-3 mb-3 last:border-0 last:pb-0 last:mb-0">
            <p class="font-medium text-gray-800">{{ $sesi->topik }}</p>
            <p class="text-xs text-gray-500">{{ $sesi->kelas->nama_kelas }} - {{ \Carbon\Carbon::parse($sesi->tanggal)->format('d M Y') }} {{ $sesi->jam_mulai }}-{{ $sesi->jam_selesai }}</p>
        </div>
        @empty
        <p class="text-sm text-gray-400">Belum ada sesi mendatang.</p>
        @endforelse
    </div>
</div>
@endsection
