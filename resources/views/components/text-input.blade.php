@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-white dark:text-black focus:border-black dark:focus:border-black focus:ring-black dark:focus:ring-black rounded-md shadow-sm']) !!}>
