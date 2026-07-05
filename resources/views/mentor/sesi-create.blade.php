@extends('layouts.mentor')
@section('title', 'Buat Sesi')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 max-w-lg">
    <form action="{{ route('mentor.sesi.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Kelas</label>
            <select name="kelas_id" required
                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-sm">
                @foreach ($kelasList as $kelas)
                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }} - {{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Topik</label>
            <input type="text" name="topik" value="{{ old('topik') }}" required
                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-sm">
        </div>
        <div class="mb-4">
            <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Deskripsi</label>
            <textarea name="deskripsi" rows="3" required
                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-sm">{{ old('deskripsi') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal') }}" required
                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-sm">
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Jam Mulai</label>
                <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}" required
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-sm">
            </div>
            <div>
                <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Jam Selesai</label>
                <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}" required
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-sm">
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Kuota Peserta</label>
            <input type="number" name="kuota" value="{{ old('kuota', 5) }}" min="1" required
                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-sm">
        </div>
        <div class="flex justify-between items-center">
            <a href="{{ route('mentor.sesi.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Batal</a>
            <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2 rounded text-sm font-semibold transition cursor-pointer">Simpan</button>
        </div>
    </form>
</div>
@endsection
