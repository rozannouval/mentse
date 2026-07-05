@extends('layouts.admin')
@section('title', 'Tambah User')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white rounded-xl border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-[15px] font-semibold text-gray-900">Tambah User</h2>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Kembali</a>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama lengkap"
                            class="w-full rounded-lg border border-gray-200 px-3.5 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-gray-400 transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="user@example.com"
                            class="w-full rounded-lg border border-gray-200 px-3.5 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-gray-400 transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                        <input type="password" name="password" required placeholder="Min 8 karakter"
                            class="w-full rounded-lg border border-gray-200 px-3.5 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-gray-400 transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Role</label>
                        <div class="relative">
                            <select name="role" id="role-select" required
                                class="w-full rounded-lg border border-gray-200 px-3.5 py-2.5 pr-9 text-sm text-gray-900 appearance-none focus:outline-none focus:border-gray-400 transition-colors bg-white">
                                <option value="">Pilih Role</option>
                                <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                                <option value="mentor" {{ old('role') == 'mentor' ? 'selected' : '' }}>Mentor</option>
                                <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            </select>
                            <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">NIM <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="nim" value="{{ old('nim') }}" placeholder="NIM untuk mahasiswa"
                            class="w-full rounded-lg border border-gray-200 px-3.5 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-gray-400 transition-colors">
                    </div>
                    <div id="kelas-field" class="sm:col-span-2" style="display:none">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kelas</label>
                        <div class="relative">
                            <select name="kelas_id" class="w-full rounded-lg border border-gray-200 px-3.5 py-2.5 pr-9 text-sm text-gray-900 appearance-none focus:outline-none focus:border-gray-400 transition-colors bg-white">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelasList as $k)
                                <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }} ({{ $k->mataKuliah->nama_mata_kuliah ?? '-' }})</option>
                                @endforeach
                            </select>
                            <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-5 mt-5 border-t border-gray-100">
                    <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
                    <button type="submit" class="px-5 py-2.5 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors cursor-pointer">
                        Simpan
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