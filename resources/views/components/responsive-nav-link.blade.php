@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-green-400 text-start text-base font-medium text-green-700 bg-green-50
            hover:text-green-800 hover:bg-green-100
            focus:outline-none
            transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600
            hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300
            focus:outline-none
            transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
