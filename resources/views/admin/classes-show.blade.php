@extends('layouts.admin')
@section('title', 'Detail Kelas')
@section('active', 'admin.kelas.index')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-5 mb-6">
    <div class="lg:col-span-3 bg-white rounded-lg border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-base font-semibold text-gray-900">Informasi Kelas</h2>
            <a href="{{ route('admin.kelas.index') }}" class="text-sm text-blue-600 hover:text-blue-800">&larr; Kembali</a>
        </div>
        <div class="p-5">
            <dl class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div class="p-3 bg-gray-50 rounded-lg">
                    <dt class="text-gray-500 text-xs">Nama Kelas</dt>
                    <dd class="font-semibold text-gray-900 mt-0.5">{{ $kelas->nama_kelas }}</dd>
                </div>
                <div class="p-3 bg-gray-50 rounded-lg">
                    <dt class="text-gray-500 text-xs">Mata Kuliah</dt>
                    <dd class="font-semibold text-gray-900 mt-0.5">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</dd>
                </div>
                <div class="p-3 bg-gray-50 rounded-lg">
                    <dt class="text-gray-500 text-xs">Dosen</dt>
                    <dd class="font-semibold text-gray-900 mt-0.5">{{ $kelas->dosen->name ?? '-' }}</dd>
                </div>
                <div class="p-3 bg-gray-50 rounded-lg">
                    <dt class="text-gray-500 text-xs">Mentor</dt>
                    <dd class="font-semibold text-gray-900 mt-0.5">
                        @if ($kelas->mentor)
                        <span class="text-emerald-600">{{ $kelas->mentor->name }}</span>
                        @else
                        <span class="text-amber-600">Belum ditunjuk</span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-900">Ringkasan</h2>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-2 gap-3 text-center">
                <div class="p-3 bg-blue-50 rounded-lg">
                    <p class="text-xl font-bold text-blue-600">{{ $kelas->pesertaKelas->count() }}</p>
                    <p class="text-xs text-gray-500">Peserta</p>
                </div>
                <div class="p-3 bg-violet-50 rounded-lg">
                    <p class="text-xl font-bold text-violet-600">{{ $kelas->sesiMentoring->count() }}</p>
                    <p class="text-xs text-gray-500">Sesi</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg border border-gray-200">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="text-base font-semibold text-gray-900">
            Peserta Kelas
            <span class="ml-2 text-sm font-normal text-gray-400">({{ $kelas->pesertaKelas->count() }} orang)</span>
        </h2>
        <button onclick="openModal('modal-peserta')" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded transition-colors cursor-pointer">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            Tambah Mahasiswa
        </button>
    </div>
    <div class="p-5">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">No</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Mahasiswa</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Email</th>
                    <th class="text-left pb-3 text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($kelas->pesertaKelas as $key => $pk)
                <tr class="hover:bg-gray-50/50">
                    <td class="py-3 pr-4 text-gray-500">{{ $key + 1 }}</td>
                    <td class="py-3 pr-4">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-500">
                                {{ strtoupper(substr($pk->mahasiswa->name ?? '?', 0, 1)) }}
                            </div>
                            <span class="font-medium text-gray-900">{{ $pk->mahasiswa->name ?? '-' }}</span>
                        </div>
                    </td>
                    <td class="py-3 pr-4 text-gray-500">{{ $pk->mahasiswa->email ?? '-' }}</td>
                    <td class="py-3">
                        <form action="{{ route('admin.kelas.peserta.destroy', [$kelas, $pk]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus {{ $pk->mahasiswa->name ?? 'peserta' }} dari kelas?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:text-red-800 text-sm font-medium cursor-pointer">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-8 text-center text-gray-400">Belum ada peserta.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<x-modal id="modal-peserta" title="Tambah Mahasiswa ke Kelas">
    <form action="{{ route('admin.kelas.peserta.store', $kelas) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Pilih Mahasiswa <span class="text-red-500">*</span></label>
            <select name="mahasiswa_id" required class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                <option value="">Pilih Mahasiswa</option>
                @foreach ($mahasiswas as $m)
                <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->email }})</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeModal('modal-peserta')" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 font-medium cursor-pointer">Batal</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors cursor-pointer">Tambah</button>
        </div>
    </form>
</x-modal>
@endsection
