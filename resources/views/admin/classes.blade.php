@extends('layouts.admin')
@section('title', 'Manajemen Kelas')
@section('active', 'admin.kelas.index')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg border border-gray-200 border-l-4 border-l-blue-500 p-4">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Kelas</p>
        <p class="text-xl font-bold text-gray-900 mt-0.5">{{ $kelasList->count() }}</p>
    </div>
    <div class="bg-white rounded-lg border border-gray-200 border-l-4 border-l-emerald-500 p-4">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Ada Mentor</p>
        <p class="text-xl font-bold text-gray-900 mt-0.5">{{ $kelasList->filter(fn($k) => $k->mentor_id)->count() }}</p>
    </div>
    <div class="bg-white rounded-lg border border-gray-200 border-l-4 border-l-amber-500 p-4">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Tanpa Mentor</p>
        <p class="text-xl font-bold text-gray-900 mt-0.5">{{ $kelasList->filter(fn($k) => !$k->mentor_id)->count() }}</p>
    </div>
    <div class="bg-white rounded-lg border border-gray-200 border-l-4 border-l-indigo-500 p-4">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Peserta</p>
        <p class="text-xl font-bold text-gray-900 mt-0.5">{{ $kelasList->sum(fn($k) => $k->pesertaKelas->count()) }}</p>
    </div>
</div>

<div class="bg-white rounded-lg border border-gray-200">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="text-base font-semibold text-gray-900">Daftar Kelas</h2>
        <a href="{{ route('admin.kelas.create') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Kelas
        </a>
    </div>
    <div class="p-5">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">No</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Kelas</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Mata Kuliah</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Dosen</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Mentor</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Peserta</th>
                    <th class="text-left pb-3 text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($kelasList as $key => $kelas)
                <tr class="hover:bg-gray-50/50">
                    <td class="py-3 pr-4 text-gray-500">{{ $key + 1 }}</td>
                    <td class="py-3 pr-4 font-medium text-gray-900">{{ $kelas->nama_kelas }}</td>
                    <td class="py-3 pr-4 text-gray-500">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</td>
                    <td class="py-3 pr-4 text-gray-500">{{ $kelas->dosen->name ?? '-' }}</td>
                    <td class="py-3 pr-4">
                        @if ($kelas->mentor)
                        <span class="text-emerald-600 font-medium">{{ $kelas->mentor->name }}</span>
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="py-3 pr-4 text-gray-500">{{ $kelas->pesertaKelas->count() }}</td>
                    <td class="py-3">
                        <a href="{{ route('admin.kelas.show', $kelas) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium mr-3">Detail</a>
                        <a href="{{ route('admin.kelas.edit', $kelas) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium mr-3">Edit</a>
                        <form action="{{ route('admin.kelas.destroy', $kelas) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kelas {{ $kelas->nama_kelas }}?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:text-red-800 text-sm font-medium cursor-pointer">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-8 text-center text-gray-400">Belum ada kelas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
