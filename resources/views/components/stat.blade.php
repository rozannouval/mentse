@props(['title', 'value', 'color' => 'blue'])

@php
$borderColors = [
    'blue' => 'border-l-blue-500',
    'green' => 'border-l-emerald-500',
    'purple' => 'border-l-violet-500',
    'amber' => 'border-l-amber-500',
    'red' => 'border-l-red-500',
    'indigo' => 'border-l-indigo-500',
    'teal' => 'border-l-teal-500',
    'pink' => 'border-l-pink-500',
];
$borderColor = $borderColors[$color] ?? 'border-l-blue-500';
@endphp

<div class="bg-white rounded-lg border border-gray-200 border-l-4 {{ $borderColor }} p-5">
    <p class="text-sm font-medium text-gray-500">{{ $title }}</p>
    <p class="text-2xl font-bold text-gray-900 mt-0.5">{{ $value }}</p>
</div>
