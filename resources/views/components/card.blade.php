@props(['title' => null])

<div class="bg-white rounded-xl border border-gray-100">
    @if ($title)
    <div class="px-5 py-4 border-b border-gray-100">
        <h2 class="text-base font-semibold text-gray-900">{{ $title }}</h2>
    </div>
    @endif
    <div class="px-5 py-4">
        {{ $slot }}
    </div>
</div>
