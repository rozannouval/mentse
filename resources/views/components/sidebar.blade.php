@props(['role', 'active'])

@php
$accent = match($role) {
    'admin' => 'text-red-400',
    'dosen' => 'text-violet-400',
    'mentor' => 'text-amber-400',
    'mahasiswa' => 'text-emerald-400',
    default => 'text-gray-400',
};

$navItems = match($role) {
    'admin' => [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard'],
        ['label' => 'Manajemen Kelas', 'route' => 'admin.kelas.index'],
        ['label' => 'Mata Kuliah', 'route' => 'admin.mata-kuliah.index'],
        ['label' => 'Data User', 'route' => 'admin.users.index'],
        ['label' => 'Laporan', 'route' => 'admin.laporan'],
        ['label' => 'Aktivitas', 'route' => 'admin.aktivitas'],
    ],
    'dosen' => [
        ['label' => 'Dashboard', 'route' => 'dosen.dashboard'],
        ['label' => 'Kelas Saya', 'route' => 'dosen.kelas.index'],
        ['label' => 'Monitoring', 'route' => 'dosen.monitoring'],
    ],
    'mentor' => [
        ['label' => 'Dashboard', 'route' => 'mentor.dashboard'],
        ['label' => 'Sesi Mentoring', 'route' => 'mentor.sesi.index'],
        ['label' => 'Peserta', 'route' => 'mentor.peserta'],
        ['label' => 'Feedback', 'route' => 'mentor.feedback'],
    ],
    'mahasiswa' => [
        ['label' => 'Dashboard', 'route' => 'mahasiswa.dashboard'],
        ['label' => 'Sesi Tersedia', 'route' => 'mahasiswa.sesi.index'],
        ['label' => 'Riwayat Sesi', 'route' => 'mahasiswa.riwayat'],
        ['label' => 'Feedback Saya', 'route' => 'mahasiswa.feedback.index'],
    ],
    default => [],
};
@endphp

<aside class="fixed inset-y-0 left-0 w-56 bg-white border-r border-gray-100 flex flex-col z-30">
    <div class="flex items-center gap-2.5 px-5 h-16 border-b border-gray-50">
        <span class="w-7 h-7 rounded-lg bg-gray-900 flex items-center justify-center text-white text-xs font-bold">M</span>
        <span class="font-semibold text-gray-900 text-sm tracking-tight">MENTSE</span>
    </div>

    <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">
        @foreach ($navItems as $item)
        @php
            $isActive = request()->routeIs($item['route']);
        @endphp
        <a href="{{ route($item['route']) }}"
            class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition-colors
            {{ $isActive ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
            <span class="w-1.5 h-1.5 rounded-full {{ $isActive ? $accent . ' bg-current' : 'bg-transparent' }}"></span>
            {{ $item['label'] }}
        </a>
        @endforeach
    </nav>

    <div class="px-5 py-3 border-t border-gray-50">
        <p class="text-[11px] text-gray-400">MENTSE v1.0</p>
    </div>
</aside>