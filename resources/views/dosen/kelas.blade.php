@extends('layouts.dosen')
@section('title', 'Kelas Saya')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase font-semibold text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Kelas</th>
                    <th class="px-6 py-3">Mata Kuliah</th>
                    <th class="px-6 py-3">Mentor</th>
                    <th class="px-6 py-3">Jumlah Sesi</th>
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
                            <span class="text-amber-600">Belum ditunjuk</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $kelas->sesiMentoring_count ?? 0 }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('dosen.kelas.show', $kelas) }}" class="text-blue-600 hover:underline">Detail & Pilih Mentor</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-400">Belum ada kelas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
