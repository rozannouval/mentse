@extends('layouts.mahasiswa')
@section('title', 'Riwayat Sesi')

@section('content')
<div class="bg-white shadow-sm border border-gray-100 rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-emerald-700 text-white text-xs uppercase tracking-wider">
                <tr>
                    <th class="p-4 font-semibold">Mata Kuliah</th>
                    <th class="p-4 font-semibold">Topik Sesi</th>
                    <th class="p-4 font-semibold">Mentor</th>
                    <th class="p-4 font-semibold">Tanggal & Waktu</th>
                    <th class="p-4 font-semibold">Status</th>
                    <th class="p-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse ($riwayatSesi as $ps)
                <tr class="hover:bg-gray-50/70 transition-colors">
                    <td class="p-4 font-semibold text-gray-800">{{ $ps->sesi->kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</td>
                    <td class="p-4 text-gray-500 text-xs">{{ $ps->sesi->topik ?? '-' }}</td>
                    <td class="p-4 text-gray-600">{{ $ps->sesi->kelas->mentor->name ?? '-' }}</td>
                    <td class="p-4 text-gray-500 text-xs">
                        {{ $ps->sesi ? \Carbon\Carbon::parse($ps->sesi->tanggal)->format('d M Y') . ' • ' . $ps->sesi->jam_mulai : '-' }}
                    </td>
                    <td class="p-4">
                        <span class="px-2.5 py-1 text-xs font-medium rounded-md 
                            {{ $ps->status == 'hadir' ? 'bg-green-50 text-green-700' : '' }}
                            {{ $ps->status == 'tidak_hadir' ? 'bg-red-50 text-red-700' : '' }}
                            {{ $ps->status == 'terdaftar' ? 'bg-blue-50 text-blue-700' : '' }}
                            {{ $ps->status == 'dibatalkan' ? 'bg-gray-50 text-gray-600' : '' }}">
                            {{ ucfirst(str_replace('_', ' ', $ps->status)) }}
                        </span>
                    </td>
                    <td class="p-4 text-center">
                        @if ($ps->status == 'hadir' && !$ps->feedback)
                            <a href="{{ route('mahasiswa.feedback.create', $ps) }}" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium px-3 py-1.5 rounded-md transition-colors shadow-sm">
                                Isi Feedback
                            </a>
                        @elseif ($ps->status == 'hadir' && $ps->feedback)
                            <span class="text-green-600 text-xs font-medium">Feedback已提交</span>
                        @elseif ($ps->status == 'tidak_hadir')
                            <span class="text-gray-400 text-xs italic">Feedback Dikunci</span>
                        @else
                            <span class="text-gray-400 text-xs italic">Belum Dimulai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-400">Belum ada sesi yang diikuti.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
