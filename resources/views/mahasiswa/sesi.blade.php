@extends('layouts.mahasiswa')
@section('title', 'Sesi Tersedia')
@section('active', 'mahasiswa.sesi.index')

@section('content')
@if ($sesiList->isEmpty())
    <x-card>
        <div class="text-center py-10">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-gray-500 font-medium">Tidak ada sesi mentoring tersedia</p>
            <p class="text-gray-400 text-sm mt-1">Sesi akan muncul jika mentor dari kelas Anda membuka pendaftaran.</p>
        </div>
    </x-card>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ($sesiList as $sesi)
        @php
            $jumlahPeserta = $sesi->pesertaSesi->count();
            $penuh = $jumlahPeserta >= $sesi->kuota;
            $sudahDaftar = $sesiDiikuti->where('sesi_id', $sesi->id)->isNotEmpty();
        @endphp
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200 flex flex-col {{ $penuh || $sudahDaftar ? 'opacity-75' : '' }}">
            <div class="p-5 flex-1">
                <div class="flex items-start justify-between mb-3">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                        {{ $sesi->kelas->mataKuliah->nama_mata_kuliah ?? '-' }}
                    </span>
                    @if ($penuh)
                        <x-badge type="danger">Penuh</x-badge>
                    @elseif ($sudahDaftar)
                        <x-badge type="info">Terdaftar</x-badge>
                    @else
                        <x-badge type="success">Dibuka</x-badge>
                    @endif
                </div>

                <h3 class="text-base font-semibold text-gray-900 mb-1">{{ $sesi->topik }}</h3>
                <p class="text-xs text-gray-500 mb-4 line-clamp-2">{{ $sesi->deskripsi }}</p>

                <div class="space-y-2 text-xs text-gray-500 border-t border-gray-100 pt-3">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ \Carbon\Carbon::parse($sesi->tanggal)->format('d M Y') }}, {{ $sesi->jam_mulai }} - {{ $sesi->jam_selesai }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Mentor: {{ $sesi->kelas->mentor->name ?? '-' }}
                    </div>
                    <div class="flex items-center gap-2 {{ $penuh ? 'text-red-600' : 'text-emerald-600' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/></svg>
                        <span class="font-medium">{{ $jumlahPeserta }}/{{ $sesi->kuota }}</span> Peserta
                    </div>
                </div>
            </div>

            <div class="px-5 pb-5">
                @if ($sudahDaftar)
                    <button disabled class="w-full py-2.5 bg-gray-100 text-gray-400 text-sm font-medium rounded-lg cursor-not-allowed">Sudah Terdaftar</button>
                @elseif ($penuh)
                    <button disabled class="w-full py-2.5 bg-gray-100 text-gray-400 text-sm font-medium rounded-lg cursor-not-allowed">Kuota Penuh</button>
                @else
                    <form action="{{ route('mahasiswa.sesi.daftar', $sesi) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-sm shadow-emerald-600/20 cursor-pointer">
                            Daftar Sekarang
                        </button>
                    </form>
                @endif
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
