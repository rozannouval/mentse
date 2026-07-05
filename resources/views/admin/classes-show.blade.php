@extends('layouts.admin')
@section('title', 'Detail Kelas')
@section('active', 'admin.kelas.index')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-5 mb-6">
    <div class="lg:col-span-3 bg-white rounded-xl border border-slate-100 shadow-sm">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-base font-semibold text-slate-900">Informasi Kelas</h2>
            <a href="{{ route('admin.kelas.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">&larr; Kembali</a>
        </div>
        <div class="p-5">
            <dl class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div class="p-3 bg-slate-50 rounded-xl">
                    <dt class="text-slate-500 text-xs">Nama Kelas</dt>
                    <dd class="font-semibold text-slate-900 mt-0.5">{{ $kelas->nama_kelas }}</dd>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl">
                    <dt class="text-slate-500 text-xs">Mata Kuliah</dt>
                    <dd class="font-semibold text-slate-900 mt-0.5">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</dd>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl">
                    <dt class="text-slate-500 text-xs">Dosen</dt>
                    <dd class="font-semibold text-slate-900 mt-0.5">{{ $kelas->dosen->name ?? '-' }}</dd>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl">
                    <dt class="text-slate-500 text-xs">Mentor</dt>
                    <dd class="font-semibold text-slate-900 mt-0.5">
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

    <div class="bg-white rounded-xl border border-slate-100 shadow-sm">
        <div class="px-5 py-4 border-b border-slate-100">
            <h2 class="text-base font-semibold text-slate-900">Ringkasan</h2>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-2 gap-3 text-center">
                <div class="p-3 bg-blue-50 rounded-xl">
                    <p class="text-xl font-bold text-blue-600">{{ $pesertaKelas->count() }}</p>
                    <p class="text-xs text-slate-500">Peserta</p>
                </div>
                <div class="p-3 bg-violet-50 rounded-xl">
                    <p class="text-xl font-bold text-violet-600">{{ $kelas->sesiMentoring->count() }}</p>
                    <p class="text-xs text-slate-500">Sesi</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl border border-slate-100 shadow-sm">
    <div class="px-5 py-4 border-b border-slate-100">
        <h2 class="text-base font-semibold text-slate-900">
            Peserta Kelas
            <span class="ml-2 text-sm font-normal text-slate-400">({{ $pesertaKelas->count() }} orang)</span>
        </h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-100 bg-slate-50/50">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">No</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Mahasiswa</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">NIM</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Email</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse ($pesertaKelas as $key => $m)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-5 py-3.5 text-slate-500">{{ $key + 1 }}</td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-500">
                                {{ strtoupper(substr($m->name, 0, 1)) }}
                            </div>
                            <span class="font-medium text-slate-900">{{ $m->name }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3.5 text-slate-500 font-mono text-xs">{{ $m->nim ?? '-' }}</td>
                    <td class="px-5 py-3.5 text-slate-500 text-xs">{{ $m->email }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-5 py-10 text-center text-slate-400">Belum ada peserta.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
