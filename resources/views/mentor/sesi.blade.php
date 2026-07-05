@extends('layouts.mentor')
@section('title', 'Sesi Mentoring')
@section('active', 'mentor.sesi.index')

@section('content')
<div class="bg-white rounded-xl border border-gray-200">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="text-[15px] font-semibold text-gray-900">Daftar Sesi</h2>
        <a href="{{ route('mentor.sesi.create') }}" class="px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors">
            Buat Sesi
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-50">
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Topik</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Kelas</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Tanggal</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Jam</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Peserta</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Status</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($sesiList as $s)
                <tr class="hover:bg-gray-50/50">
                    <td class="px-5 py-3.5">
                        <p class="font-medium text-gray-900">{{ $s->topik }}</p>
                        <p class="text-xs text-gray-400 mt-0.5 line-clamp-1">{{ $s->deskripsi }}</p>
                    </td>
                    <td class="px-5 py-3.5 text-gray-600">{{ $s->kelas->nama_kelas ?? '-' }}</td>
                    <td class="px-5 py-3.5 text-gray-600">{{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}</td>
                    <td class="px-5 py-3.5 text-xs text-gray-500">{{ $s->jam_mulai }} &ndash; {{ $s->jam_selesai }}</td>
                    <td class="px-5 py-3.5">
                        <a href="{{ route('mentor.sesi.presensi', $s) }}" class="text-gray-600 hover:text-gray-900 font-medium">
                            {{ $s->pesertaSesi->count() }}/{{ $s->kuota }}
                        </a>
                    </td>
                    <td class="px-5 py-3.5"><x-badge type="{{ $s->status }}">{{ ucfirst($s->status) }}</x-badge></td>
                    <td class="px-5 py-3.5">
                        @if ($s->status == 'dibuka')
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" @click.outside="open = false" class="px-2.5 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-50 rounded-lg transition-colors cursor-pointer">
                                Aksi
                            </button>
                            <div x-show="open" x-cloak class="absolute right-0 mt-1 w-36 bg-white rounded-lg border border-gray-100 shadow-sm z-10 py-1">
                                <a href="{{ route('mentor.sesi.presensi', $s) }}" class="block px-3 py-2 text-xs text-gray-700 hover:bg-gray-50 transition-colors">Presensi</a>
                                <a href="{{ route('mentor.sesi.edit', $s) }}" class="block px-3 py-2 text-xs text-gray-700 hover:bg-gray-50 transition-colors">Edit</a>
                                <form action="{{ route('mentor.sesi.selesai', $s) }}" method="POST">
                                    @csrf @method('PUT')
                                    <button type="button" onclick="confirmAction(this.closest('form'), 'Selesaikan', 'Tandai <strong>{{ $s->topik }}</strong> selesai?', 'Ya, Selesaikan')" class="w-full text-left px-3 py-2 text-xs text-emerald-700 hover:bg-emerald-50 transition-colors cursor-pointer">Selesai</button>
                                </form>
                                <form action="{{ route('mentor.sesi.tutup', $s) }}" method="POST">
                                    @csrf @method('PUT')
                                    <button type="button" onclick="confirmAction(this.closest('form'), 'Tutup', 'Tutup <strong>{{ $s->topik }}</strong>?', 'Ya, Tutup')" class="w-full text-left px-3 py-2 text-xs text-amber-700 hover:bg-amber-50 transition-colors cursor-pointer">Tutup</button>
                                </form>
                                <div class="h-px bg-gray-50 my-1"></div>
                                <form action="{{ route('mentor.sesi.destroy', $s) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmAction(this.closest('form'), 'Hapus', 'Hapus <strong>{{ $s->topik }}</strong>?', 'Ya, Hapus')" class="w-full text-left px-3 py-2 text-xs text-red-600 hover:bg-red-50 transition-colors cursor-pointer">Hapus</button>
                                </form>
                            </div>
                        </div>
                        @else
                        <a href="{{ route('mentor.sesi.presensi', $s) }}" class="text-xs text-gray-500 hover:text-gray-700">Detail</a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-5 py-10 text-center text-gray-400">Belum ada sesi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
[x-cloak] { display: none !important; }
</style>
@endsection