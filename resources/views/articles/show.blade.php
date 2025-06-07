<x-app-layout>
    @push('scripts')
    <script>
        const USER_IS_LOGGED_IN = {{Auth::check() ? 'true' : 'false'}};
        const CSRF_TOKEN = "{{ csrf_token() }}";
        // URLs de la ruta
        const CART_ADD_URL = "{{ route('cart.add') }}";
    </script>
    <script src="{{ asset('js/cart.js') }}"></script>
    @endpush

    <div class="article">
        <img src="{{Storage::url($article -> images -> first() -> path)}}">

        <div class="article-info">
            <h1>{{$article -> name}}</h1>

            <p>{{$article -> description}}</p>

            <div class="colores">
                @foreach ($article -> colors as $color)
                <section style="background-color: {{$color -> color}};"></section>
                @endforeach
            </div>

            <p>{{$article -> brand}}</p>

            @if (!Auth::check() || (Auth::check() && Auth::user()->company))
            <div class="add">
                <div style="white-space: nowrap;" class="quantity quantity-control z-50" data-article="{{ $article->id }}">
                    <button type="button" class="quantity-button" onclick="adjustQuantity({{ $article->id }}, -1)">−</button>
                    <x-input type="number" min="1" value="1" id="quantity-{{ $article->id }}" class="quantity-input" style="width: 4rem;"/>
                    <button type="button" class="quantity-button" onclick="adjustQuantity({{ $article->id }}, 1)">+</button>
                </div>

                <x-button style="width: auto;" onclick="add({{$article -> id}})">{{$article -> price}}€</x-button>
            </div>
            @else
            <p>{{$article -> price}}€</p>
            @endif
        </div>
    </div>

    <div class="images">
        @foreach ($article -> images -> skip(1) as $image)
        <img src="{{Storage::url($image -> path)}}">
        @endforeach
    </div>

    <div class="button-new">
        <a href="{{route('articles')}}"><x-button >Seguir comprando</x-button></a>
    </div>
</x-app-layout>