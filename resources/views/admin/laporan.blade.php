@extends('layouts.admin')
@section('title', 'Laporan & Statistik')
@section('active', 'admin.laporan')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <x-stat title="Total Sesi" :value="$totalSesi" color="blue" />
    <x-stat title="Total Hadir" :value="$totalHadir" color="green" />
    <x-stat title="Tidak Hadir" :value="$totalTidakHadir" color="red" />
    <x-stat title="Rate Kehadiran" :value="$rateKehadiran . '%'" color="amber" />
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-xl border border-slate-100 shadow-sm">
        <div class="px-5 py-4 border-b border-slate-100">
            <h2 class="text-base font-semibold text-slate-900">Ringkasan User</h2>
        </div>
        <div class="p-5">
            <div class="space-y-3">
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                        <span class="text-sm text-slate-600">Total User</span>
                    </div>
                    <span class="text-sm font-semibold text-slate-900">{{ $totalUser }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-violet-500"></span>
                        <span class="text-sm text-slate-600">Dosen</span>
                    </div>
                    <span class="text-sm font-semibold text-slate-900">{{ $totalDosen }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                        <span class="text-sm text-slate-600">Mentor</span>
                    </div>
                    <span class="text-sm font-semibold text-slate-900">{{ $totalMentor }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        <span class="text-sm text-slate-600">Mahasiswa</span>
                    </div>
                    <span class="text-sm font-semibold text-slate-900">{{ $totalMahasiswa }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-indigo-500"></span>
                        <span class="text-sm text-slate-600">Kelas</span>
                    </div>
                    <span class="text-sm font-semibold text-slate-900">{{ $totalKelas }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-teal-500"></span>
                        <span class="text-sm text-slate-600">Feedback</span>
                    </div>
                    <span class="text-sm font-semibold text-slate-900">{{ $totalFeedback }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-100 shadow-sm">
        <div class="px-5 py-4 border-b border-slate-100">
            <h2 class="text-base font-semibold text-slate-900">Statistik Kehadiran</h2>
        </div>
        <div class="p-5">
            <div class="flex items-end justify-center gap-8 py-4">
                <div class="text-center">
                    <div class="w-20 h-20 rounded-full border-4 border-emerald-500 flex items-center justify-center mx-auto mb-2">
                        <span class="text-xl font-bold text-emerald-600">{{ $totalHadir }}</span>
                    </div>
                    <p class="text-xs font-medium text-slate-500">Hadir</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 rounded-full border-4 border-red-500 flex items-center justify-center mx-auto mb-2">
                        <span class="text-xl font-bold text-red-600">{{ $totalTidakHadir }}</span>
                    </div>
                    <p class="text-xs font-medium text-slate-500">Tidak Hadir</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 rounded-full border-4 border-amber-500 flex items-center justify-center mx-auto mb-2">
                        <span class="text-xl font-bold text-amber-600">{{ $rateKehadiran }}%</span>
                    </div>
                    <p class="text-xs font-medium text-slate-500">Rate</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl border border-slate-100 shadow-sm">
    <div class="px-5 py-4 border-b border-slate-100">
        <h2 class="text-base font-semibold text-slate-900">Riwayat Kelas</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-100 bg-slate-50/50">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Kelas</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Mata Kuliah</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Dosen</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Mentor</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Sesi</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Peserta</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Hadir</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse ($kelasList as $k)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-5 py-3.5 font-medium text-slate-900">{{ $k->nama_kelas }}</td>
                    <td class="px-5 py-3.5 text-slate-500">{{ $k->mataKuliah->nama_mata_kuliah ?? '-' }}</td>
                    <td class="px-5 py-3.5 text-slate-500">{{ $k->dosen->name ?? '-' }}</td>
                    <td class="px-5 py-3.5">
                        @if ($k->mentor)
                        <span class="text-emerald-600 font-medium text-xs">{{ $k->mentor->name }}</span>
                        @else
                        <span class="text-slate-400">-</span>
                        @endif
                    </td>
                    <td class="px-5 py-3.5 text-slate-500">{{ $k->sesiMentoring->count() }}</td>
                    <td class="px-5 py-3.5 text-slate-500">{{ $k->total_peserta_sesi }}</td>
                    <td class="px-5 py-3.5">
                        @php $pct = $k->total_peserta_sesi > 0 ? round(($k->total_hadir / $k->total_peserta_sesi) * 100) : 0; @endphp
                        <div class="flex items-center gap-2">
                            <div class="w-16 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $pct }}%"></div>
                            </div>
                            <span class="text-xs {{ $pct >= 75 ? 'text-emerald-600' : ($pct >= 50 ? 'text-amber-600' : 'text-red-600') }}">{{ $pct }}%</span>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-5 py-10 text-center text-slate-400">Belum ada data kelas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
