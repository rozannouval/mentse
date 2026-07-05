@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <x-stat title="Total User" :value="$totalUser" color="blue" />
    <x-stat title="Total Kelas" :value="$totalKelas" color="indigo" />
    <x-stat title="Sesi Aktif" :value="$sesiAktif" color="green" />
    <x-stat title="Kelas Tanpa Mentor" :value="$kelasTanpaMentor" color="amber" />
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-5">
        <h2 class="text-sm font-semibold text-gray-900 mb-1">Sesi per Bulan</h2>
        <p class="text-xs text-gray-400 mb-5">{{ date('Y') }}</p>
        @php $months = [1,2,3,4,5,6,7,8,9,10,11,12]; $maxCount = max($kelasPerBulan->max() ?: 1, 1); @endphp
        <div class="flex items-end gap-2" style="height:160px">
            @foreach ($months as $m)
            @php
                $count = $kelasPerBulan->get($m, 0);
                $pct = $count > 0 ? ($count / $maxCount) * 100 : 0;
            @endphp
            <div class="flex-1 flex flex-col items-center gap-1.5 justify-end h-full">
                <span class="text-[10px] font-medium {{ $count > 0 ? 'text-gray-700' : 'text-gray-300' }}">{{ $count }}</span>
                <div class="w-full rounded-sm {{ $count > 0 ? 'bg-gray-900' : 'bg-gray-100' }}" style="height: {{ max($pct, 2) }}%"></div>
                <span class="text-[10px] text-gray-400">{{ \Carbon\Carbon::create()->month($m)->format('M') }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <h2 class="text-sm font-semibold text-gray-900 mb-4">Distribusi Role</h2>
        @php $maxCount = max($roleDistribusi['dosen'], $roleDistribusi['mentor'], $roleDistribusi['mahasiswa'], 1); @endphp
        <div class="space-y-4">
            @foreach (['dosen' => 'bg-violet-400', 'mentor' => 'bg-amber-400', 'mahasiswa' => 'bg-emerald-400'] as $role => $color)
            @php $count = $roleDistribusi[$role]; @endphp
            <div>
                <div class="flex items-center justify-between mb-1">
                    <span class="text-sm text-gray-600 capitalize">{{ $role }}</span>
                    <span class="text-sm font-medium text-gray-900">{{ $count }}</span>
                </div>
                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full {{ $color }} rounded-full" style="width: {{ $maxCount > 0 ? ($count / $maxCount) * 100 : 0 }}%"></div>
                </div>
            </div>
            @endforeach
            <div class="pt-3 border-t border-gray-100">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-900">Total</span>
                    <span class="text-sm font-bold text-gray-900">{{ array_sum($roleDistribusi) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl border border-gray-200 p-5">
    <h2 class="text-sm font-semibold text-gray-900 mb-1">Sesi Terbaru</h2>
    <p class="text-xs text-gray-400 mb-4">5 sesi mentoring terakhir</p>
    @forelse ($recentSesi as $s)
    <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0">
        <div>
            <p class="text-sm font-medium text-gray-900">{{ $s->topik }}</p>
            <p class="text-xs text-gray-500">{{ $s->kelas->nama_kelas ?? '-' }} &middot; {{ $s->kelas->dosen->name ?? '-' }}</p>
        </div>
        <div class="text-right">
            <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}</p>
            <x-badge type="{{ $s->status }}">{{ ucfirst($s->status) }}</x-badge>
        </div>
    </div>
    @empty
    <p class="text-sm text-gray-400 text-center py-6">Belum ada sesi.</p>
    @endforelse
</div>
@endsection