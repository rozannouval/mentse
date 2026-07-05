@props(['name', 'label' => null, 'type' => 'text', 'value' => '', 'placeholder' => '', 'required' => false, 'help' => null])

<div class="mb-4">
    @if ($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1.5">
        {{ $label }}
        @if ($required)
        <span class="text-red-500">*</span>
        @endif
    </label>
    @endif
    <input type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200']) }}>
    @if ($help)
    <p class="mt-1 text-xs text-gray-500">{{ $help }}</p>
    @endif
    @error($name)
    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
