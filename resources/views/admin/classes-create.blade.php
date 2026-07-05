@extends('layouts.admin')
@section('title', 'Tambah Kelas')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 max-w-lg">
    <form action="{{ route('admin.kelas.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Nama Kelas</label>
            <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}" required
                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
        </div>
        <div class="mb-4">
            <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Mata Kuliah</label>
            <select name="mata_kuliah_id" required
                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
                <option value="">Pilih Mata Kuliah</option>
                @foreach ($mataKuliahs as $mk)
                <option value="{{ $mk->id }}">{{ $mk->nama_mata_kuliah }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Dosen</label>
            <select name="dosen_id" required
                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
                <option value="">Pilih Dosen</option>
                @foreach ($dosens as $d)
                <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Mentor <span class="text-gray-400 font-normal">(opsional, bisa diisi nanti oleh dosen)</span></label>
            <select name="mentor_id"
                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
                <option value="">Pilih Mentor (Opsional)</option>
                @foreach ($mentors as $m)
                <option value="{{ $m->id }}">{{ $m->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-between items-center">
            <a href="{{ route('admin.kelas.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded text-sm font-semibold transition cursor-pointer">Simpan</button>
        </div>
    </form>
</div>
@endsection
