@extends('layouts.admin')
@section('title', 'Tambah Kelas')
@section('active', 'admin.kelas.index')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white rounded-xl border border-slate-100 shadow-sm">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-base font-semibold text-slate-900">Tambah Kelas Baru</h2>
            <a href="{{ route('admin.kelas.index') }}" class="text-sm text-slate-500 hover:text-slate-700 font-medium">&larr; Kembali</a>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Kelas <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}" required placeholder="Contoh: A2024"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Mata Kuliah <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="mata_kuliah_id" required class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 pr-9 text-sm text-slate-900 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all bg-white">
                                <option value="">Pilih Mata Kuliah</option>
                                @foreach ($mataKuliahs as $mk)
                                <option value="{{ $mk->id }}" {{ old('mata_kuliah_id') == $mk->id ? 'selected' : '' }}>{{ $mk->nama_mata_kuliah }}</option>
                                @endforeach
                            </select>
                            <svg class="w-4 h-4 text-slate-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Dosen <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="dosen_id" required class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 pr-9 text-sm text-slate-900 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all bg-white">
                                <option value="">Pilih Dosen</option>
                                @foreach ($dosens as $d)
                                <option value="{{ $d->id }}" {{ old('dosen_id') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                                @endforeach
                            </select>
                            <svg class="w-4 h-4 text-slate-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Mentor <span class="text-slate-400 font-normal">(opsional)</span></label>
                        <div class="relative">
                            <select name="mentor_id" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 pr-9 text-sm text-slate-900 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all bg-white">
                                <option value="">Kosongkan (pilih nanti)</option>
                                @foreach ($mentors as $m)
                                <option value="{{ $m->id }}" {{ old('mentor_id') == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                                @endforeach
                            </select>
                            <svg class="w-4 h-4 text-slate-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-5 mt-5 border-t border-slate-100">
                    <a href="{{ route('admin.kelas.index') }}" class="text-sm text-slate-500 hover:text-slate-700 font-medium">Batal</a>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors cursor-pointer shadow-sm shadow-blue-600/20">
                        Simpan Kelas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
