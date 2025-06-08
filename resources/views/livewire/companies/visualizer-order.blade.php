<div>
    <div class="title">
        <h2>Detalles del Pedido #{{$order -> id}}</h2>

        <div class="button-new">
            @if ($order -> state == 'pendiente')
            @if($isEditing)
            <x-button wire:click="cancelarEdicion({{$order -> id}})">cancelar</x-button>
            @else
            <x-button wire:click="edit({{$order -> id}})">editar</x-button>
            @endif
            @endif

            @if (auth() -> user() -> company)
            <x-button href="{{route('orders')}}"><i class="fa-solid fa-arrow-left" aria-label="Ir al panel del usuario"></i></x-button>
            @elseif (auth() -> user() -> admin)
            <x-button href="{{route('admin-dashboard', ['seccion' => 'orders'])}}"><i class="fa-solid fa-arrow-left" aria-label="Ir a atras"></i></x-button>
            @endif
        </div>
    </div>

    <div class="table-container">
        <table class="list">
        <caption class="sr-only">Tabla con lista de los productos del pedido</caption>
            <thead>
                <tr>
                    <th scope="col">Artículo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Subtotal</th>
                    @if($isEditing)
                    <th scope="col" class="botones">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($order -> articles as $article)
                <tr>
                    <td>{{$article -> name}}</td>
                    <td>{{$article -> price}} €</td>
                    <td>{{$article -> cantidad}}</td>
                    <td>€</td>
                    @if($isEditing)
                    <td class="botones">
                        <div class="flex justify-content-center">
                            <button wire:click="deleteArticle({{$article->id}})" class="font-medium text-red-700/90 hover:underline">
                                eliminar
                            </button>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="total">
        <p>Total: {{$order -> price}} €</p>
    </div>
</div>