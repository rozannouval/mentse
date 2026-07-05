@props(['name', 'label' => null, 'options' => [], 'value' => '', 'placeholder' => null, 'required' => false])

<div class="mb-4">
    @if ($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-1.5">
        {{ $label }}
        @if ($required)
        <span class="text-red-500">*</span>
        @endif
    </label>
    @endif
    <div class="relative">
        <select id="{{ $name }}"
            name="{{ $name }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 pr-9 text-sm text-slate-900 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 bg-white']) }}>
            @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
            @endif
            @foreach ($options as $optValue => $optLabel)
            <option value="{{ $optValue }}" {{ old($name, $value) == $optValue ? 'selected' : '' }}>{{ $optLabel }}</option>
            @endforeach
        </select>
        <svg class="w-4 h-4 text-slate-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
    @error($name)
    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
