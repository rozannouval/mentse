@props(['name', 'label' => null, 'options' => [], 'value' => '', 'placeholder' => null, 'required' => false])

<div class="mb-4">
    @if ($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1.5">
        {{ $label }}
        @if ($required)
        <span class="text-red-500">*</span>
        @endif
    </label>
    @endif
    <select id="{{ $name }}"
        name="{{ $name }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200']) }}>
        @if ($placeholder)
        <option value="">{{ $placeholder }}</option>
        @endif
        @foreach ($options as $optValue => $optLabel)
        <option value="{{ $optValue }}" {{ old($name, $value) == $optValue ? 'selected' : '' }}>{{ $optLabel }}</option>
        @endforeach
    </select>
    @error($name)
    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
