<button 
    style="
        font-size: 1rem; 
        text-align: center; 
        color: #fff; 
        background-color: #531919; 
        padding: 6px 16px; 
        border-radius: 0.5rem;
        cursor: pointer;
        font-weight: 600;"
    type="submit"
>
    {{ $slot }}
</button>

<!-- {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150']) }} -->