@push('scripts')
<script>
    const USER_IS_LOGGED_IN = {{Auth::check() ? 'true' : 'false'}};
    const CSRF_TOKEN = "{{ csrf_token() }}";
    // URLs de las rutas
    const CART_UPDATE_URL_BASE = "{{ url('/cart/update') }}";
    const CART_DESTROY_URL_BASE = "{{ url('/cart/delete') }}";
    const CART_EMPTY_URL = "{{ route('cart.empty') }}";
</script>
<script src="{{ asset('js/cart.js') }}"></script>
@endpush

<x-app-layout>

    <div class="title">
        <h1><i class="fa-solid fa-star"></i>CARRITO DE LA COMPRA<i class="fa-solid fa-star"></i></h1>
        @if (Auth::check() && $cart && $cart->articles->isNotEmpty())
        <div class="button-new">
            <x-button type="button" id="btn-empty-cart" style="display: none;">Vaciar Carrito</x-button>
        </div>
        @endif
    </div>

    @if (Auth::check() && $cart && $cart->articles->isNotEmpty())
    <table>
        <thead>
            <tr>
                <th max-width="300px">articulo</th>
                <th width="300px">cantidad</th>
                <th width="300px">precio unitario</th>
                <th width="300px">precio total</th>
                <th class="botones"></th>
                <th class="botones"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart -> articles as $article)
            <tr>
                <td>{{ $article->name }}</td>
                <td class="quantity">
                    <div class="quantity-wrapper">
                        <button type="button" class="btn-update-quantity quantity-button" data-article-id="{{ $article->id }}" data-operation="-1">−</button>
                        <span class="quantity-display">{{ $article->pivot->quantity }}</span>
                        <button type="button" class="btn-update-quantity quantity-button" data-article-id="{{ $article->id }}" data-operation="1">+</button>
                    </div>
                </td>
                <td>${{ number_format($article->pivot->price, 2) }}</td>
                <td>${{ number_format($article->pivot->price * $article->pivot->quantity, 2) }}</td>
                <td>
                    <button type="button" class="btn-remove-from-cart font-medium text-red-700/90 hover:underline" data-article-id="{{$article->id}}">
                        eliminar
                    </button>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5"><strong>Total:</strong> ${{number_format($cart -> total_price, 2)}}</td>
            </tr>
        </tbody>
    </table>

    <div class="button-new">
        <a href="{{route('articles')}}"><x-button>Seguir comprando</x-button></a>
    </div>

    @else
    <x-self.message><i class="fa-solid fa-face-smile-wink" style="margin-right: 0.5rem;"></i>Aún no hay nada en tu cesta, ¿a qué esperas?</x-self.message>
    @endif
</x-app-layout>