@extends('layouts.admin')
@section('title', 'Tambah User')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white rounded-lg border border-slate-200">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-slate-900">Tambah User Baru</h2>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-slate-500 hover:text-slate-700">&larr; Kembali</a>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                        <input type="password" name="password" required
                            class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Role</label>
                        <select name="role" id="role-select" required
                            class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            <option value="">Pilih Role</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                            <option value="mentor" {{ old('role') == 'mentor' ? 'selected' : '' }}>Mentor</option>
                            <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        </select>
                    </div>
                    <div id="kelas-field" class="sm:col-span-2" style="display:none">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Kelas</label>
                        <select name="kelas_id" class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            <option value="">Pilih Kelas</option>
                            @foreach ($kelasList as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-5 mt-5 border-t border-slate-100">
                    <a href="{{ route('admin.users.index') }}" class="text-sm text-slate-500 hover:text-slate-700 font-medium">Batal</a>
                    <button type="submit" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-lg transition-colors cursor-pointer">
                        Simpan User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('role-select').addEventListener('change', function() {
    document.getElementById('kelas-field').style.display = this.value === 'mahasiswa' ? 'block' : 'none';
});
@if (old('role') === 'mahasiswa')
document.getElementById('kelas-field').style.display = 'block';
@endif
</script>
@endsection
