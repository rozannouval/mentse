@extends('layouts.dosen')
@section('title', 'Monitoring')
@section('active', 'dosen.monitoring')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-lg border border-gray-200 border-l-4 border-l-violet-500 p-4">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Sesi</p>
        <p class="text-2xl font-bold text-gray-900 mt-0.5">{{ $totalSesi }}</p>
    </div>
    <div class="bg-white rounded-lg border border-gray-200 border-l-4 border-l-emerald-500 p-4">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Hadir</p>
        <p class="text-2xl font-bold text-gray-900 mt-0.5">{{ $totalHadir }}</p>
    </div>
    <div class="bg-white rounded-lg border border-gray-200 border-l-4 border-l-blue-500 p-4">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Feedback Masuk</p>
        <p class="text-2xl font-bold text-gray-900 mt-0.5">{{ $totalFeedback }}</p>
    </div>
</div>

<div class="space-y-6">
    @forelse ($kelasList as $kelas)
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-semibold text-gray-900">{{ $kelas->nama_kelas }}</h2>
                <p class="text-xs text-gray-500">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }} &middot; Mentor: {{ $kelas->mentor->name ?? '-' }}</p>
            </div>
            <span class="text-xs text-gray-400">{{ $kelas->sesiMentoring->count() }} sesi</span>
        </div>
        <div class="p-5">
            @if ($kelas->sesiMentoring->count() > 0)
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left pb-2 pr-4 text-xs font-semibold text-gray-500 uppercase">Topik</th>
                        <th class="text-left pb-2 pr-4 text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                        <th class="text-left pb-2 pr-4 text-xs font-semibold text-gray-500 uppercase">Peserta</th>
                        <th class="text-left pb-2 pr-4 text-xs font-semibold text-gray-500 uppercase">Hadir</th>
                        <th class="text-left pb-2 text-xs font-semibold text-gray-500 uppercase">Feedback</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($kelas->sesiMentoring as $s)
                    <tr class="hover:bg-gray-50/50">
                        <td class="py-2.5 pr-4 font-medium text-gray-900">{{ $s->topik }}</td>
                        <td class="py-2.5 pr-4 text-gray-500">{{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}</td>
                        <td class="py-2.5 pr-4 text-gray-500">{{ $s->pesertaSesi->count() }}</td>
                        <td class="py-2.5 pr-4 text-emerald-600 font-medium">{{ $s->pesertaSesi->where('status', 'hadir')->count() }}</td>
                        <td class="py-2.5">
                            @php $fbCount = $s->pesertaSesi->filter(fn($ps) => $ps->feedback)->count(); @endphp
                            @if ($fbCount > 0)
                            <span class="text-blue-600 font-medium">{{ $fbCount }}</span>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="text-sm text-gray-400 text-center py-4">Belum ada sesi untuk kelas ini.</p>
            @endif
        </div>
    </div>
    @empty
    <div class="bg-white rounded-lg border border-gray-200 p-8 text-center">
        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
        </svg>
        <p class="text-gray-500 font-medium">Belum ada data monitoring</p>
        <p class="text-gray-400 text-sm mt-1">Data sesi dan feedback akan muncul setelah mentor membuat sesi.</p>
    </div>
    @endforelse
</div>
@endsection
