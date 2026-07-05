@extends('layouts.admin')
@section('title', 'Detail Kelas')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
    <h2 class="text-lg font-semibold text-gray-700 mb-4">Informasi Kelas</h2>
    <div class="grid grid-cols-2 gap-4 text-sm">
        <div><span class="text-gray-500">Nama Kelas:</span> <span class="font-semibold">{{ $kelas->nama_kelas }}</span></div>
        <div><span class="text-gray-500">Mata Kuliah:</span> <span class="font-semibold">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</span></div>
        <div><span class="text-gray-500">Dosen:</span> <span class="font-semibold">{{ $kelas->dosen->name ?? '-' }}</span></div>
        <div><span class="text-gray-500">Mentor:</span> <span class="font-semibold">{{ $kelas->mentor->name ?? '-' }}</span></div>
    </div>
    <a href="{{ route('admin.kelas.index') }}" class="text-blue-600 hover:underline text-sm mt-4 inline-block">Kembali</a>
</div>

<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-700">Daftar Peserta Kelas</h2>
        <button onclick="document.getElementById('modal-peserta').classList.remove('hidden')"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold shadow transition cursor-pointer">
            + Tambah Mahasiswa
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase font-semibold text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-700">
                @forelse ($kelas->pesertaKelas as $key => $pk)
                <tr>
                    <td class="px-6 py-4">{{ $key + 1 }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $pk->mahasiswa->name ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $pk->mahasiswa->email ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.kelas.peserta.destroy', [$kelas, $pk]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus peserta ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline cursor-pointer">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-400">Belum ada peserta.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modal-peserta" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md mx-4">
        <h3 class="text-lg font-semibold mb-4">Tambah Mahasiswa ke Kelas</h3>
        <form action="{{ route('admin.kelas.peserta.store', $kelas) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Mahasiswa</label>
                <select name="mahasiswa_id" required
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
                    <option value="">Pilih Mahasiswa</option>
                    @foreach ($mahasiswas as $m)
                    <option value="{{ $m->id }}">{{ $m->name }} - {{ $m->email }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="document.getElementById('modal-peserta').classList.add('hidden')"
                    class="px-4 py-2 text-sm text-gray-500 hover:text-gray-700 cursor-pointer">Batal</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold cursor-pointer">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
