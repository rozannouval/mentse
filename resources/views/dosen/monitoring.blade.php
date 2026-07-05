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
                        <p class="text-xs text-gray-500">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }} &middot;
                            {{ $kelas->mentor->name ?? '-' }}</p>
                    </div>
                    <span class="text-xs text-gray-400">{{ $kelas->sesiMentoring->count() }} sesi</span>
                </div>

                @if ($kelas->sesiMentoring->count() > 0)
                    <div class="overflow-x-auto">
                        <div class="divide-y divide-gray-100">

                            @foreach ($kelas->sesiMentoring as $s)
                                @php
                                    $total = $s->pesertaSesi->count();
                                    $hadir = $s->pesertaSesi->where('status', 'hadir')->count();
                                    $pct = $total ? round(($hadir / $total) * 100) : 0;
                                    $feedback = $s->pesertaSesi->filter(fn($ps) => $ps->feedback)->count();
                                @endphp

                                <div class="p-5">

                                    <div class="flex justify-between items-start">

                                        <div>

                                            <h3 class="font-medium text-gray-900">

                                                {{ $s->topik }}

                                            </h3>

                                            <p class="text-sm text-gray-500 mt-1">

                                                {{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}

                                            </p>

                                        </div>

                                        <span class="text-sm font-medium text-gray-600">

                                            {{ $feedback }} Feedback

                                        </span>

                                    </div>

                                    <div class="mt-4">

                                        <div class="flex justify-between text-sm">

                                            <span>

                                                Kehadiran

                                            </span>

                                            <span class="font-medium">

                                                {{ $hadir }} / {{ $total }}

                                            </span>

                                        </div>

                                        <div class="mt-2 h-2 rounded-full bg-gray-100 overflow-hidden">

                                            <div class="h-full rounded-full
                {{ $pct >= 75 ? 'bg-green-500' : ($pct >= 50 ? 'bg-yellow-500' : 'bg-red-500') }}"
                                                style="width:{{ $pct }}%">
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>
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
