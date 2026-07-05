@extends('layouts.mentor')
@section('title', 'Sesi Mentoring')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-700">Daftar Sesi Mentoring</h2>
        <a href="{{ route('mentor.sesi.create') }}" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded text-sm font-semibold shadow transition">
            + Buat Sesi Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase font-semibold text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Topik</th>
                    <th class="px-6 py-3">Kelas</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Jam</th>
                    <th class="px-6 py-3">Peserta</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-700">
                @forelse ($sesiList as $key => $sesi)
                <tr>
                    <td class="px-6 py-4">{{ $key + 1 }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $sesi->topik }}</td>
                    <td class="px-6 py-4">{{ $sesi->kelas->nama_kelas ?? '-' }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($sesi->tanggal)->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-xs">{{ $sesi->jam_mulai }} - {{ $sesi->jam_selesai }}</td>
                    <td class="px-6 py-4">{{ $sesi->pesertaSesi->count() }}/{{ $sesi->kuota }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-0.5 text-xs rounded-full {{ $sesi->status == 'dibuka' ? 'bg-green-100 text-green-700' : ($sesi->status == 'ditutup' ? 'bg-gray-100 text-gray-600' : 'bg-blue-100 text-blue-700') }}">
                            {{ ucfirst($sesi->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 space-x-2">
                        <a href="{{ route('mentor.sesi.presensi', $sesi) }}" class="text-blue-600 hover:underline">Presensi</a>
                        @if ($sesi->status == 'dibuka')
                        <a href="{{ route('mentor.sesi.edit', $sesi) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('mentor.sesi.destroy', $sesi) }}" method="POST" class="inline" onsubmit="return confirm('Hapus sesi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline cursor-pointer">Hapus</button>
                        </form>
                        <form action="{{ route('mentor.sesi.tutup', $sesi) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="text-amber-600 hover:underline cursor-pointer">Tutup</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-gray-400">Belum ada sesi mentoring.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
