@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex h-16 items-center border-b-2 border-blue-600 px-1 text-sm font-bold text-gray-900 focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex h-16 items-center border-b-2 border-transparent px-1 text-sm font-medium text-gray-500 hover:border-blue-300 hover:text-blue-600 focus:outline-none focus:text-blue-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
