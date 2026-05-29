@props([
    'label',
    'active' => false,
    'align' => 'left',
    'width' => 'w-52',
])

@php
    $triggerClasses = $active
        ? 'inline-flex items-center gap-1 border-b-2 border-blue-600 text-sm font-bold text-gray-900 focus:outline-none transition duration-150 ease-in-out'
        : 'inline-flex items-center gap-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-blue-600 hover:border-blue-300 focus:outline-none focus:text-blue-600 transition duration-150 ease-in-out';
@endphp

<div class="relative flex h-16 items-center">
    <x-dropdown :align="$align" :width="$width">
        <x-slot name="trigger">
            <button type="button" class="{{ $triggerClasses }} h-full px-1">
                <span>{{ $label }}</span>
                <svg class="h-4 w-4 shrink-0 opacity-70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </x-slot>
        <x-slot name="content">
            {{ $slot }}
        </x-slot>
    </x-dropdown>
</div>
