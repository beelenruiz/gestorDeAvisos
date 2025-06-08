@push('scripts')
<script>
    const USER_IS_LOGGED_IN = {{Auth::check() ? 'true' : 'false'}};
    const CSRF_TOKEN = "{{ csrf_token() }}";
    // URLs de la ruta
    const CART_ADD_URL = "{{ route('cart.add') }}";
</script>
<script src="{{ asset('js/cart.js') }}"></script>

<script>
    function toggleFilter() {
        const panel = document.querySelector('.filter');
        panel.classList.toggle('show');
    }
</script>
@endpush

<div class="content">
    <button class="filter-toggle lg:hidden" aria-expanded="false" aria-controls="filter-panel" onclick="toggleFilter()">Filtrar</button>

    <div class="filter" id="filter-panel">
        <div class="filter-secction" aria-labelledby="search-label">
            <p id="search-label">BUSCADOR</p>
            <form role="search">
                <x-input type="search" placeholder="Buscar" aria-label="Buscar" wire:model.live="buscar"></x-input>
            </form>
        </div>

        <div class="filter-secction" aria-labelledby="category-label">
            <p id="category-label">CATEGORÍA:</p>
            @foreach($categories as $category)
            <label class="filter-option">
                <input type="checkbox" wire:model.live="selectedCategories" value="{{$category -> id}}"
                aria-checked="{{ in_array($category->id, $selectedCategories ?? []) ? 'true' : 'false' }}">
                <span>{{$category -> name}}</span><br>
            </label>
            @endforeach
        </div>

        <div class="filter-secction" aria-labelledby="color-label">
            <p id="color-label">COLORES:</p>
            @foreach($colors as $color)
            <label class="filter-option">
                <input type="checkbox" wire:model.live="selectedColors" value="{{$color -> id}}"
                aria-checked="{{ in_array($color->id, $selectedColors ?? []) ? 'true' : 'false' }}">
                <span>{{$color -> name}}</span><br>
            </label>
            @endforeach
        </div>
    </div>

    <div class="cards" aria-label="Artículos disponibles">
        @foreach ($articles as $item)
        <div class="card">
        <a href="{{route('article.show', $item->id)}}"><img src="{{Storage::url($item -> images -> first() -> path)}}" alt="{{$item -> name}}"></a>
            <div class="card-content">
                <a href="{{route('article.show', $item->id)}}"><h1>{{$item -> name}}</h1></a>
                <div class="colores" aria-label="Colores disponibles">
                    @foreach ($item -> colors as $color)
                    <section aria-label="Color disponible: {{ $color->name }}" style="background-color: {{$color -> color}};"></section>
                    @endforeach
                </div>
                <p>{{$item -> brand}}</p>

                @if (!Auth::check() || (Auth::check() && Auth::user()->company))
                <div class="quantity quantity-control z-50" data-article="{{ $item->id }}" style="margin: 10px 0;">
                    <button type="button" class="quantity-button" aria-label="Disminuir cantidad" onclick="adjustQuantity({{ $item->id }}, -1)">−</button>
                    <x-input type="number" min="1" value="1" id="quantity-{{ $item->id }}" class="quantity-input" style="width: 4rem;"/>
                    <button type="button" class="quantity-button" aria-label="Aumentar cantidad" onclick="adjustQuantity({{ $item->id }}, 1)">+</button>
                </div>

                <span class="price">{{$item -> price}}€</span><x-button onclick="add({{$item -> id}})" aria-label="Agregar {{ $item->name }} al carrito">Agregar al carrito</x-button>
                @else
                <p>{{$item -> price}}€</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>