@extends('layouts.mahasiswa')
@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <x-stat title="Kelas Saya" :value="$kelas ? 1 : 0" color="emerald" />
    <x-stat title="Sesi Tersedia" :value="$sesiTersedia->count()" color="blue" />
    <x-stat title="Sesi Diikuti" :value="$totalSesiDiikuti" color="violet" />
    <x-stat title="Hadir" :value="$totalHadir" color="emerald" />
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-lg border border-slate-200">
        <div class="px-5 py-4 border-b border-slate-100">
            <h2 class="text-sm font-semibold text-slate-900">Kelas Saya</h2>
        </div>
        <div class="p-5">
            @if ($kelas)
            <div class="flex items-center justify-between py-3">
                <div>
                    <p class="font-medium text-slate-900">{{ $kelas->nama_kelas }}</p>
                    <p class="text-xs text-slate-500">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">Dosen: {{ $kelas->dosen->name ?? '-' }} &middot; Mentor: {{ $kelas->mentor->name ?? '-' }}</p>
                </div>
                <span class="text-xs text-emerald-600 font-medium">{{ $kelas->sesiMentoring->count() }} sesi aktif</span>
            </div>
            @else
            <p class="text-sm text-slate-400 text-center py-6">Anda belum terdaftar di kelas mana pun.</p>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-lg border border-slate-200">
        <div class="px-5 py-4 border-b border-slate-100">
            <h2 class="text-sm font-semibold text-slate-900">Riwayat Terbaru</h2>
        </div>
        <div class="p-5">
            @forelse ($riwayatSesi as $ps)
            <div class="flex items-center justify-between py-3 border-b border-slate-50 last:border-0">
                <div>
                    <p class="text-sm font-medium text-slate-900">{{ $ps->sesi->topik ?? '-' }}</p>
                    <p class="text-xs text-slate-500">{{ $ps->sesi->kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</p>
                </div>
                <div class="flex items-center gap-2">
                    @if ($ps->status == 'hadir' && !$ps->feedback)
                    <a href="{{ route('mahasiswa.feedback.create', $ps) }}" class="text-xs text-emerald-600 hover:text-emerald-800 font-medium">Feedback</a>
                    @endif
                    <x-badge type="{{ $ps->status }}">{{ ucfirst(str_replace('_', ' ', $ps->status)) }}</x-badge>
                </div>
            </div>
            @empty
            <p class="text-sm text-slate-400 text-center py-6">Belum ada sesi yang diikuti.</p>
            @endforelse
        </div>
    </div>
</div>

<div class="bg-white rounded-lg border border-slate-200">
    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
        <h2 class="text-sm font-semibold text-slate-900">Sesi Tersedia</h2>
        <a href="{{ route('mahasiswa.sesi.index') }}" class="text-xs text-emerald-600 hover:text-emerald-800 font-medium">Lihat Semua</a>
    </div>
    <div class="p-5">
        @if ($sesiTersedia->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($sesiTersedia->take(6) as $sesi)
            @php
            $jumlahPeserta = $sesi->pesertaSesi->count();
            $penuh = $jumlahPeserta >= $sesi->kuota;
            $sudahDaftar = $riwayatSesi->where('sesi_id', $sesi->id)->isNotEmpty();
            @endphp
            <div class="border border-slate-200 rounded-lg p-4 {{ $penuh || $sudahDaftar ? 'opacity-75' : 'hover:border-emerald-300' }} transition-colors">
                <div class="flex items-start justify-between mb-2">
                    <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">{{ $sesi->kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</span>
                    @if ($penuh)
                    <x-badge type="danger">Penuh</x-badge>
                    @elseif ($sudahDaftar)
                    <x-badge type="info">Terdaftar</x-badge>
                    @else
                    <x-badge type="success">Buka</x-badge>
                    @endif
                </div>
                <h3 class="font-semibold text-slate-900 text-sm mb-1">{{ $sesi->topik }}</h3>
                <p class="text-xs text-slate-500 mb-3">{{ \Carbon\Carbon::parse($sesi->tanggal)->format('d M Y') }} &middot; {{ $sesi->jam_mulai }}-{{ $sesi->jam_selesai }}</p>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-slate-500">{{ $jumlahPeserta }}/{{ $sesi->kuota }} peserta</span>
                    @if (!$sudahDaftar && !$penuh)
                    <form action="{{ route('mahasiswa.sesi.daftar', $sesi) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-xs font-medium text-emerald-600 hover:text-emerald-800 cursor-pointer">Daftar</button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-sm text-slate-400 text-center py-6">Tidak ada sesi mentoring tersedia saat ini.</p>
        @endif
    </div>
</div>
@endsection
