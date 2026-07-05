@extends('layouts.mentor')
@section('title', 'Peserta')
@section('active', 'mentor.peserta')

@section('content')
<div class="bg-white rounded-xl border border-slate-200">
    <div class="px-5 py-4 border-b border-slate-100">
        <h2 class="text-base font-semibold text-slate-900">Riwayat Peserta</h2>
        <p class="text-xs text-slate-500 mt-0.5">Seluruh mahasiswa yang pernah mengikuti sesi anda</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-100 bg-slate-50/50">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Nama Mahasiswa</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">NIM</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Mata Kuliah</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Topik Sesi</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Tanggal</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse ($pesertaList as $p)
                <tr class="hover:bg-slate-50/50">
                    <td class="px-5 py-3.5 font-medium text-slate-900">{{ $p->mahasiswa->name ?? '-' }}</td>
                    <td class="px-5 py-3.5 text-slate-500">{{ $p->mahasiswa->nim ?? '-' }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $p->sesi->kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $p->sesi->topik ?? '-' }}</td>
                    <td class="px-5 py-3.5 text-slate-500 text-xs">{{ $p->sesi ? \Carbon\Carbon::parse($p->sesi->tanggal)->format('d M Y') : '-' }}</td>
                    <td class="px-5 py-3.5"><x-badge type="{{ $p->status }}">{{ ucfirst(str_replace('_', ' ', $p->status)) }}</x-badge></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-10 text-center text-slate-400">Belum ada peserta yang terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection