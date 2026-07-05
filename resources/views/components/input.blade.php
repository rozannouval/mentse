@props(['name', 'label' => null, 'type' => 'text', 'value' => '', 'placeholder' => '', 'required' => false, 'help' => null])

<div class="mb-4">
    @if ($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-1.5">
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
        {{ $attributes->merge(['class' => 'block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200']) }}>
    @if ($help)
    <p class="mt-1 text-xs text-slate-500">{{ $help }}</p>
    @endif
    @error($name)
    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
