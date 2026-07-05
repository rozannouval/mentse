@extends('layouts.mentor')
@section('title', 'Edit Sesi')
@section('active', 'mentor.sesi.index')

@section('content')
<x-card title="Edit Sesi Mentoring">
    <form action="{{ route('mentor.sesi.update', $sesi) }}" method="POST" class="max-w-lg">
        @csrf
        @method('PUT')

        <x-select name="kelas_id" label="Kelas"
            :options="$kelasList->map(fn($k) => $k->nama_kelas . ' - ' . ($k->mataKuliah->nama_mata_kuliah ?? ''))->combine($kelasList->pluck('id'))->toArray()"
            value="{{ old('kelas_id', $sesi->kelas_id) }}" required />

        <x-input name="topik" label="Topik Mentoring" value="{{ old('topik', $sesi->topik) }}" required />

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="deskripsi" rows="3" required
                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200">{{ old('deskripsi', $sesi->deskripsi) }}</textarea>
        </div>

        <x-input name="tanggal" label="Tanggal" type="date" value="{{ old('tanggal', $sesi->tanggal) }}" required />

        <div class="grid grid-cols-2 gap-4">
            <x-input name="jam_mulai" label="Jam Mulai" type="time" value="{{ old('jam_mulai', $sesi->jam_mulai) }}" required />
            <x-input name="jam_selesai" label="Jam Selesai" type="time" value="{{ old('jam_selesai', $sesi->jam_selesai) }}" required />
        </div>

        <x-input name="kuota" label="Kuota Peserta" type="number" value="{{ old('kuota', $sesi->kuota) }}" required min="1" />

        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('mentor.sesi.index') }}" class="text-sm text-gray-500 hover:text-gray-700 font-medium">Batal</a>
            <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-sm shadow-amber-500/20 cursor-pointer">
                Simpan Perubahan
            </button>
        </div>
    </form>
</x-card>
@endsection
