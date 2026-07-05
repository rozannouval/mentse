@extends('layouts.admin')
@section('title', 'Manajemen Kelas')
@section('active', 'admin.kelas.index')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <x-stat title="Total Kelas" :value="$kelasList->count()" color="blue" />
    <x-stat title="Ada Mentor" :value="$kelasList->filter(fn($k) => $k->mentor_id)->count()" color="green" />
    <x-stat title="Tanpa Mentor" :value="$kelasList->filter(fn($k) => !$k->mentor_id)->count()" color="amber" />
</div>

<div class="bg-white rounded-xl border border-slate-100 shadow-sm">
    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
        <h2 class="text-base font-semibold text-slate-900">Daftar Kelas</h2>
        <a href="{{ route('admin.kelas.create') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-colors shadow-sm shadow-blue-600/20">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Kelas
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-100 bg-slate-50/50">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">No</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Kelas</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Mata Kuliah</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Dosen</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Mentor</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Peserta</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse ($kelasList as $key => $kelas)
                @php $totalPeserta = \App\Models\User::where('role', 'mahasiswa')->where('kelas_id', $kelas->id)->count(); @endphp
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-5 py-3.5 text-slate-500">{{ $key + 1 }}</td>
                    <td class="px-5 py-3.5 font-medium text-slate-900">{{ $kelas->nama_kelas }}</td>
                    <td class="px-5 py-3.5 text-slate-500">{{ $kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</td>
                    <td class="px-5 py-3.5 text-slate-500">{{ $kelas->dosen->name ?? '-' }}</td>
                    <td class="px-5 py-3.5">
                        @if ($kelas->mentor)
                        <span class="text-emerald-600 font-medium text-xs">{{ $kelas->mentor->name }}</span>
                        @else
                        <span class="text-slate-400">-</span>
                        @endif
                    </td>
                    <td class="px-5 py-3.5 text-slate-500">{{ $totalPeserta }}</td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.kelas.show', $kelas) }}" class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-md transition-colors">Detail</a>
                            <a href="{{ route('admin.kelas.edit', $kelas) }}" class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md transition-colors">Edit</a>
                            <form action="{{ route('admin.kelas.destroy', $kelas) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="button" onclick="confirmAction(this.closest('form'), 'Hapus Kelas', 'Yakin ingin menghapus kelas <strong>{{ $kelas->nama_kelas }}</strong>? Semua data terkait akan ikut terhapus.', 'Ya, Hapus')" class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-md transition-colors cursor-pointer">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-5 py-10 text-center text-slate-400">Belum ada kelas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
