@extends('layouts.admin')
@section('title', 'Tambah Kelas')
@section('active', 'admin.kelas.index')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white rounded-xl border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-base font-semibold text-gray-900">Tambah Kelas Baru</h2>
            <a href="{{ route('admin.kelas.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Kembali</a>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Kelas <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}" required placeholder="Contoh: A2024"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Mata Kuliah <span class="text-red-500">*</span></label>
                        <select name="mata_kuliah_id" required class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            <option value="">Pilih Mata Kuliah</option>
                            @foreach ($mataKuliahs as $mk)
                            <option value="{{ $mk->id }}" {{ old('mata_kuliah_id') == $mk->id ? 'selected' : '' }}>{{ $mk->nama_mata_kuliah }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Dosen <span class="text-red-500">*</span></label>
                        <select name="dosen_id" required class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            <option value="">Pilih Dosen</option>
                            @foreach ($dosens as $d)
                            <option value="{{ $d->id }}" {{ old('dosen_id') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Mentor <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <select name="mentor_id" class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            <option value="">Kosongkan (pilih nanti)</option>
                            @foreach ($mentors as $m)
                            <option value="{{ $m->id }}" {{ old('mentor_id') == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-5 mt-5 border-t border-gray-100">
                    <a href="{{ route('admin.kelas.index') }}" class="text-sm text-gray-500 hover:text-gray-700 font-medium">Batal</a>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors cursor-pointer">
                        Simpan Kelas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
