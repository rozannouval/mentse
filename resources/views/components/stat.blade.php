@props(['title', 'value', 'color' => 'gray'])

@php
$accent = [
    'blue' => 'bg-blue-500',
    'green' => 'bg-emerald-500',
    'violet' => 'bg-violet-500',
    'amber' => 'bg-amber-500',
    'indigo' => 'bg-indigo-500',
    'red' => 'bg-red-500',
    'emerald' => 'bg-emerald-500',
    'gray' => 'bg-gray-300',
];
$bar = $accent[$color] ?? $accent['gray'];
@endphp

<div class="bg-white rounded-xl border border-gray-200 px-5 py-4">
    <p class="text-xs text-gray-500 mb-0.5">{{ $title }}</p>
    <p class="text-2xl font-semibold text-gray-900 tracking-tight">{{ $value }}</p>
    <div class="mt-3 h-0.5 w-full bg-gray-100 rounded-full overflow-hidden">
        <div class="h-full w-full {{ $bar }} rounded-full"></div>
    </div>
</div>