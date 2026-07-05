@extends('layouts.mentor')
@section('title', 'Presensi Sesi')
@section('active', 'mentor.sesi.index')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg border border-gray-200 lg:col-span-2">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-900">{{ $sesi->topik }}</h2>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-3 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Kelas</p>
                    <p class="font-semibold text-gray-900">{{ $sesi->kelas->nama_kelas ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Tanggal</p>
                    <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($sesi->tanggal)->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Jam</p>
                    <p class="font-semibold text-gray-900">{{ $sesi->jam_mulai }} - {{ $sesi->jam_selesai }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4">
                <x-badge type="{{ $sesi->status }}">{{ ucfirst($sesi->status) }}</x-badge>
                @if ($sesi->status == 'dibuka')
                <form action="{{ route('mentor.sesi.tutup', $sesi) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium cursor-pointer" onclick="return confirm('Tutup sesi ini?')">Tutup Sesi</button>
                </form>
                @endif
                <a href="{{ route('mentor.sesi.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700 font-medium ml-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-900">Ringkasan</h2>
        </div>
        <div class="p-5">
            <div class="space-y-4 text-center">
                <div>
                    <p class="text-3xl font-bold text-blue-600">{{ $sesi->pesertaSesi->count() }}</p>
                    <p class="text-sm text-gray-500">Total Peserta</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-emerald-600">{{ $sesi->pesertaHadir->count() }}</p>
                    <p class="text-sm text-gray-500">Hadir</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-amber-600">{{ $sesi->kuota }}</p>
                    <p class="text-sm text-gray-500">Kuota</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg border border-gray-200">
    <div class="px-5 py-4 border-b border-gray-100">
        <h2 class="text-base font-semibold text-gray-900">Peserta Terdaftar</h2>
    </div>
    <div class="p-5">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">No</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Nama Mahasiswa</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Tanggal Daftar</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Status</th>
                    <th class="text-left pb-3 text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($sesi->pesertaSesi as $key => $ps)
                <tr class="hover:bg-gray-50/50">
                    <td class="py-3 pr-4 text-gray-500">{{ $key + 1 }}</td>
                    <td class="py-3 pr-4 font-medium text-gray-900">{{ $ps->mahasiswa->name ?? '-' }}</td>
                    <td class="py-3 pr-4 text-gray-500">{{ $ps->tanggal_daftar ? \Carbon\Carbon::parse($ps->tanggal_daftar)->format('d M Y H:i') : '-' }}</td>
                    <td class="py-3 pr-4"><x-badge type="{{ $ps->status }}">{{ ucfirst(str_replace('_', ' ', $ps->status)) }}</x-badge></td>
                    <td class="py-3">
                        @if ($ps->status == 'terdaftar')
                        <div class="flex items-center gap-2">
                            <form action="{{ route('mentor.sesi.presensi.update', [$sesi, $ps]) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="hadir">
                                <button type="submit" class="text-sm text-emerald-600 hover:text-emerald-800 font-medium cursor-pointer">Hadir</button>
                            </form>
                            <form action="{{ route('mentor.sesi.presensi.update', [$sesi, $ps]) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="tidak_hadir">
                                <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium cursor-pointer">Tidak Hadir</button>
                            </form>
                        </div>
                        @elseif ($ps->status == 'tidak_hadir')
                        <form action="{{ route('mentor.sesi.presensi.update', [$sesi, $ps]) }}" method="POST" class="inline">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="hadir">
                            <button type="submit" class="text-sm text-emerald-600 hover:text-emerald-800 font-medium cursor-pointer">Ubah ke Hadir</button>
                        </form>
                        @else
                        <span class="text-gray-400 text-sm">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-gray-400">Belum ada peserta.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
