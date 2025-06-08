<div>
    <div class="title">
        <h1><i class="fa-solid fa-star" aria-hidden="true"></i>PEDIDOS<i class="fa-solid fa-star" aria-hidden="true"></i></h1>

        <div class="button-new">
            <x-button href="{{route('dashboard')}}"><i class="fa-solid fa-house" aria-label="Ir al panel del usuario"></i></x-button>
        </div>
    </div>

    @if (!count($orders))
        <x-self.message><i class="fa-solid fa-heart-crack" aria-hidden="true" style="margin-right: 0.5rem;"></i>¡Ups! Aún no has realizado ningún pedido. ¿Qué esperas para empezar?</x-self.message>
    @else
    <div class="table-container">
        <table aria-label="Listado de pedidos" cellspacing="20">
        <caption class="sr-only">Tabla con los pedidos realizados por el usuario</caption>
            <thead>
                <tr>
                    <th scope="col" style="max-width: 300px;">id</th>
                    <th scope="col">fecha</th>
                    <th scope="col">estado</th>
                    <th scope="col">precio</th>
                    <th scope="col" class="botones"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orders as $item)
                <tr>
                    <td>{{$item -> id}}</td>
                    <td>{{$item -> created_at -> format('d M, Y H:i')}}</td>
                    <td>
                        <div @class([ 'state' , 'bg-green-500'=> $item -> state == 'completado',
                            'bg-blue-500' => $item -> state == 'aceptado',
                            'bg-red-600' => $item -> state == 'cancelado',
                            'bg-orange-400' => $item -> state == 'pendiente',
                            ])></div><span class="sr-only">Estado: </span>{{$item -> state}}
                    </td>
                    <td>{{$item -> price}}€</td>
                    <td class="botones">
                        @if ($item -> state == 'pendiente')
                        <div>
                            <button wire:click="edit({{$item -> id}})" aria-label="Editar pedido {{ $item->id }}" class="font-medium text-blue-700/90 hover:underline">
                                editar
                            </button><br>
                            <button wire:click="confirmCancel({{$item -> id}})" aria-label="Cancelar pedido pedido {{ $item->id }}" class="font-medium text-red-700/90 hover:underline">
                                cancelar
                            </button>
                        </div>
                        @endif
                        <x-button wire:click="visualize({{$item -> id}})" aria-label="Ver detalles del pedido {{ $item->id }}">ver pedido</x-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>