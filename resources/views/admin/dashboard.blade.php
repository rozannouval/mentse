@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
    <x-stat title="Total User" :value="$totalUser" color="blue" />
    <x-stat title="Dosen" :value="$totalDosen" color="violet" />
    <x-stat title="Mentor" :value="$totalMentor" color="amber" />
    <x-stat title="Mahasiswa" :value="$totalMahasiswa" color="emerald" />
    <x-stat title="Mata Kuliah" :value="$totalMataKuliah" color="indigo" />
    <x-stat title="Kelas" :value="$totalKelas" color="teal" />
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg border border-slate-200 p-4">
        <p class="text-xs font-medium text-slate-500">Total Sesi</p>
        <p class="text-2xl font-bold text-slate-900 mt-0.5">{{ $totalSesi }}</p>
    </div>
    <div class="bg-white rounded-lg border border-slate-200 p-4">
        <p class="text-xs font-medium text-slate-500">Sesi Aktif</p>
        <p class="text-2xl font-bold text-slate-900 mt-0.5">{{ $sesiAktif }}</p>
    </div>
    <div class="bg-white rounded-lg border border-slate-200 p-4">
        <p class="text-xs font-medium text-slate-500">Kelas Tanpa Mentor</p>
        <p class="text-2xl font-bold text-slate-900 mt-0.5">{{ $kelasTanpaMentor }}</p>
    </div>
    <div class="bg-white rounded-lg border border-slate-200 p-4">
        <p class="text-xs font-medium text-slate-500">Total Feedback</p>
        <p class="text-2xl font-bold text-slate-900 mt-0.5">{{ $totalFeedback }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-lg border border-slate-200">
        <div class="px-5 py-4 border-b border-slate-100">
            <h2 class="text-sm font-semibold text-slate-900">Sesi Terbaru</h2>
        </div>
        <div class="p-5">
            @forelse ($recentSesi as $s)
            <div class="flex items-center justify-between py-3 border-b border-slate-50 last:border-0">
                <div>
                    <p class="text-sm font-medium text-slate-900">{{ $s->topik }}</p>
                    <p class="text-xs text-slate-500">{{ $s->kelas->nama_kelas ?? '-' }} &middot; {{ $s->kelas->dosen->name ?? '-' }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}</p>
                    <x-badge type="{{ $s->status }}">{{ ucfirst($s->status) }}</x-badge>
                </div>
            </div>
            @empty
            <p class="text-sm text-slate-400 text-center py-6">Belum ada sesi.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-lg border border-slate-200">
        <div class="px-5 py-4 border-b border-slate-100">
            <h2 class="text-sm font-semibold text-slate-900">User Terdaftar</h2>
        </div>
        <div class="p-5">
            @forelse ($recentUsers as $u)
            <div class="flex items-center justify-between py-3 border-b border-slate-50 last:border-0">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-sm font-bold text-slate-500 overflow-hidden">
                        @if ($u->photo)
                        <img src="{{ asset('storage/' . $u->photo) }}" alt="" class="w-full h-full object-cover">
                        @else
                        {{ strtoupper(substr($u->name, 0, 1)) }}
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-900">{{ $u->name }}</p>
                        <p class="text-xs text-slate-500">{{ $u->email }}</p>
                    </div>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium @switch($u->role) @case('admin') bg-red-50 text-red-700 @break @case('dosen') bg-violet-50 text-violet-700 @break @case('mentor') bg-amber-50 text-amber-700 @break @default bg-emerald-50 text-emerald-700 @endswitch">
                    {{ ucfirst($u->role) }}
                </span>
            </div>
            @empty
            <p class="text-sm text-slate-400 text-center py-6">Belum ada user.</p>
            @endforelse
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg border border-slate-200">
        <div class="px-5 py-4 border-b border-slate-100">
            <h2 class="text-sm font-semibold text-slate-900">Distribusi Role</h2>
        </div>
        <div class="p-5">
            @php
                $roles = [
                    ['label' => 'Admin', 'count' => 1, 'color' => 'bg-red-500'],
                    ['label' => 'Dosen', 'count' => $totalDosen, 'color' => 'bg-violet-500'],
                    ['label' => 'Mentor', 'count' => $totalMentor, 'color' => 'bg-amber-500'],
                    ['label' => 'Mahasiswa', 'count' => $totalMahasiswa, 'color' => 'bg-emerald-500'],
                ];
                $maxCount = max($totalDosen, $totalMentor, $totalMahasiswa, 1);
            @endphp
            <div class="space-y-4">
                @foreach ($roles as $r)
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full {{ $r['color'] }}"></span>
                            <span class="text-sm text-slate-600">{{ $r['label'] }}</span>
                        </div>
                        <span class="text-sm font-semibold text-slate-900">{{ $r['count'] }}</span>
                    </div>
                    <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full {{ $r['color'] }} rounded-full transition-all duration-500" style="width: {{ ($r['count'] / $maxCount) * 100 }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-slate-200 lg:col-span-2">
        <div class="px-5 py-4 border-b border-slate-100">
            <h2 class="text-sm font-semibold text-slate-900">Sesi per Bulan ({{ date('Y') }})</h2>
        </div>
        <div class="p-5">
            @php $months = [1,2,3,4,5,6,7,8,9,10,11,12]; $maxCount = max($kelasPerBulan->max() ?: 1, 1); @endphp
            <div class="relative" style="height:192px">
                <div class="absolute inset-0 flex items-end gap-2 px-1">
                    @foreach ($months as $m)
                    @php
                        $count = $kelasPerBulan->get($m, 0);
                        $barH = $count > 0 ? round(($count / $maxCount) * 160) + 8 : 4;
                    @endphp
                    <div class="flex-1 flex flex-col items-center gap-1 justify-end">
                        <span class="text-[10px] font-medium {{ $count > 0 ? 'text-slate-700' : 'text-slate-300' }}">{{ $count }}</span>
                        <div class="w-full min-h-[4px] rounded-t {{ $count > 0 ? 'bg-blue-500' : 'bg-slate-100' }}" style="height: {{ $barH }}px"></div>
                        <span class="text-[10px] text-slate-400">{{ \Carbon\Carbon::create()->month($m)->format('M') }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
