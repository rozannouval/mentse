@extends('layouts.mahasiswa')
@section('title', 'Sesi Tersedia')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($sesiList as $sesi)
    @php
        $jumlahPeserta = $sesi->pesertaSesi->count();
        $penuh = $jumlahPeserta >= $sesi->kuota;
        $sudahDaftar = $sesiDiikuti->where('sesi_id', $sesi->id)->isNotEmpty();
    @endphp
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col justify-between h-full {{ $penuh ? 'opacity-80' : '' }}">
        <div>
            <div class="flex justify-between items-center mb-3">
                <span class="bg-emerald-50 text-emerald-700 text-xs font-bold px-2 py-1 rounded">{{ $sesi->kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</span>
                <span class="{{ $penuh ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }} text-xs font-semibold px-2 py-0.5 rounded-md">
                    {{ $penuh ? 'Penuh' : 'Dibuka' }}
                </span>
            </div>
            <h5 class="text-base font-bold text-gray-800 mb-1">{{ $sesi->topik }}</h5>
            <p class="text-gray-500 text-xs mb-4">{{ $sesi->deskripsi }}</p>
            <div class="text-gray-500 text-xs space-y-2 border-t border-gray-100 pt-3 mb-5 leading-relaxed">
                <div>Waktu: {{ \Carbon\Carbon::parse($sesi->tanggal)->format('d M Y') }}, {{ $sesi->jam_mulai }} - {{ $sesi->jam_selesai }}</div>
                <div>Mentor: {{ $sesi->kelas->mentor->name ?? '-' }}</div>
                <div class="{{ $penuh ? 'text-red-600' : 'text-green-600' }} font-semibold">Kuota: {{ $jumlahPeserta }} / {{ $sesi->kuota }} Peserta</div>
            </div>
        </div>

        @if ($sudahDaftar)
            <button class="w-full bg-gray-300 text-gray-500 py-2 rounded-lg font-medium text-xs cursor-not-allowed" disabled>
                Sudah Terdaftar
            </button>
        @elseif ($penuh)
            <button class="w-full bg-gray-300 text-gray-500 py-2 rounded-lg font-medium text-xs cursor-not-allowed" disabled>
                Kuota Penuh
            </button>
        @else
            <form action="{{ route('mahasiswa.sesi.daftar', $sesi) }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white text-center py-2 rounded-lg font-medium text-xs transition-colors cursor-pointer">
                    Daftar Sesi Sekarang
                </button>
            </form>
        @endif
    </div>
    @empty
    <div class="col-span-full text-center text-gray-400 py-12">
        <p>Tidak ada sesi mentoring yang tersedia untuk kelas Anda.</p>
    </div>
    @endforelse
</div>
@endsection
