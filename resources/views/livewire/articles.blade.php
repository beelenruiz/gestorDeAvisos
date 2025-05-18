@push('scripts')
<script>
    const USER_IS_LOGGED_IN = {{Auth::check() ? 'true' : 'false'}};
    const CSRF_TOKEN = "{{ csrf_token() }}";
    // URLs de la ruta
    const CART_ADD_URL = "{{ route('cart.add') }}";
</script>
<script src="{{ asset('js/cart.js') }}"></script>
@endpush

<div class="content">
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
        <a class="card">
            <img src="{{Storage::url($item -> images[0])}}" alt="{{$item -> name}}">
            <div class="card-content">
                <h1>{{$item -> name}}</h1>
                <div class="colores">
                    @foreach ($item -> colors as $color)
                    <section style="background-color: {{$color -> color}};"></section>
                    @endforeach
                </div>
                <p>{{$item -> brand}}</p>

                <div class="quantity-control" data-article="{{ $item->id }}">
                    <button type="button" onclick="adjustQuantity({{ $item->id }}, -1)">−</button>
                    <input type="number" min="1" value="1" id="quantity-{{ $item->id }}">
                    <button type="button" onclick="adjustQuantity({{ $item->id }}, 1)">+</button>
                </div>

                <x-button onclick="add({{$item -> id}})">Agregar al carrito</x-button>
            </div>
        </a>
        @endforeach
    </div>
</div>