@extends('layouts.admin')
@section('title', 'Tambah User')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white rounded-xl border border-slate-100 shadow-sm">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-base font-semibold text-slate-900">Tambah User Baru</h2>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-slate-500 hover:text-slate-700 font-medium">&larr; Kembali</a>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama lengkap"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="user@example.com"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                        <input type="password" name="password" required placeholder="Min 8 karakter"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Role</label>
                        <div class="relative">
                            <select name="role" id="role-select" required
                                class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 pr-9 text-sm text-slate-900 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all bg-white">
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                                <option value="mentor" {{ old('role') == 'mentor' ? 'selected' : '' }}>Mentor</option>
                                <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            </select>
                            <svg class="w-4 h-4 text-slate-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">NIM / NIDN <span class="text-slate-400 font-normal">(opsional)</span></label>
                        <input type="text" name="nim" value="{{ old('nim') }}" placeholder="NIM untuk mahasiswa"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>
                    <div id="kelas-field" class="sm:col-span-2" style="display:none">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Kelas</label>
                        <div class="relative">
                            <select name="kelas_id" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 pr-9 text-sm text-slate-900 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all bg-white">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelasList as $k)
                                <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }} ({{ $k->mataKuliah->nama_mata_kuliah ?? '-' }})</option>
                                @endforeach
                            </select>
                            <svg class="w-4 h-4 text-slate-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-5 mt-5 border-t border-slate-100">
                    <a href="{{ route('admin.users.index') }}" class="text-sm text-slate-500 hover:text-slate-700 font-medium">Batal</a>
                    <button type="submit" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-lg transition-colors cursor-pointer shadow-sm shadow-slate-900/20">
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
