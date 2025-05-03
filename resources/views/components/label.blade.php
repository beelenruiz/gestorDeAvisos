@props(['value'])

<label {{ $attributes->merge(['style' => '
    display: block;
    font-size: 1rem;
    font-weight: bold;
    padding-bottom: 4px;
    text-align: left;
']) }}>
    {{ $value ?? $slot }}
</label>
