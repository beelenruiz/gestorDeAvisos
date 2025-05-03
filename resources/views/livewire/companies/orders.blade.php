@push('styles')
<link rel="stylesheet" href="{{ asset('css/lists.css') }}">
@endpush

<div>
    <div class="title">
        <h1><i class="fa-solid fa-star"></i>PEDIDOS<i class="fa-solid fa-star"></i></h1>
    </div>

    @if (!count($orders))
        <x-self.message><i class="fa-solid fa-heart-crack" style="margin-right: 0.5rem;"></i>¡Ups! Aún no has realizado ningún pedido. ¿Qué esperas para empezar?</x-self.message>
    @else
    <div class="table-container">
        <table cellspacing="20">
            <thead>
                <tr>
                    <th max-width="300px">id</th>
                    <th width="300px">fecha</th>
                    <th width="300px">estado</th>
                    <th width="300px">precio</th>
                    <th class="botones"></th>
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
                            ])></div>{{$item -> state}}
                    </td>
                    <td>{{$item -> price}}€</td>
                    <td class="botones">
                        @if ($item -> state == 'pendiente')
                        <div>
                            <button wire:click="edit({{$item -> id}})" class="font-medium text-blue-700/90 hover:underline">
                                editar
                            </button><br>
                            <button wire:click="confirmCancel({{$item -> id}})" class="font-medium text-red-700/90 hover:underline">
                                cancelar
                            </button>
                        </div>
                        @endif
                        <x-button wire:click="visualize({{$item -> id}})">ver pedido</x-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>