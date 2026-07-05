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

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Card Ringkasan User -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-base font-bold text-slate-800">Ringkasan Pengguna</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center mr-3 font-bold">U</div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Total User</p>
                        <p class="text-lg font-bold text-slate-800">{{ $totalUser }}</p>
                    </div>
                </div>
                <div class="flex items-center p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <div class="w-10 h-10 rounded-lg bg-violet-100 text-violet-600 flex items-center justify-center mr-3 font-bold">D</div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Dosen</p>
                        <p class="text-lg font-bold text-slate-800">{{ $totalDosen }}</p>
                    </div>
                </div>
                <div class="flex items-center p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center mr-3 font-bold">M</div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Mentor</p>
                        <p class="text-lg font-bold text-slate-800">{{ $totalMentor }}</p>
                    </div>
                </div>
                <div class="flex items-center p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center mr-3 font-bold">Mh</div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Mahasiswa</p>
                        <p class="text-lg font-bold text-slate-800">{{ $totalMahasiswa }}</p>
                    </div>
                </div>
                <div class="flex items-center p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <div class="w-10 h-10 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center mr-3 font-bold">K</div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Kelas Aktif</p>
                        <p class="text-lg font-bold text-slate-800">{{ $totalKelas }}</p>
                    </div>
                </div>
                <div class="flex items-center p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <div class="w-10 h-10 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center mr-3 font-bold">F</div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Feedback</p>
                        <p class="text-lg font-bold text-slate-800">{{ $totalFeedback }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Statistik Kehadiran -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-base font-bold text-slate-800">Tingkat Kehadiran Keseluruhan</h2>
        </div>
        <div class="p-8 flex flex-col justify-center flex-grow">
            <div class="text-center mb-6">
                <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Rate Kehadiran</p>
                <h3 class="text-5xl font-extrabold text-slate-800 mt-2">{{ $rateKehadiran }}%</h3>
            </div>
            
            <div class="grid grid-cols-2 gap-4 pt-6 border-t border-slate-100">
                <div class="text-center border-r border-slate-100">
                    <p class="text-xs font-medium text-slate-500 mb-1">Total Hadir</p>
                    <p class="text-2xl font-bold text-emerald-600">{{ $totalHadir }}</p>
                </div>
                <div class="text-center">
                    <p class="text-xs font-medium text-slate-500 mb-1">Tidak Hadir</p>
                    <p class="text-2xl font-bold text-red-600">{{ $totalTidakHadir }}</p>
                </div>
            </div>
        </div>
    </div>
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