@props(['active'])

@php
$classes = ($active ?? false)
? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#531919] text-start text-base font-medium text-[#531919] bg-[#d6d9d9] focus:outline-none focus:bg-[#d6d9d9] focus:text-[#531919] transition duration-150 ease-in-out'
: 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-[#531919] hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
