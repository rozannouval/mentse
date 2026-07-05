@extends('layouts.mentor')
@section('title', 'Presensi Sesi')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
    <h2 class="text-lg font-semibold text-gray-700 mb-2">{{ $sesi->topik }}</h2>
    <p class="text-sm text-gray-500">{{ $sesi->kelas->nama_kelas ?? '-' }} | {{ \Carbon\Carbon::parse($sesi->tanggal)->format('d M Y') }} {{ $sesi->jam_mulai }}-{{ $sesi->jam_selesai }}</p>
    <p class="text-sm text-gray-500 mt-1">Status: <span class="font-semibold">{{ ucfirst($sesi->status) }}</span></p>

    @if ($sesi->status == 'dibuka')
    <form action="{{ route('mentor.sesi.tutup', $sesi) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm font-semibold transition cursor-pointer"
            onclick="return confirm('Tutup sesi ini? Peserta tidak bisa mendaftar lagi.')">
            Tutup Sesi
        </button>
    </form>
    @endif

    <a href="{{ route('mentor.sesi.index') }}" class="text-blue-600 hover:underline text-sm ml-3">Kembali</a>
</div>

<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
    <h3 class="text-sm font-semibold text-gray-600 mb-4">Peserta Terdaftar</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase font-semibold text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Mahasiswa</th>
                    <th class="px-6 py-3">Tanggal Daftar</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-700">
                @forelse ($sesi->pesertaSesi as $key => $ps)
                <tr>
                    <td class="px-6 py-4">{{ $key + 1 }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $ps->mahasiswa->name ?? '-' }}</td>
                    <td class="px-6 py-4 text-xs">{{ $ps->tanggal_daftar ? \Carbon\Carbon::parse($ps->tanggal_daftar)->format('d M Y H:i') : '-' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-0.5 text-xs rounded-full 
                            {{ $ps->status == 'hadir' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $ps->status == 'tidak_hadir' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $ps->status == 'terdaftar' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $ps->status == 'dibatalkan' ? 'bg-gray-100 text-gray-600' : '' }}">
                            {{ ucfirst(str_replace('_', ' ', $ps->status)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if ($ps->status == 'terdaftar')
                        <form action="{{ route('mentor.sesi.presensi.update', [$sesi, $ps]) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="hadir">
                            <button type="submit" class="text-green-600 hover:underline cursor-pointer">Hadir</button>
                        </form>
                        <form action="{{ route('mentor.sesi.presensi.update', [$sesi, $ps]) }}" method="POST" class="inline ml-2">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="tidak_hadir">
                            <button type="submit" class="text-red-600 hover:underline cursor-pointer">Tidak Hadir</button>
                        </form>
                        @elseif ($ps->status == 'tidak_hadir')
                        <form action="{{ route('mentor.sesi.presensi.update', [$sesi, $ps]) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="hadir">
                            <button type="submit" class="text-green-600 hover:underline cursor-pointer">Ubah ke Hadir</button>
                        </form>
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-400">Belum ada peserta.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
