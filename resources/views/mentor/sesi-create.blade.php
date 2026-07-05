@extends('layouts.mentor')
@section('title', 'Buat Sesi Baru')
@section('active', 'mentor.sesi.index')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl border border-slate-100 shadow-sm">
        <div class="px-6 py-5 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-semibold text-slate-900">Buat Sesi Mentoring Baru</h2>
                    <p class="text-xs text-slate-500">{{ $kelas->nama_kelas }} &middot; {{ $kelas->mataKuliah->nama_mata_kuliah ?? '' }}</p>
                </div>
            </div>
        </div>

        <form action="{{ route('mentor.sesi.store') }}" method="POST" class="p-6">
            @csrf

            <div class="mb-5">
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Kelas <span class="text-red-500">*</span></label>
                <div class="flex items-center gap-2 px-3.5 py-2.5 bg-slate-50 rounded-lg border border-slate-200 text-sm text-slate-600">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    {{ $kelas->nama_kelas }} &middot; {{ $kelas->mataKuliah->nama_mata_kuliah ?? '' }}
                </div>
            </div>

            <div class="mb-5">
                <label for="topik" class="block text-sm font-medium text-slate-700 mb-1.5">Topik Mentoring <span class="text-red-500">*</span></label>
                <input type="text" id="topik" name="topik" value="{{ old('topik') }}" required placeholder="Contoh: Pengenalan Laravel"
                    class="block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 appearance-none focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200">
                @error('topik')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi <span class="text-red-500">*</span></label>
                <textarea id="deskripsi" name="deskripsi" rows="4" required placeholder="Jelaskan apa yang akan dibahas dalam sesi ini"
                    class="block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200 resize-y">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required
                        class="block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 appearance-none focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200">
                    @error('tanggal')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="kuota" class="block text-sm font-medium text-slate-700 mb-1.5">Kuota Peserta <span class="text-red-500">*</span></label>
                    <input type="number" id="kuota" name="kuota" value="{{ old('kuota', 5) }}" required min="1"
                        class="block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 appearance-none focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200">
                    @error('kuota')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Waktu <span class="text-red-500">*</span></label>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-3 px-3.5 py-2.5 border border-slate-300 rounded-lg focus-within:ring-2 focus-within:ring-amber-500/20 focus-within:border-amber-500 transition-all duration-200">
                        <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <input type="time" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}" required
                            class="w-full text-sm text-slate-900 appearance-none focus:outline-none bg-transparent border-0 p-0">
                    </div>
                    <div class="flex items-center gap-3 px-3.5 py-2.5 border border-slate-300 rounded-lg focus-within:ring-2 focus-within:ring-amber-500/20 focus-within:border-amber-500 transition-all duration-200">
                        <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <input type="time" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}" required
                            class="w-full text-sm text-slate-900 appearance-none focus:outline-none bg-transparent border-0 p-0">
                    </div>
                </div>
                @error('jam_mulai')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
                @error('jam_selesai')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                <a href="{{ route('mentor.sesi.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-700 font-medium transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-sm shadow-amber-500/20 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Buat Sesi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
