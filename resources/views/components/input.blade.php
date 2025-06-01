@props(['disabled' => false])

<style>
    .input-focus:focus {
        border-color: #531919;
        outline: none;
        box-shadow: 0 0 0 2px rgba(83, 25, 25, 0.5);
    }
</style>

<input {{ $disabled ? 'disabled' : '' }} 
{!! $attributes->merge(['style' => 
    'padding: 0.5rem 1rem;
    font-size: 1rem;
    border-radius: 0.75rem;
    width: 100%;
    background-color: rgba(83, 25, 25, 0.2);',
    'class' => 'input-focus'
]) !!}>



<!-- @props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}> -->
