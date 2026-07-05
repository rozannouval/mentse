@extends('layouts.admin')
@section('title', 'Edit User')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white rounded-xl border border-slate-100 shadow-sm">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-base font-bold text-slate-500 overflow-hidden">
                    @if ($user->photo)
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="" class="w-full h-full object-cover">
                    @else
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <h2 class="text-base font-semibold text-slate-900">Edit User</h2>
                    <p class="text-xs text-slate-500">{{ $user->email }}</p>
                </div>
            </div>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-slate-500 hover:text-slate-700 font-medium">&larr; Kembali</a>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Password <span class="text-slate-400 font-normal">(opsional)</span></label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">NIM / NIDN</label>
                        <input type="text" name="nim" value="{{ old('nim', $user->nim) }}" placeholder="NIM untuk mahasiswa"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Role</label>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach (['admin', 'dosen', 'mentor', 'mahasiswa'] as $r)
                            <label class="role-option flex items-center gap-2 p-3 rounded-lg border {{ old('role', $user->role) == $r ? 'border-slate-900 bg-slate-50' : 'border-slate-200 hover:border-slate-300' }} cursor-pointer transition-colors">
                                <input type="radio" name="role" value="{{ $r }}" {{ old('role', $user->role) == $r ? 'checked' : '' }}
                                    class="text-slate-900 focus:ring-slate-500 role-radio" required>
                                <span class="text-sm font-medium text-slate-700 capitalize">{{ $r }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <div id="kelas-field" class="sm:col-span-2" @if($user->role !== 'mahasiswa') style="display:none" @endif>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Kelas</label>
                        <div class="relative">
                            <select name="kelas_id" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 pr-9 text-sm text-slate-900 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all bg-white">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelasList as $k)
                                <option value="{{ $k->id }}" {{ old('kelas_id', $user->kelas_id) == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                            <svg class="w-4 h-4 text-slate-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-5 mt-5 border-t border-slate-100">
                    <a href="{{ route('admin.users.index') }}" class="text-sm text-slate-500 hover:text-slate-700 font-medium">Batal</a>
                    <button type="submit" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-lg transition-colors cursor-pointer shadow-sm shadow-slate-900/20">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.role-radio').forEach(r => {
    r.addEventListener('change', function() {
        document.getElementById('kelas-field').style.display = this.value === 'mahasiswa' ? 'block' : 'none';
    });
});
</script>
@endsection
