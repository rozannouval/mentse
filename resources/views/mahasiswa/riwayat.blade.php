@extends('layouts.mahasiswa')
@section('title', 'Riwayat Sesi')
@section('active', 'mahasiswa.riwayat')

@section('content')
<div class="bg-white rounded-lg border border-gray-200">
    <div class="px-5 py-4 border-b border-gray-100">
        <h2 class="text-base font-semibold text-gray-900">Riwayat Belajar</h2>
    </div>
    <div class="p-5">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Mata Kuliah</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Topik Sesi</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Mentor</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Status</th>
                    <th class="text-left pb-3 text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($riwayatSesi as $ps)
                <tr class="hover:bg-gray-50/50">
                    <td class="py-3 pr-4 text-gray-500">{{ $ps->sesi->kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</td>
                    <td class="py-3 pr-4 font-medium text-gray-900">{{ $ps->sesi->topik ?? '-' }}</td>
                    <td class="py-3 pr-4 text-gray-500">{{ $ps->sesi->kelas->mentor->name ?? '-' }}</td>
                    <td class="py-3 pr-4 text-gray-500">
                        {{ $ps->sesi ? \Carbon\Carbon::parse($ps->sesi->tanggal)->format('d M Y') : '-' }}<br>
                        <span class="text-gray-400">{{ $ps->sesi->jam_mulai ?? '' }}</span>
                    </td>
                    <td class="py-3 pr-4"><x-badge type="{{ $ps->status }}">{{ ucfirst(str_replace('_', ' ', $ps->status)) }}</x-badge></td>
                    <td class="py-3">
                        @if ($ps->status == 'hadir' && !$ps->feedback)
                        <a href="{{ route('mahasiswa.feedback.create', $ps) }}" class="inline-flex items-center px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium rounded-lg transition-all duration-200 shadow-sm shadow-emerald-600/20 cursor-pointer">Isi Feedback</a>
                        @elseif ($ps->status == 'hadir' && $ps->feedback)
                        <span class="text-emerald-600 text-xs font-medium">Feedback submitted</span>
                        @elseif ($ps->status == 'tidak_hadir')
                        <span class="text-gray-400 text-xs italic">Feedback Dikunci</span>
                        @else
                        <span class="text-gray-400 text-xs italic">Belum Dimulai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-8 text-center text-gray-400">Belum ada sesi yang diikuti.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
