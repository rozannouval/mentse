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

<div class="bg-white rounded-xl border border-slate-100 shadow-sm">
    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
        <h2 class="text-base font-semibold text-slate-900">Daftar Pengguna</h2>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-medium rounded-lg transition-colors shadow-sm shadow-slate-900/20">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah User
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-100 bg-slate-50/50">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">No</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">User</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">NIM / NIDN</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Email</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Role</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse ($users as $key => $user)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-5 py-3.5 text-slate-500">{{ $key + 1 }}</td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-sm font-bold text-slate-500 flex-shrink-0 overflow-hidden">
                                @if ($user->photo)
                                <img src="{{ asset('storage/' . $user->photo) }}" alt="" class="w-full h-full object-cover">
                                @else
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                @endif
                            </div>
                            <span class="font-medium text-slate-900">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3.5 text-slate-500 font-mono text-xs">
                        {{ $user->nim ?? ($user->nidn ?? '-') }}
                    </td>
                    <td class="px-5 py-3.5 text-slate-500">{{ $user->email }}</td>
                    <td class="px-5 py-3.5">
                        @php
                        $roleStyle = match($user->role) {
                            'admin' => 'bg-red-50 text-red-700 ring-red-600/20',
                            'dosen' => 'bg-violet-50 text-violet-700 ring-violet-600/20',
                            'mentor' => 'bg-amber-50 text-amber-700 ring-amber-600/20',
                            'mahasiswa' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
                            default => 'bg-slate-50 text-slate-600',
                        };
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ring-1 ring-inset {{ $roleStyle }}">{{ ucfirst($user->role) }}</span>
                    </td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-1.5">
                            <button onclick="detailUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}', '{{ $user->nim ?? '' }}', '{{ $user->nidn ?? '' }}')"
                                class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-md transition-colors cursor-pointer">Detail</button>
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
                    <td colspan="7" class="px-5 py-10 text-center text-slate-400">Belum ada data user.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<x-modal id="modal-detail" title="Detail User">
    <div class="space-y-3 text-sm" id="detail-content">
        <div class="flex items-center gap-4 pb-3 border-b border-slate-100">
            <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center text-2xl font-bold text-slate-400" id="detail-avatar"></div>
            <div>
                <p class="font-semibold text-slate-900 text-base" id="detail-name"></p>
                <p class="text-slate-500 text-sm" id="detail-email"></p>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3 pt-1">
            <div>
                <p class="text-slate-400 text-xs">NIM</p>
                <p class="font-medium text-slate-900" id="detail-nim">-</p>
            </div>
            <div>
                <p class="text-slate-400 text-xs">NIDN</p>
                <p class="font-medium text-slate-900" id="detail-nidn">-</p>
            </div>
            <div>
                <p class="text-slate-400 text-xs">Role</p>
                <p class="font-medium text-slate-900" id="detail-role"></p>
            </div>
        </div>
    </div>
    <div class="flex justify-end mt-4 pt-3 border-t border-slate-100">
        <button type="button" onclick="closeModal('modal-detail')" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-lg transition-colors cursor-pointer">Tutup</button>
    </div>
</x-modal>

<script>
function detailUser(id, name, email, role, nim, nidn) {
    document.getElementById('detail-name').textContent = name;
    document.getElementById('detail-email').textContent = email;
    document.getElementById('detail-role').textContent = role.charAt(0).toUpperCase() + role.slice(1);
    document.getElementById('detail-nim').textContent = nim || '-';
    document.getElementById('detail-nidn').textContent = nidn || '-';
    document.getElementById('detail-avatar').textContent = name.charAt(0).toUpperCase();
    openModal('modal-detail');
}
</script>
@endsection
