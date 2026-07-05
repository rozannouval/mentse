@extends('layouts.admin')
@section('title', 'Data User')

@section('content')
<div class="grid grid-cols-4 gap-4 mb-6">
    @php
    $roleCounts = ['admin' => 0, 'dosen' => 0, 'mentor' => 0, 'mahasiswa' => 0];
    foreach ($users as $u) { if (isset($roleCounts[$u->role])) $roleCounts[$u->role]++; }
    @endphp
    <x-stat title="Admin" :value="$roleCounts['admin']" color="red" />
    <x-stat title="Dosen" :value="$roleCounts['dosen']" color="violet" />
    <x-stat title="Mentor" :value="$roleCounts['mentor']" color="amber" />
    <x-stat title="Mahasiswa" :value="$roleCounts['mahasiswa']" color="green" />
</div>

<div class="bg-white rounded-xl border border-gray-200">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="text-[15px] font-semibold text-gray-900">Daftar Pengguna</h2>
        <a href="{{ route('admin.users.create') }}" class="px-3 py-1.5 bg-gray-900 hover:bg-gray-800 text-white text-xs font-medium rounded-lg transition-colors">
            Tambah User
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-50">
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">No</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">User</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">NIM/NIDN</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Kelas</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Email</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Role</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($users as $key => $user)
                <tr class="hover:bg-gray-50/50">
                    <td class="px-5 py-3.5 text-gray-500">{{ $key + 1 }}</td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-sm font-bold text-gray-500 flex-shrink-0 overflow-hidden">
                                @if ($user->photo)
                                <img src="{{ asset('storage/' . $user->photo) }}" alt="" class="w-full h-full object-cover">
                                @else
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                @endif
                            </div>
                            <span class="font-medium text-gray-900">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3.5 text-xs font-mono text-gray-500">
                        @if ($user->role === 'dosen')
                            {{ $user->nidn }}
                        @elseif (in_array($user->role, ['mentor', 'mahasiswa']))
                            {{ $user->nim }}
                        @endif
                    </td>
                    <td class="px-5 py-3.5 text-xs text-gray-500">
                        @if (in_array($user->role, ['mahasiswa', 'mentor']))
                            {{ $user->kelas->nama_kelas ?? '-' }}
                        @else
                        <span class="text-gray-300">&mdash;</span>
                        @endif
                    </td>
                    <td class="px-5 py-3.5 text-gray-500">{{ $user->email }}</td>
                    <td class="px-5 py-3.5">
                        @php
                        $roleStyle = match($user->role) {
                            'admin' => 'bg-red-50 text-red-700',
                            'dosen' => 'bg-violet-50 text-violet-700',
                            'mentor' => 'bg-amber-50 text-amber-700',
                            'mahasiswa' => 'bg-emerald-50 text-emerald-700',
                            default => 'bg-gray-50 text-gray-600',
                        };
                        @endphp
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium {{ $roleStyle }}">{{ ucfirst($user->role) }}</span>
                    </td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-1.5">
                            <button onclick="detailUser('{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}', '{{ $user->nim ?? '' }}', '{{ $user->nidn ?? '' }}', '{{ $user->kelas->nama_kelas ?? '' }}')"
                                class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors cursor-pointer">Detail</button>
                            <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md transition-colors">Edit</a>
                            @if ($user->role !== 'admin')
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="button" onclick="confirmAction(this.closest('form'), 'Hapus User', 'Yakin ingin menghapus user <strong>{{ $user->name }}</strong>?', 'Ya, Hapus')" class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-md transition-colors cursor-pointer">Hapus</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-5 py-10 text-center text-gray-400">Belum ada data user.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<x-modal id="modal-detail" title="Detail User">
    <div class="space-y-3 text-sm" id="detail-content">
        <div class="flex items-center gap-4 pb-3 border-b border-gray-100">
            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center text-2xl font-bold text-gray-400" id="detail-avatar"></div>
            <div>
                <p class="font-semibold text-gray-900 text-base" id="detail-name"></p>
                <p class="text-gray-500 text-sm" id="detail-email"></p>
            </div>
        </div>
        <div class="pt-1">
            <div id="detail-nim-field">
                <p class="text-gray-400 text-xs">NIM</p>
                <p class="font-medium text-gray-900" id="detail-nim"></p>
            </div>
            <div id="detail-nidn-field" style="display:none">
                <p class="text-gray-400 text-xs">NIDN</p>
                <p class="font-medium text-gray-900" id="detail-nidn"></p>
            </div>
            <div class="mt-3" id="detail-kelas-field">
                <p class="text-gray-400 text-xs">Kelas</p>
                <p class="font-medium text-gray-900" id="detail-kelas"></p>
            </div>
            <div class="mt-3">
                <p class="text-gray-400 text-xs">Role</p>
                <p class="font-medium text-gray-900" id="detail-role"></p>
            </div>
        </div>
    </div>
    <div class="flex justify-end mt-4 pt-3 border-t border-gray-100">
        <button type="button" onclick="closeModal('modal-detail')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors cursor-pointer">Tutup</button>
    </div>
</x-modal>

<script>
function detailUser(name, email, role, nim, nidn, kelas) {
    document.getElementById('detail-name').textContent = name;
    document.getElementById('detail-email').textContent = email;
    document.getElementById('detail-role').textContent = role.charAt(0).toUpperCase() + role.slice(1);
    document.getElementById('detail-avatar').textContent = name.charAt(0).toUpperCase();

    var nimField = document.getElementById('detail-nim-field');
    var nidnField = document.getElementById('detail-nidn-field');
    var kelasField = document.getElementById('detail-kelas-field');

    if (role === 'dosen') {
        nimField.style.display = 'none';
        nidnField.style.display = 'block';
        document.getElementById('detail-nidn').textContent = nidn || '-';
        kelasField.style.display = 'none';
    } else if (role === 'mentor' || role === 'mahasiswa') {
        nimField.style.display = 'block';
        nidnField.style.display = 'none';
        document.getElementById('detail-nim').textContent = nim || '-';
        kelasField.style.display = 'block';
        document.getElementById('detail-kelas').textContent = kelas || '-';
    } else {
        nimField.style.display = 'none';
        nidnField.style.display = 'none';
        kelasField.style.display = 'none';
    }

    openModal('modal-detail');
}
</script>
@endsection