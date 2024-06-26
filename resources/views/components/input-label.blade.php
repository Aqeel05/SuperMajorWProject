@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-sans font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
