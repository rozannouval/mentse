@extends('layouts.dosen')
@section('title', 'Monitoring')
@section('active', 'dosen.monitoring')

@section('content')
<div class="grid grid-cols-3 gap-4 mb-8">
    <x-stat title="Total Sesi" :value="$totalSesi" color="violet" />
    <x-stat title="Total Hadir" :value="$totalHadir" color="green" />
    <x-stat title="Feedback Masuk" :value="$totalFeedback" color="blue" />
</div>

<div class="space-y-4">
    @forelse ($kelasList as $kelas)
    <div class="bg-white rounded-xl border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="text-[15px] font-semibold text-gray-900">{{ $kelas->nama_kelas }}</h2>
                <p class="text-xs text-gray-500">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }} &middot; {{ $kelas->mentor->name ?? '-' }}</p>
            </div>
            <span class="text-xs text-gray-400">{{ $kelas->sesiMentoring->count() }} sesi</span>
        </div>

        @if ($kelas->sesiMentoring->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-50">
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Topik</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Tanggal</th>
                        <th class="text-center px-5 py-3 text-xs font-medium text-gray-500">Peserta</th>
                        <th class="text-center px-5 py-3 text-xs font-medium text-gray-500">Hadir</th>
                        <th class="text-center px-5 py-3 text-xs font-medium text-gray-500">%</th>
                        <th class="text-center px-5 py-3 text-xs font-medium text-gray-500">Feedback</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($kelas->sesiMentoring as $s)
                    @php
                        $total = $s->pesertaSesi->count();
                        $hadir = $s->pesertaSesi->where('status', 'hadir')->count();
                        $pct = $total > 0 ? round(($hadir / $total) * 100) : 0;
                        $fbCount = $s->pesertaSesi->filter(fn($ps) => $ps->feedback)->count();
                    @endphp
                    <tr class="hover:bg-gray-50/50">
                        <td class="px-5 py-3.5 font-medium text-gray-900">{{ $s->topik }}</td>
                        <td class="px-5 py-3.5 text-gray-500 text-xs">{{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}</td>
                        <td class="px-5 py-3.5 text-center text-gray-600">{{ $total }}</td>
                        <td class="px-5 py-3.5 text-center text-emerald-600 font-medium">{{ $hadir }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-center gap-2">
                                <div class="w-12 h-1 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full {{ $pct >= 75 ? 'bg-emerald-400' : ($pct >= 50 ? 'bg-amber-400' : 'bg-red-400') }}" style="width: {{ $pct }}%"></div>
                                </div>
                                <span class="text-xs {{ $pct >= 75 ? 'text-emerald-600' : ($pct >= 50 ? 'text-amber-600' : 'text-red-600') }}">{{ $pct }}%</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-center">
                            @if ($fbCount > 0)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700">{{ $fbCount }}</span>
                            @else
                            <span class="text-gray-300 text-xs">&ndash;</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="p-5 text-center">
            <p class="text-sm text-gray-400">Belum ada sesi untuk kelas ini.</p>
        </div>
        @endif
    </div>
    @empty
    <div class="text-center py-16">
        <p class="text-gray-900 font-medium">Belum ada data monitoring</p>
        <p class="text-sm text-gray-500 mt-1">Data akan muncul setelah mentor membuat sesi.</p>
    </div>
    @endforelse
</div>
@endsection