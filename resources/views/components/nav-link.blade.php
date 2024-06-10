@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-emerald-500 dark:border-emerald-500 text-sm font-medium leading-5 text-emerald-900 dark:text-emerald-500 focus:outline-none focus:border-emerald-500 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-xs font-medium leading-5 text-black dark:text-black hover:text-emerald-800 dark:hover:text-emerald-500 hover:border-emerald-500 dark:hover:border-emerald-500 focus:outline-none focus:text-emerald-500 dark:focus:text-emerald-300 focus:border-emerald-500 dark:focus:border-emerald-500 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
