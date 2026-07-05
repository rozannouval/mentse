@extends('layouts.mahasiswa')
@section('title', 'Sesi Tersedia')
@section('active', 'mahasiswa.sesi.index')

@section('content')
@if ($sesiList->isEmpty())
<div class="text-center py-16">
    <p class="text-gray-900 font-medium">Tidak ada sesi tersedia</p>
    <p class="text-sm text-gray-500 mt-1">Sesi akan muncul jika mentor dari kelas Anda membuka pendaftaran.</p>
</div>
@else
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($sesiList as $sesi)
    @php
        $jumlahPeserta = $sesi->pesertaSesi->count();
        $penuh = $jumlahPeserta >= $sesi->kuota;
        $sudahDaftar = $sesiDiikuti->where('sesi_id', $sesi->id)->isNotEmpty();
        $pct = $sesi->kuota > 0 ? round(($jumlahPeserta / $sesi->kuota) * 100) : 0;
    @endphp
    <div class="bg-white rounded-xl border border-gray-200 flex flex-col">
        <div class="p-5 flex-1">
            <div class="flex items-start justify-between mb-3">
                <span class="text-xs font-medium text-gray-500">{{ $sesi->kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</span>
                @if ($penuh)
                    <span class="text-xs font-medium text-red-600">Penuh</span>
                @elseif ($sudahDaftar)
                    <span class="text-xs font-medium text-blue-600">Terdaftar</span>
                @else
                    <span class="text-xs font-medium text-emerald-600">Buka</span>
                @endif
            </div>

            <h3 class="text-[15px] font-semibold text-gray-900 mb-1">{{ $sesi->topik }}</h3>
            <p class="text-sm text-gray-500 mb-4 leading-relaxed">{{ $sesi->deskripsi }}</p>

            <div class="border-t border-gray-100 pt-3 space-y-1.5 text-sm text-gray-500">
                <p>{{ \Carbon\Carbon::parse($sesi->tanggal)->format('d M Y') }}, {{ $sesi->jam_mulai }} &ndash; {{ $sesi->jam_selesai }}</p>
                <p>Mentor: {{ $sesi->kelas->mentor->name ?? '-' }}</p>
                <div class="flex items-center justify-between">
                    <span>{{ $jumlahPeserta }}/{{ $sesi->kuota }} peserta</span>
                    <span class="text-xs {{ $penuh ? 'text-red-500' : 'text-emerald-600' }}">{{ $pct }}%</span>
                </div>
                <div class="w-full h-1 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full rounded-full {{ $penuh ? 'bg-red-400' : 'bg-emerald-400' }}" style="width: {{ $pct }}%"></div>
                </div>
            </div>
        </div>

        <div class="px-5 pb-5">
            @if ($sudahDaftar)
                @php $ps = $sesiDiikuti->where('sesi_id', $sesi->id)->first(); @endphp
                <div class="flex gap-2">
                    <div class="flex-1 px-4 py-2.5 bg-gray-50 text-gray-400 text-sm font-medium rounded-lg text-center">Terdaftar</div>
                    @if ($ps && $ps->status == 'terdaftar')
                    <form action="{{ route('mahasiswa.sesi.batalkan', $ps) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="button" onclick="confirmAction(this.closest('form'), 'Batalkan', 'Yakin batalkan <strong>{{ $sesi->topik }}</strong>?', 'Ya, Batalkan')" class="px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition-colors cursor-pointer">
                            Batal
                        </button>
                    </form>
                    @endif
                </div>
            @elseif ($penuh)
                <div class="w-full px-4 py-2.5 bg-gray-50 text-gray-400 text-sm font-medium rounded-lg text-center">Kuota penuh</div>
            @else
                <form action="{{ route('mahasiswa.sesi.daftar', $sesi) }}" method="POST">
                    @csrf
                    <button type="button" onclick="confirmAction(this.closest('form'), 'Daftar Sesi', 'Daftar sesi <strong>{{ $sesi->topik }}</strong>?', 'Ya, Daftar')" class="w-full px-4 py-2.5 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors cursor-pointer">
                        Daftar
                    </button>
                </form>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection