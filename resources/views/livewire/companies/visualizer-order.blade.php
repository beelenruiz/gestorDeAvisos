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
            <a href="{{route('orders')}}"><x-button><i class="fa-solid fa-arrow-left"></i></x-button></a>
            @elseif (auth() -> user() -> admin)
            <a href="{{route('admin-dashboard', ['seccion' => 'orders'])}}"><x-button><i class="fa-solid fa-arrow-left"></i></x-button></a>
            @endif
        </div>
    </div>

    <div class="table-container">
        <table class="list">
            <thead>
                <tr>
                    <th>Artículo</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    @if($isEditing)
                    <th class="botones">Acciones</th>
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