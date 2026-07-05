@extends('layouts.admin')
@section('title', 'Laporan & Statistik')
@section('active', 'admin.laporan')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg border border-gray-200 border-l-4 border-l-blue-500 p-4">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Sesi</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalSesi }}</p>
    </div>
    <div class="bg-white rounded-lg border border-gray-200 border-l-4 border-l-emerald-500 p-4">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Hadir</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalHadir }}</p>
    </div>
    <div class="bg-white rounded-lg border border-gray-200 border-l-4 border-l-red-500 p-4">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Tidak Hadir</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalTidakHadir }}</p>
    </div>
    <div class="bg-white rounded-lg border border-gray-200 border-l-4 border-l-amber-500 p-4">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Rate Kehadiran</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $rateKehadiran }}%</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-900">Ringkasan User</h2>
        </div>
        <div class="p-5">
            <div class="space-y-3">
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                        <span class="text-sm text-gray-600">Total User</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">{{ $totalUser }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-violet-500"></span>
                        <span class="text-sm text-gray-600">Dosen</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">{{ $totalDosen }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                        <span class="text-sm text-gray-600">Mentor</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">{{ $totalMentor }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        <span class="text-sm text-gray-600">Mahasiswa</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">{{ $totalMahasiswa }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-indigo-500"></span>
                        <span class="text-sm text-gray-600">Kelas</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">{{ $totalKelas }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-teal-500"></span>
                        <span class="text-sm text-gray-600">Feedback</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">{{ $totalFeedback }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-900">Statistik Kehadiran</h2>
        </div>
        <div class="p-5">
            <div class="flex items-end justify-center gap-8 py-4">
                <div class="text-center">
                    <div class="w-20 h-20 rounded-full border-4 border-emerald-500 flex items-center justify-center mx-auto mb-2">
                        <span class="text-xl font-bold text-emerald-600">{{ $totalHadir }}</span>
                    </div>
                    <p class="text-xs font-medium text-gray-500">Hadir</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 rounded-full border-4 border-red-500 flex items-center justify-center mx-auto mb-2">
                        <span class="text-xl font-bold text-red-600">{{ $totalTidakHadir }}</span>
                    </div>
                    <p class="text-xs font-medium text-gray-500">Tidak Hadir</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 rounded-full border-4 border-amber-500 flex items-center justify-center mx-auto mb-2">
                        <span class="text-xl font-bold text-amber-600">{{ $rateKehadiran }}%</span>
                    </div>
                    <p class="text-xs font-medium text-gray-500">Rate</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg border border-gray-200">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="text-base font-semibold text-gray-900">Riwayat Kelas</h2>
    </div>
    <div class="p-5">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Kelas</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Mata Kuliah</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Dosen</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Mentor</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Sesi</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Peserta</th>
                    <th class="text-left pb-3 text-xs font-semibold text-gray-500 uppercase">Hadir</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($kelasList as $k)
                <tr class="hover:bg-gray-50/50">
                    <td class="py-3 pr-4 font-medium text-gray-900">{{ $k->nama_kelas }}</td>
                    <td class="py-3 pr-4 text-gray-500">{{ $k->mataKuliah->nama_mata_kuliah ?? '-' }}</td>
                    <td class="py-3 pr-4 text-gray-500">{{ $k->dosen->name ?? '-' }}</td>
                    <td class="py-3 pr-4">
                        @if ($k->mentor)
                        <span class="text-emerald-600 font-medium">{{ $k->mentor->name }}</span>
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="py-3 pr-4 text-gray-500">{{ $k->sesiMentoring->count() }}</td>
                    <td class="py-3 pr-4 text-gray-500">{{ $k->total_peserta_sesi }}</td>
                    <td class="py-3">
                        @php $pct = $k->total_peserta_sesi > 0 ? round(($k->total_hadir / $k->total_peserta_sesi) * 100) : 0; @endphp
                        <div class="flex items-center gap-2">
                            <div class="w-16 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $pct }}%"></div>
                            </div>
                            <span class="text-xs {{ $pct >= 75 ? 'text-emerald-600' : ($pct >= 50 ? 'text-amber-600' : 'text-red-600') }}">{{ $pct }}%</span>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-8 text-center text-gray-400">Belum ada data kelas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
