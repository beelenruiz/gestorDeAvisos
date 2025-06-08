<style>
    .x-button {
        font-size: 1rem; 
        text-align: center; 
        color: #fff; 
        background-color: #531919; 
        padding: 6px 16px; 
        border-radius: 0.5rem;
        cursor: pointer;
        font-weight: 600;
        margin: 5px;
    }

    @media (max-width: 600px) {
        .x-button {
            font-size: 12px;
            padding: 3px 6px;
        }
    }
</style>

@props(['href' => null])

@if ($href)
    <a href="{{ $href }}" class="x-button" {{ $attributes }}>
        {{ $slot }}
    </a>
@else
    <button class="x-button"
        {{ $attributes->merge([ 'type' => 'submit']) }}
    >
        {{ $slot }}
    </button>
@endif
<!-- <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-slate-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-700 focus:bg-slate-700 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button> -->
