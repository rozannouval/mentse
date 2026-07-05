@extends('layouts.admin')
@section('title', 'Manajemen Kelas')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-700">Daftar Kelas Aktif</h2>
        <a href="{{ route('admin.kelas.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold shadow transition">
            + Tambah Kelas Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase font-semibold text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Kelas</th>
                    <th class="px-6 py-3">Mata Kuliah</th>
                    <th class="px-6 py-3">Dosen</th>
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
                    <td class="px-6 py-4">{{ $kelas->dosen->name ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $kelas->mentor->name ?? '-' }}</td>
                    <td class="px-6 py-4 space-x-2">
                        <a href="{{ route('admin.kelas.show', $kelas) }}" class="text-blue-600 hover:underline">Detail</a>
                        <a href="{{ route('admin.kelas.edit', $kelas) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.kelas.destroy', $kelas) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kelas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline cursor-pointer">Hapus</button>
                        </form>
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
