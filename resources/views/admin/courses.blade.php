@extends('layouts.admin')
@section('title', 'Mata Kuliah')
@section('active', 'admin.mata-kuliah.index')

@section('content')
<div class="bg-white rounded-xl border border-slate-100 shadow-sm">
    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h2 class="text-base font-semibold text-slate-900">Daftar Mata Kuliah</h2>
            <p class="text-xs text-slate-400 mt-0.5">Total: {{ $mataKuliahs->count() }} mata kuliah</p>
        </div>
        <button onclick="openModal('modal-create')" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-colors cursor-pointer shadow-sm shadow-blue-600/20">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-100 bg-slate-50/50">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">No</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Nama Mata Kuliah</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Total Kelas</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse ($mataKuliahs as $key => $mk)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-5 py-3.5 text-slate-500">{{ $key + 1 }}</td>
                    <td class="px-5 py-3.5 font-medium text-slate-900">{{ $mk->nama_mata_kuliah }}</td>
                    <td class="px-5 py-3.5 text-slate-500">{{ $mk->kelas->count() }} kelas</td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-2">
                            <button onclick="editMk({{ $mk->id }}, '{{ $mk->nama_mata_kuliah }}')" class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md transition-colors cursor-pointer">Edit</button>
                            <form action="{{ route('admin.mata-kuliah.destroy', $mk) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="button" onclick="confirmAction(this.closest('form'), 'Hapus Mata Kuliah', 'Yakin ingin menghapus <strong>{{ $mk->nama_mata_kuliah }}</strong>?', 'Ya, Hapus')" class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-md transition-colors cursor-pointer">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-5 py-10 text-center text-slate-400">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<x-modal id="modal-create" title="Tambah Mata Kuliah">
    <form action="{{ route('admin.mata-kuliah.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Mata Kuliah <span class="text-red-500">*</span></label>
            <input type="text" name="nama_mata_kuliah" required placeholder="Contoh: Pemrograman Web II"
                class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
        </div>
        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeModal('modal-create')" class="px-4 py-2 text-sm text-slate-600 hover:text-slate-800 font-medium cursor-pointer">Batal</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors cursor-pointer shadow-sm shadow-blue-600/20">Simpan</button>
        </div>
    </form>
</x-modal>

<x-modal id="modal-edit" title="Edit Mata Kuliah">
    <form method="POST" id="form-edit">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Mata Kuliah <span class="text-red-500">*</span></label>
            <input type="text" name="nama_mata_kuliah" id="edit-nama" required
                class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
        </div>
        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeModal('modal-edit')" class="px-4 py-2 text-sm text-slate-600 hover:text-slate-800 font-medium cursor-pointer">Batal</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors cursor-pointer shadow-sm shadow-blue-600/20">Simpan</button>
        </div>
    </form>
</x-modal>

<script>
function editMk(id, nama) {
    document.getElementById('edit-nama').value = nama;
    document.getElementById('form-edit').action = '/admin/mata-kuliah/' + id;
    openModal('modal-edit');
}
</script>
@endsection
