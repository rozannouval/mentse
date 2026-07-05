@extends('layouts.mentor')
@section('title', 'Sesi Mentoring')
@section('active', 'mentor.sesi.index')

@section('content')
<div class="bg-white rounded-lg border border-gray-200">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="text-base font-semibold text-gray-900">Daftar Sesi Mentoring</h2>
        <a href="{{ route('mentor.sesi.create') }}" class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-sm shadow-amber-500/20">+ Buat Sesi Baru</a>
    </div>
    <div class="p-5">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">No</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Topik</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Kelas</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Jam</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Peserta</th>
                    <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Status</th>
                    <th class="text-left pb-3 text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($sesiList as $key => $s)
                <tr class="hover:bg-gray-50/50">
                    <td class="py-3 pr-4 text-gray-500">{{ $key + 1 }}</td>
                    <td class="py-3 pr-4 font-medium text-gray-900">{{ $s->topik }}</td>
                    <td class="py-3 pr-4 text-gray-500">{{ $s->kelas->nama_kelas ?? '-' }}</td>
                    <td class="py-3 pr-4 text-gray-500">{{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}</td>
                    <td class="py-3 pr-4 text-xs">{{ $s->jam_mulai }} - {{ $s->jam_selesai }}</td>
                    <td class="py-3 pr-4 text-gray-500">{{ $s->pesertaSesi->count() }}/{{ $s->kuota }}</td>
                    <td class="py-3 pr-4"><x-badge type="{{ $s->status }}">{{ ucfirst($s->status) }}</x-badge></td>
                    <td class="py-3">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('mentor.sesi.presensi', $s) }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Presensi</a>
                            @if ($s->status == 'dibuka')
                            <a href="{{ route('mentor.sesi.edit', $s) }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                            <form action="{{ route('mentor.sesi.destroy', $s) }}" method="POST" class="inline" onsubmit="return confirm('Hapus sesi ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium cursor-pointer">Hapus</button>
                            </form>
                            <form action="{{ route('mentor.sesi.tutup', $s) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <button type="submit" class="text-sm text-amber-600 hover:text-amber-800 font-medium cursor-pointer">Tutup</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="py-8 text-center text-gray-400">Belum ada sesi mentoring.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
