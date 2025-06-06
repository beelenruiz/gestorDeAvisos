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
    <x-button class="filter-toggle lg:hidden" onclick="toggleFilter()">Filtrar</x-button>

    <div class="filter">
        <div class="filter-secction">
            <p>BUSCADOR</p>
            <form role="search">
                <x-input type="search" placeholder="Buscar" aria-label="Buscar" wire:model.live="buscar"></x-input>
            </form>
        </div>

        <div class="filter-secction">
            <p>CATEGORÍA:</p>
            @foreach($categories as $category)
            <label class="filter-option">
                <input type="checkbox" wire:model.live="selectedCategories" value="{{$category -> id}}">
                <span>{{$category -> name}}</span><br>
            </label>
            @endforeach
        </div>

        <div class="filter-secction">
            <p>COLORES:</p>
            @foreach($colors as $color)
            <label class="filter-option">
                <input type="checkbox" wire:model.live="selectedColors" value="{{$color -> id}}">
                <span>{{$color -> name}}</span><br>
            </label>
            @endforeach
        </div>
    </div>

    <div class="cards">
        @foreach ($articles as $item)
        <div class="card">
        <a href="{{route('article.show', $item->id)}}"><img src="{{Storage::url($item -> images -> first() -> path)}}" alt="{{$item -> name}}"></a>
            <div class="card-content">
                <a href="{{route('article.show', $item->id)}}"><h1>{{$item -> name}}</h1></a>
                <div class="colores">
                    @foreach ($item -> colors as $color)
                    <section style="background-color: {{$color -> color}};"></section>
                    @endforeach
                </div>
                <p>{{$item -> brand}}</p>

                @if (!Auth::check() || (Auth::check() && Auth::user()->company))
                <div class="quantity quantity-control z-50" data-article="{{ $item->id }}" style="margin: 10px 0;">
                    <button type="button" class="quantity-button" onclick="adjustQuantity({{ $item->id }}, -1)">−</button>
                    <x-input type="number" min="1" value="1" id="quantity-{{ $item->id }}" class="quantity-input" style="width: 4rem;"/>
                    <button type="button" class="quantity-button" onclick="adjustQuantity({{ $item->id }}, 1)">+</button>
                </div>

                <span class="price">{{$item -> price}}€</span><x-button onclick="add({{$item -> id}})">Agregar al carrito</x-button>
                @else
                <p>{{$item -> price}}€</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>