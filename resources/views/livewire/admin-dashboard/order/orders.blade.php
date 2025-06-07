<div>
    <div class="title">
        <h1><i class="fa-solid fa-star"></i>PEDIDOS<i class="fa-solid fa-star"></i></h1>

        <div class="head2">
            <div>
                <form role="search">
                    <x-input type="search" placeholder="Buscar" aria-label="Buscar" wire:model.live="buscar"></x-input>
                </form>
            </div>

            <select name="state" wire:model.live="state" class="rounded px-2 py-1 border">
                <option value="">Todos los estados</option>
                @foreach ($states as $state)
                <option value="{{$state}}">{{$state}}s</option>
                @endforeach
            </select>

            <select name="company" wire:model.live="company" class="rounded px-2 py-1 border">
                <option value="">Todas las empresas</option>
                @foreach ($companies as $company)
                <option value="{{$company -> user ->name}}">{{$company-> user-> name}}</option>
                @endforeach
            </select>

            <x-button wire:click="filtersNo()">quitar filtros</x-button>
        </div>
    </div>


    @if (!count($orders))
    <x-self.message><i class="fa-solid fa-heart-crack" style="margin-right: 0.5rem;"></i>¡Ups! No hay ningun pedido</x-self.message>
    @else
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th max-width="300px">id</th>
                    <th></th>
                    <th>state</th>
                    <th max-width="300px">price</th>
                    <th>empresa</th>
                    <th class="botones"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orders as $item)
                <tr>
                    <td>{{$item -> id}}</td>
                    <td><x-button wire:click="visualize({{$item -> id}})">ver pedido</x-button></td>
                    <td>
                        <div @class([ 'state' , 'bg-green-500'=> $item -> state == 'completado',
                            'bg-blue-500' => $item -> state == 'aceptado',
                            'bg-red-600' => $item -> state == 'cancelado',
                            'bg-orange-400' => $item -> state == 'pendiente',
                            ])></div>
                        @if ($item -> state == 'cancelado' || $item -> state == 'completado')
                        {{$item -> state}}
                        @else
                        <select wire:change="updateState({{ $item->id }}, $event.target.value)" class="border rounded px-2 py-1">
                            @foreach($states as $state)
                            <option value="{{ $state }}" @selected($item->state === $state)>
                                {{$state}}
                            </option>
                            @endforeach
                        </select>
                        @endif
                    </td>
                    <td>{{$item -> price}}€</td>
                    <td>{{$item -> company -> user -> name}}</td>
                    <td class="botones">
                        <div>
                            @if ($item -> state == 'pendiente')
                            <button wire:click="confirmCancel({{$item -> id}})" class="font-medium text-red-700/90 hover:underline">
                                cancelar
                            </button><br>
                            <button wire:click="edit({{$item -> id}})" class="font-medium text-blue-700/90 hover:underline">
                                editar
                            </button>
                            @elseif ($item -> state == 'cancelado')
                            <button wire:click="confirmDelete({{$item -> id}})" class="font-medium text-red-700/90 hover:underline">
                                eliminar
                            </button>
                            @endif

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>