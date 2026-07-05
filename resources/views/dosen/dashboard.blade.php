@extends('layouts.dosen')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-500 uppercase">Kelas Saya</p>
        <p class="text-3xl font-bold text-purple-600 mt-1">{{ $totalKelas }}</p>
    </div>
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-500 uppercase">Total Sesi Mentoring</p>
        <p class="text-3xl font-bold text-blue-600 mt-1">{{ $totalSesi }}</p>
    </div>
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-500 uppercase">Kelas Tanpa Mentor</p>
        <p class="text-3xl font-bold text-amber-600 mt-1">{{ $kelasTanpaMentor }}</p>
    </div>
</div>

<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-700">Kelas Saya</h2>
        <a href="{{ route('dosen.kelas.index') }}" class="text-blue-600 hover:underline text-sm">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase font-semibold text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Kelas</th>
                    <th class="px-6 py-3">Mata Kuliah</th>
                    <th class="px-6 py-3">Mentor</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-700">
                @forelse ($kelasList as $key => $kelas)
                <tr>
                    <td class="px-6 py-4">{{ $key + 1 }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $kelas->nama_kelas }}</td>
                    <td class="px-6 py-4">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</td>
                    <td class="px-6 py-4">
                        @if ($kelas->mentor)
                            <span class="text-green-600">{{ $kelas->mentor->name }}</span>
                        @else
                            <span class="text-amber-600">Belum ada mentor</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('dosen.kelas.show', $kelas) }}" class="text-blue-600 hover:underline">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-400">Belum ada kelas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
