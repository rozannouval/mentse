@extends('layouts.admin')
@section('title', 'Mata Kuliah')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-700">Daftar Mata Kuliah</h2>
        <button onclick="document.getElementById('modal-create').classList.remove('hidden')"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold shadow transition cursor-pointer">
            + Tambah Mata Kuliah
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase font-semibold text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Mata Kuliah</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-700">
                @forelse ($mataKuliahs as $key => $mk)
                <tr>
                    <td class="px-6 py-4">{{ $key + 1 }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $mk->nama_mata_kuliah }}</td>
                    <td class="px-6 py-4 space-x-2">
                        <button onclick="editMk({{ $mk->id }}, '{{ $mk->nama_mata_kuliah }}')" class="text-blue-600 hover:underline">Edit</button>
                        <form action="{{ route('admin.mata-kuliah.destroy', $mk) }}" method="POST" class="inline" onsubmit="return confirm('Hapus mata kuliah ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline cursor-pointer">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-400">Belum ada data mata kuliah.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modal-create" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md mx-4">
        <h3 class="text-lg font-semibold mb-4">Tambah Mata Kuliah</h3>
        <form action="{{ route('admin.mata-kuliah.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Nama Mata Kuliah</label>
                <input type="text" name="nama_mata_kuliah" required
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="document.getElementById('modal-create').classList.add('hidden')"
                    class="px-4 py-2 text-sm text-gray-500 hover:text-gray-700 cursor-pointer">Batal</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold cursor-pointer">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modal-edit" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md mx-4">
        <h3 class="text-lg font-semibold mb-4">Edit Mata Kuliah</h3>
        <form method="POST" id="form-edit">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Nama Mata Kuliah</label>
                <input type="text" name="nama_mata_kuliah" id="edit-nama" required
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')"
                    class="px-4 py-2 text-sm text-gray-500 hover:text-gray-700 cursor-pointer">Batal</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold cursor-pointer">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
function editMk(id, nama) {
    document.getElementById('edit-nama').value = nama;
    document.getElementById('form-edit').action = '/admin/mata-kuliah/' + id;
    document.getElementById('modal-edit').classList.remove('hidden');
}
</script>
@endsection
