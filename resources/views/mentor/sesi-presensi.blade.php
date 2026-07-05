@extends('layouts.mentor')
@section('title', 'Presensi Sesi')
@section('active', 'mentor.sesi.index')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-xl border border-slate-100 shadow-sm lg:col-span-2">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-base font-semibold text-slate-900">{{ $sesi->topik }}</h2>
            <a href="{{ route('mentor.sesi.index') }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-slate-700 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-3 gap-4 text-sm">
                <div>
                    <p class="text-slate-500 text-xs">Kelas</p>
                    <p class="font-semibold text-slate-900">{{ $sesi->kelas->nama_kelas ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-slate-500 text-xs">Tanggal</p>
                    <p class="font-semibold text-slate-900">{{ \Carbon\Carbon::parse($sesi->tanggal)->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-slate-500 text-xs">Jam</p>
                    <p class="font-semibold text-slate-900">{{ $sesi->jam_mulai }} - {{ $sesi->jam_selesai }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4">
                <x-badge type="{{ $sesi->status }}">{{ ucfirst($sesi->status) }}</x-badge>
                @if ($sesi->status == 'dibuka')
                <form action="{{ route('mentor.sesi.selesai', $sesi) }}" method="POST" class="inline">
                    @csrf @method('PUT')
                    <button type="button" onclick="confirmAction(this.closest('form'), 'Selesaikan Sesi', 'Tandai sesi <strong>{{ $sesi->topik }}</strong> sebagai selesai?', 'Ya, Selesaikan')" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-emerald-600 bg-emerald-50 hover:bg-emerald-100 rounded-lg transition-colors cursor-pointer">
                        Selesai
                    </button>
                </form>
                <form action="{{ route('mentor.sesi.tutup', $sesi) }}" method="POST" class="inline">
                    @csrf @method('PUT')
                    <button type="button" onclick="confirmAction(this.closest('form'), 'Tutup Sesi', 'Tutup sesi <strong>{{ $sesi->topik }}</strong>?', 'Ya, Tutup')" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-amber-600 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors cursor-pointer">
                        Tutup
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-100 shadow-sm">
        <div class="px-5 py-4 border-b border-slate-100">
            <h2 class="text-base font-semibold text-slate-900">Ringkasan</h2>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-3 gap-3 text-center">
                <div class="p-3 bg-blue-50 rounded-xl">
                    <p class="text-2xl font-bold text-blue-600">{{ $sesi->pesertaSesi->count() }}</p>
                    <p class="text-xs text-slate-500">Total</p>
                </div>
                <div class="p-3 bg-emerald-50 rounded-xl">
                    <p class="text-2xl font-bold text-emerald-600">{{ $sesi->pesertaHadir->count() }}</p>
                    <p class="text-xs text-slate-500">Hadir</p>
                </div>
                <div class="p-3 bg-amber-50 rounded-xl">
                    <p class="text-2xl font-bold text-amber-600">{{ $sesi->kuota }}</p>
                    <p class="text-xs text-slate-500">Kuota</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl border border-slate-100 shadow-sm">
    <div class="px-5 py-4 border-b border-slate-100">
        <h2 class="text-base font-semibold text-slate-900">Peserta Terdaftar ({{ $sesi->pesertaSesi->count() }})</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-100 bg-slate-50/50">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">No</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Nama Mahasiswa</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Tanggal Daftar</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Status</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse ($sesi->pesertaSesi as $key => $ps)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-5 py-3.5 text-slate-500">{{ $key + 1 }}</td>
                    <td class="px-5 py-3.5 font-medium text-slate-900">{{ $ps->mahasiswa->name ?? '-' }}</td>
                    <td class="px-5 py-3.5 text-slate-500 text-xs">{{ $ps->tanggal_daftar ? \Carbon\Carbon::parse($ps->tanggal_daftar)->format('d M Y H:i') : '-' }}</td>
                    <td class="px-5 py-3.5"><x-badge type="{{ $ps->status }}">{{ ucfirst(str_replace('_', ' ', $ps->status)) }}</x-badge></td>
                    <td class="px-5 py-3.5">
                        @if ($ps->status == 'terdaftar')
                        <div class="flex items-center gap-1.5">
                            <form action="{{ route('mentor.sesi.presensi.update', [$sesi, $ps]) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="hadir">
                                <button type="submit" class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-emerald-600 bg-emerald-50 hover:bg-emerald-100 rounded-md transition-colors cursor-pointer">Hadir</button>
                            </form>
                            <form action="{{ route('mentor.sesi.presensi.update', [$sesi, $ps]) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="tidak_hadir">
                                <button type="submit" class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-md transition-colors cursor-pointer">Tidak Hadir</button>
                            </form>
                        </div>
                        @elseif ($ps->status == 'tidak_hadir')
                        <form action="{{ route('mentor.sesi.presensi.update', [$sesi, $ps]) }}" method="POST" class="inline">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="hadir">
                            <button type="submit" class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-emerald-600 bg-emerald-50 hover:bg-emerald-100 rounded-md transition-colors cursor-pointer">Ubah ke Hadir</button>
                        </form>
                        @else
                        <span class="text-slate-400 text-sm">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-5 py-10 text-center text-slate-400">Belum ada peserta.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
