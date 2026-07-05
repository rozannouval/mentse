@extends('layouts.admin')
@section('title', 'Laporan Statistik')
@section('active', 'admin.laporan')

@section('content')
<!-- Top Stat Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
    <x-stat title="Total Sesi" :value="$totalSesi" color="blue" />
    <x-stat title="Total Hadir" :value="$totalHadir" color="green" />
    <x-stat title="Tidak Hadir" :value="$totalTidakHadir" color="red" />
    <x-stat title="Rate Kehadiran" :value="$rateKehadiran . '%'" color="amber" />
</div>

<!-- Tabel Riwayat Kelas -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-100">
        <h2 class="text-base font-bold text-slate-800">Detail Kinerja per Kelas</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="px-6 py-4 font-semibold text-slate-600">Kelas</th>
                    <th class="px-6 py-4 font-semibold text-slate-600">Mata Kuliah</th>
                    <th class="px-6 py-4 font-semibold text-slate-600">Dosen / Mentor</th>
                    <th class="px-6 py-4 font-semibold text-slate-600 text-center">Jml Sesi</th>
                    <th class="px-6 py-4 font-semibold text-slate-600 text-center">Peserta Hadir</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($kelasList as $k)
                <tr class="hover:bg-slate-50/70 transition-colors duration-150">
                    <td class="px-6 py-4 font-bold text-slate-800">{{ $k->nama_kelas }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $k->mataKuliah->nama_mata_kuliah ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <p class="font-medium text-slate-800">{{ $k->dosen->name ?? '-' }}</p>
                        <p class="text-xs text-slate-500 mt-0.5">Mentor: {{ $k->mentor->name ?? '-' }}</p>
                    </td>
                    <td class="px-6 py-4 text-center font-medium text-slate-600">
                        {{ $k->sesiMentoring->count() }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="font-bold text-slate-800 text-base">{{ $k->total_hadir }}</span>
                        <span class="text-slate-500 text-xs ml-1">dari {{ $k->total_peserta_sesi }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                        <div class="flex flex-col items-center">
                            <span class="text-4xl mb-3">📭</span>
                            <p class="font-medium">Belum ada data kelas untuk ditampilkan saat ini.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection