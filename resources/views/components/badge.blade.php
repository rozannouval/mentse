@props(['type' => 'default'])

@php
$styles = [
    'default' => 'bg-gray-100 text-gray-700',
    'admin' => 'bg-red-50 text-red-700',
    'dosen' => 'bg-violet-50 text-violet-700',
    'mentor' => 'bg-amber-50 text-amber-700',
    'mahasiswa' => 'bg-emerald-50 text-emerald-700',
    'hadir' => 'bg-emerald-50 text-emerald-700',
    'tidak_hadir' => 'bg-red-50 text-red-700',
    'terdaftar' => 'bg-blue-50 text-blue-700',
    'dibuka' => 'bg-emerald-50 text-emerald-700',
    'ditutup' => 'bg-gray-100 text-gray-600',
    'selesai' => 'bg-blue-50 text-blue-700',
    'success' => 'bg-emerald-50 text-emerald-700',
    'warning' => 'bg-amber-50 text-amber-700',
    'danger' => 'bg-red-50 text-red-700',
    'info' => 'bg-blue-50 text-blue-700',
];
$class = $styles[$type] ?? $styles['default'];
@endphp

<span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium {{ $class }}">
    {{ $slot }}
</span>