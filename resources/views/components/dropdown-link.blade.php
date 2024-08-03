@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full px-4 py-2 border-l-2 border-green-400 text-start text-sm leading-5
            text-green-700 bg-green-50
            hover:text-green-800 hover:bg-green-100
            focus:outline-none
            transition duration-150 ease-in-out'
            : 'block w-full px-4 py-2 border-l-2 border-transparent text-start text-sm leading-5
            text-gray-600 dark:text-white
            hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 dark:hover:bg-green-600
            focus:outline-none
            transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
