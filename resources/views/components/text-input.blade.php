@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => ' border-b border-gray-400 focus:outline-gray-200 py-2 px-2 w-full mb-2']) !!}>
