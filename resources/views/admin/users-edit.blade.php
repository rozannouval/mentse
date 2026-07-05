@extends('layouts.admin')
@section('title', 'Edit User')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 max-w-lg">
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
        </div>
        <div class="mb-4">
            <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
        </div>
        <div class="mb-4">
            <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Password <span class="text-gray-400 font-normal">(kosongkan jika tidak diubah)</span></label>
            <input type="password" name="password"
                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
        </div>
        <div class="mb-4">
            <label class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Role</label>
            <select name="role" required
                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm">
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="dosen" {{ old('role', $user->role) == 'dosen' ? 'selected' : '' }}>Dosen</option>
                <option value="mentor" {{ old('role', $user->role) == 'mentor' ? 'selected' : '' }}>Mentor</option>
                <option value="mahasiswa" {{ old('role', $user->role) == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
            </select>
        </div>
        <div class="flex justify-between items-center">
            <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded text-sm font-semibold transition cursor-pointer">Simpan</button>
        </div>
    </form>
</div>
@endsection
