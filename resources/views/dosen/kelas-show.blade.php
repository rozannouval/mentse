@extends('layouts.dosen')
@section('title', 'Detail Kelas')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
    <div class="flex justify-between items-start mb-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-700">{{ $kelas->nama_kelas }}</h2>
            <p class="text-sm text-gray-500">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</p>
        </div>
        <a href="{{ route('dosen.kelas.index') }}" class="text-blue-600 hover:underline text-sm">Kembali</a>
    </div>

    <div class="border-t border-gray-100 pt-4">
        <h3 class="text-sm font-semibold text-gray-600 mb-3">Penunjukan Mentor</h3>
        @if ($kelas->mentor)
            <p class="text-sm text-green-600 mb-3">Mentor saat ini: <strong>{{ $kelas->mentor->name }}</strong></p>
        @else
            <p class="text-sm text-amber-600 mb-3">Belum ada mentor untuk kelas ini.</p>
        @endif

        <form action="{{ route('dosen.kelas.pilih-mentor', $kelas) }}" method="POST" class="flex items-end gap-3">
            @csrf
            @method('PUT')
            <div class="flex-1">
                <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Pilih Mahasiswa sebagai Mentor</label>
                <select name="mentor_id" required
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 text-sm">
                    <option value="">Pilih Mahasiswa</option>
                    @foreach ($mahasiswas as $m)
                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2.5 rounded text-sm font-semibold transition cursor-pointer">
                Tetapkan sebagai Mentor
            </button>
        </form>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h3 class="text-sm font-semibold text-gray-600 mb-3">Peserta Kelas</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 uppercase font-semibold text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Email</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-gray-700">
                    @forelse ($mahasiswas as $key => $m)
                    <tr>
                        <td class="px-4 py-2">{{ $key + 1 }}</td>
                        <td class="px-4 py-2 font-medium">{{ $m->name }}</td>
                        <td class="px-4 py-2 text-xs">{{ $m->email }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-4 text-center text-gray-400">Belum ada peserta.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h3 class="text-sm font-semibold text-gray-600 mb-3">Sesi Mentoring</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 uppercase font-semibold text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-2">Topik</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-gray-700">
                    @forelse ($kelas->sesiMentoring as $sesi)
                    <tr>
                        <td class="px-4 py-2 font-medium">{{ $sesi->topik }}</td>
                        <td class="px-4 py-2 text-xs">{{ \Carbon\Carbon::parse($sesi->tanggal)->format('d M Y') }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-0.5 text-xs rounded-full {{ $sesi->status == 'dibuka' ? 'bg-green-100 text-green-700' : ($sesi->status == 'ditutup' ? 'bg-gray-100 text-gray-600' : 'bg-blue-100 text-blue-700') }}">
                                {{ ucfirst($sesi->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-4 text-center text-gray-400">Belum ada sesi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
