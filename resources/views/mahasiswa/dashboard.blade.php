@extends('layouts.mahasiswa')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <x-stat title="Kelas" :value="$kelas ? 1 : 0" color="emerald" />
    <x-stat title="Sesi Tersedia" :value="$sesiTersedia->count()" color="blue" />
    <x-stat title="Sesi Diikuti" :value="$totalSesiDiikuti" color="violet" />
    <x-stat title="Hadir" :value="$totalHadir" color="green" />
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <h2 class="text-sm font-semibold text-gray-900 mb-4">Kelas Saya</h2>
        @if ($kelas)
        <div>
            <p class="text-[15px] font-semibold text-gray-900">{{ $kelas->nama_kelas }}</p>
            <p class="text-sm text-gray-500">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</p>
            <div class="flex items-center gap-3 mt-2 text-sm text-gray-400">
                <span>{{ $kelas->dosen->name ?? '-' }}</span>
                <span>&middot;</span>
                <span>{{ $kelas->mentor->name ?? '-' }}</span>
            </div>
        </div>
        @else
        <p class="text-sm text-gray-400 py-6 text-center">Anda belum terdaftar di kelas mana pun.</p>
        @endif
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <h2 class="text-sm font-semibold text-gray-900 mb-4">Terbaru</h2>
        @forelse ($riwayatSesi as $ps)
        <div class="flex items-center justify-between py-2.5 border-b border-gray-50 last:border-0">
            <div>
                <p class="text-sm font-medium text-gray-900">{{ $ps->sesi->topik ?? '-' }}</p>
                <p class="text-xs text-gray-500">{{ $ps->sesi->kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</p>
            </div>
            <div class="flex items-center gap-2">
                @if ($ps->status == 'hadir' && !$ps->feedback)
                <a href="{{ route('mahasiswa.feedback.create', $ps) }}" class="px-2 py-1 text-xs font-medium text-white bg-gray-900 hover:bg-gray-800 rounded-md transition-colors">Nilai</a>
                @endif
                <x-badge type="{{ $ps->status }}">{{ ucfirst(str_replace('_', ' ', $ps->status)) }}</x-badge>
            </div>
        </div>
        @empty
        <p class="text-sm text-gray-400 py-6 text-center">Belum ada sesi yang diikuti.</p>
        @endforelse
    </div>
</div>

<div class="bg-white rounded-xl border border-gray-200 p-5">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-sm font-semibold text-gray-900">Sesi Tersedia</h2>
        <a href="{{ route('mahasiswa.sesi.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Lihat semua</a>
    </div>
    @if ($sesiTersedia->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
        @foreach ($sesiTersedia->take(6) as $sesi)
        @php
        $jumlahPeserta = $sesi->pesertaSesi->count();
        $penuh = $jumlahPeserta >= $sesi->kuota;
        $sudahDaftar = $riwayatSesi->where('sesi_id', $sesi->id)->isNotEmpty();
        @endphp
        <div class="border border-gray-200 rounded-lg p-4 {{ !$penuh && !$sudahDaftar ? 'hover:border-gray-300' : '' }} transition-colors">
            <div class="flex items-start justify-between mb-2">
                <span class="text-xs text-gray-500">{{ $sesi->kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</span>
                @if ($penuh)
                <span class="text-xs font-medium text-red-600">Penuh</span>
                @elseif ($sudahDaftar)
                <span class="text-xs font-medium text-blue-600">Terdaftar</span>
                @else
                <span class="text-xs font-medium text-emerald-600">Buka</span>
                @endif
            </div>
            <h3 class="font-semibold text-gray-900 text-sm mb-1">{{ $sesi->topik }}</h3>
            <p class="text-xs text-gray-500 mb-3">{{ \Carbon\Carbon::parse($sesi->tanggal)->format('d M Y') }} &middot; {{ $sesi->jam_mulai }}&ndash;{{ $sesi->jam_selesai }}</p>
            <div class="flex items-center justify-between">
                <span class="text-xs text-gray-500">{{ $jumlahPeserta }}/{{ $sesi->kuota }}</span>
                @if (!$sudahDaftar && !$penuh)
                <form action="{{ route('mahasiswa.sesi.daftar', $sesi) }}" method="POST">
                    @csrf
                    <button type="button" onclick="confirmAction(this.closest('form'), 'Daftar', 'Daftar <strong>{{ $sesi->topik }}</strong>?', 'Ya, Daftar')" class="text-xs font-medium text-gray-900 hover:text-gray-600 cursor-pointer">Daftar</button>
                </form>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p class="text-sm text-gray-400 py-6 text-center">Tidak ada sesi tersedia.</p>
    @endif
</div>
@endsection