@extends('layouts.mentor')
@section('title', 'Peserta')
@section('active', 'mentor.peserta')

@section('content')
<div class="space-y-6">
    @forelse ($mkGroups as $group)
    <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-sm font-semibold text-gray-900">{{ $group->nama_mata_kuliah }}</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Nama Mahasiswa</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">NIM</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Topik Sesi</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Kelas</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($group->peserta as $p)
                    <tr class="hover:bg-gray-50/50">
                        <td class="px-5 py-3.5 font-medium text-gray-900">{{ $p->mahasiswa->name ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-gray-500">{{ $p->mahasiswa->nim ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-gray-600">{{ $p->sesi->topik ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-gray-600 text-xs">{{ $p->sesi->kelas->nama_kelas ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-gray-500 text-xs">{{ $p->sesi ? \Carbon\Carbon::parse($p->sesi->tanggal)->format('d M Y') : '-' }}</td>
                        <td class="px-5 py-3.5"><x-badge type="{{ $p->status }}">{{ ucfirst(str_replace('_', ' ', $p->status)) }}</x-badge></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-xl border border-gray-100 px-5 py-10 text-center text-gray-400">
        Belum ada peserta yang terdaftar.
    </div>
    @endforelse
</div>
@endsection
