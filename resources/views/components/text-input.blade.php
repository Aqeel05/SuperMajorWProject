@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'text-sm text-gray-600 dark:text-white bg-white dark:bg-gray-900 border-gray-300 dark:border-gray-600 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm']) !!}>
