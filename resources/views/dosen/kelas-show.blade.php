@extends('layouts.dosen')
@section('title', 'Detail Kelas')
@section('active', 'dosen.kelas.index')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="lg:col-span-2 bg-white rounded-lg border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-base font-semibold text-gray-900">{{ $kelas->nama_kelas }}</h2>
            <a href="{{ route('dosen.kelas.index') }}" class="text-sm text-violet-600 hover:text-violet-800 font-medium">&larr; Kembali</a>
        </div>
        <div class="p-5">
            <dl class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div class="p-3 bg-gray-50 rounded-lg">
                    <dt class="text-gray-500 text-xs">Mata Kuliah</dt>
                    <dd class="font-semibold text-gray-900 mt-0.5">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</dd>
                </div>
                <div class="p-3 bg-gray-50 rounded-lg">
                    <dt class="text-gray-500 text-xs">Dosen</dt>
                    <dd class="font-semibold text-gray-900 mt-0.5">{{ $kelas->dosen->name ?? '-' }}</dd>
                </div>
                <div class="p-3 bg-gray-50 rounded-lg">
                    <dt class="text-gray-500 text-xs">Peserta</dt>
                    <dd class="font-semibold text-gray-900 mt-0.5">{{ $mahasiswas->count() }} orang</dd>
                </div>
                <div class="p-3 bg-gray-50 rounded-lg">
                    <dt class="text-gray-500 text-xs">Sesi</dt>
                    <dd class="font-semibold text-gray-900 mt-0.5">{{ $kelas->sesiMentoring->count() }} sesi</dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-900">Status Mentor</h2>
        </div>
        <div class="p-5 text-center">
            @if ($kelas->mentor)
            <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-3">
                <span class="text-2xl font-bold text-emerald-600">{{ strtoupper(substr($kelas->mentor->name, 0, 1)) }}</span>
            </div>
            <p class="font-semibold text-gray-900">{{ $kelas->mentor->name }}</p>
            <p class="text-xs text-gray-500">Mentor Aktif</p>
            @else
            <div class="w-16 h-16 rounded-full bg-amber-100 flex items-center justify-center mx-auto mb-3">
                <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
            </div>
            <p class="font-semibold text-amber-600">Belum Ada Mentor</p>
            <p class="text-xs text-gray-500 mt-1">Pilih mahasiswa untuk dijadikan mentor</p>
            @endif
        </div>
    </div>
</div>

@if (!$kelas->mentor)
<div class="bg-white rounded-lg border border-gray-200 mb-6">
    <div class="px-5 py-4 border-b border-gray-100">
        <h2 class="text-base font-semibold text-gray-900">Penunjukan Mentor</h2>
    </div>
    <div class="p-5">
        <div class="p-4 bg-violet-50 rounded-xl border border-violet-100">
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-violet-700">Pilih salah satu mahasiswa di bawah untuk dijadikan mentor kelas ini. Setelah ditunjuk, role mahasiswa akan berubah menjadi mentor.</p>
            </div>

            <form action="{{ route('dosen.kelas.pilih-mentor', $kelas) }}" method="POST" class="flex flex-col sm:flex-row items-end gap-3">
                @csrf
                @method('PUT')
                <div class="flex-1 w-full">
                    <label class="block text-xs font-semibold text-violet-700 uppercase tracking-wider mb-1.5">Daftar Mahasiswa</label>
                    <select name="mentor_id" required
                        class="block w-full rounded-lg border border-violet-200 px-3 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 bg-white">
                        <option value="">-- Pilih Mahasiswa --</option>
                        @foreach ($mahasiswas as $m)
                        <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->email }})</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-violet-600 hover:bg-violet-700 text-white text-sm font-medium rounded-lg transition-colors cursor-pointer">
                    Tetapkan sebagai Mentor
                </button>
            </form>
        </div>
    </div>
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-900">Peserta Kelas ({{ $mahasiswas->count() }})</h2>
        </div>
        <div class="p-5">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">No</th>
                        <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Nama</th>
                        <th class="text-left pb-3 text-xs font-semibold text-gray-500 uppercase">Email</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($mahasiswas as $key => $m)
                    <tr class="hover:bg-gray-50/50">
                        <td class="py-3 pr-4 text-gray-500">{{ $key + 1 }}</td>
                        <td class="py-3 pr-4">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-500">
                                    {{ strtoupper(substr($m->name, 0, 1)) }}
                                </div>
                                <span class="font-medium text-gray-900">{{ $m->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-gray-500 text-xs">{{ $m->email }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-8 text-center text-gray-400">Belum ada peserta.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-900">Sesi Mentoring</h2>
        </div>
        <div class="p-5">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Topik</th>
                        <th class="text-left pb-3 pr-4 text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                        <th class="text-left pb-3 text-xs font-semibold text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($kelas->sesiMentoring as $s)
                    <tr class="hover:bg-gray-50/50">
                        <td class="py-3 pr-4 font-medium text-gray-900">{{ $s->topik }}</td>
                        <td class="py-3 pr-4 text-gray-500">{{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}</td>
                        <td class="py-3"><x-badge type="{{ $s->status }}">{{ ucfirst($s->status) }}</x-badge></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-8 text-center text-gray-400">Belum ada sesi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
