@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center  border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out px-2 bg-gray-500'
            : 'inline-flex items-center  border-b-2 border-transparent text-sm font-medium leading-5 text-gray-800 hover:text-gray-700 hover:border-blue-400 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out ';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
