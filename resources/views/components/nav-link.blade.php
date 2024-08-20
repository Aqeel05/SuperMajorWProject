@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-green-400 dark:border-white text-sm font-medium leading-5 text-gray-700 dark:text-gray-100
            focus:outline-none
            transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-white
            hover:text-gray-700 dark:hover:text-gray-200 hover:border-gray-300 dark:hover:border-gray-200
            focus:outline-none
            transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
