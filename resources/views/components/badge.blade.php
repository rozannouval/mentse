@props(['type' => 'default'])

@php
$styles = [
    'default' => 'bg-gray-100 text-gray-700',
    'admin' => 'bg-red-50 text-red-700 ring-red-600/20',
    'dosen' => 'bg-violet-50 text-violet-700 ring-violet-600/20',
    'mentor' => 'bg-amber-50 text-amber-700 ring-amber-600/20',
    'mahasiswa' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
    'hadir' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
    'tidak_hadir' => 'bg-red-50 text-red-700 ring-red-600/20',
    'terdaftar' => 'bg-blue-50 text-blue-700 ring-blue-600/20',
    'dibatalkan' => 'bg-gray-50 text-gray-600 ring-gray-500/20',
    'dibuka' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
    'ditutup' => 'bg-gray-50 text-gray-600 ring-gray-500/20',
    'selesai' => 'bg-blue-50 text-blue-700 ring-blue-600/20',
    'success' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
    'warning' => 'bg-amber-50 text-amber-700 ring-amber-600/20',
    'danger' => 'bg-red-50 text-red-700 ring-red-600/20',
    'info' => 'bg-blue-50 text-blue-700 ring-blue-600/20',
];
$class = $styles[$type] ?? $styles['default'];
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ring-1 ring-inset {{ $class }}">
    {{ $slot }}
</span>
