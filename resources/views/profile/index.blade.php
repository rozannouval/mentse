@extends('layouts.' . $roleRoute)
@section('title', 'Profil Saya')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg border border-slate-200 p-6 text-center">
            <div class="w-28 h-28 rounded-full mx-auto mb-4 overflow-hidden bg-slate-100 ring-4 ring-slate-100">
                @if ($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full flex items-center justify-center text-4xl font-bold text-slate-400">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                @endif
            </div>
            <h2 class="text-lg font-bold text-slate-900">{{ $user->name }}</h2>
            <p class="text-sm text-slate-500">{{ $user->email }}</p>
            <div class="mt-3 space-y-1">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                    {{ ucfirst($user->role) }}
                </span>
                @if ($user->nim)
                <div><span class="text-xs text-slate-400">NIM: </span><span class="text-xs font-mono text-slate-600">{{ $user->nim }}</span></div>
                @endif
                @if ($user->nidn)
                <div><span class="text-xs text-slate-400">NIDN: </span><span class="text-xs font-mono text-slate-600">{{ $user->nidn }}</span></div>
                @endif
            </div>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-100">
                <h2 class="text-sm font-semibold text-slate-900">Edit Profil</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Foto Profil</label>
                            <input type="file" name="photo" accept="image/jpg,image/jpeg,image/png"
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer">
                            <p class="text-xs text-slate-400 mt-1">Format: JPG/PNG, Maks: 2MB</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        </div>

                        @if ($user->role === 'mahasiswa')
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">NIM</label>
                            <input type="text" name="nim" value="{{ old('nim', $user->nim) }}"
                                class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        </div>
                        @endif

                        @if ($user->role === 'dosen')
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">NIDN</label>
                            <input type="text" name="nidn" value="{{ old('nidn', $user->nidn) }}"
                                class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Password Baru</label>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                                class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Role</label>
                            <input type="text" value="{{ ucfirst($user->role) }}" disabled
                                class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm text-slate-400 bg-slate-50 cursor-not-allowed">
                        </div>
                    </div>

                    <div class="flex justify-end pt-5 mt-5 border-t border-slate-100">
                        <button type="submit" class="px-5 py-2 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-lg transition-colors cursor-pointer">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
