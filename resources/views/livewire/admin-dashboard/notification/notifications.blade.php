<div>
    <div class="title">
        <h1><i class="fa-solid fa-star"></i>AVISOS<i class="fa-solid fa-star"></i></h1>

        <div class="head">
            <div class="head2" style="padding-left: 0 !important;">
                <div>
                    <form role="search">
                        <x-input type="search" placeholder="Buscar" aria-label="Buscar" wire:model.live="buscar"></x-input>
                    </form>
                </div>

                <select name="state" wire:model.live="state" class="rounded px-2 py-1 border">
                    <option value="">Todos los estados</option>
                    @foreach ($states as $state)
                    <option value="{{$state}}">{{$state}}</option>
                    @endforeach
                </select>

                <select name="company" wire:model.live="company" class="rounded px-2 py-1 border">
                    <option value="">Todas las empresas</option>
                    @foreach ($companies as $company)
                    <option value="{{$company-> user -> name}}">{{$company ->user -> name}}</option>
                    @endforeach
                    <option value="libre">Libre</option>
                </select>

                <x-button wire:click="filtersNo()">quitar filtros</x-button>
            </div>

            <div class="button-new">
                @livewire('admin-dashboard.notification.create-notification')
            </div>
        </div>
    </div>

    @if (!count($notifications))
        <x-self.message><i class="fa-solid fa-face-smile-wink" style="margin-right: 0.5rem;"></i>descansaa... no hay problemas</x-self.message>
    @else
    <div class="table-container">
        <table class="list">
            <thead>
                <tr>
                    <th max-width="300px">id</th>
                    <th width="300px">fecha</th>
                    <th width="300px">estado</th>
                    <th class="machine">maquina</th>
                    <th class="machine">empresa</th>
                    <th max-width="300px">trabajador</th>
                    <th class="botones"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($notifications as $item)
                <tr>
                    <td>{{$item -> id}}</td>
                    <td>{{$item -> created_at -> format('j/n/y')}}</td>
                    <td>
                        <div @class([ 'state' , 'bg-green-500'=> $item -> state == 'completada',
                            'bg-blue-500' => $item -> state == 'aceptada',
                            'bg-red-600' => $item -> state == 'cancelada',
                            'bg-orange-400' => $item -> state == 'procesando',
                            'bg-pink-400' => $item -> state == 'en espera',
                            ])></div>
                        @if ($item -> state == 'cancelada' || $item -> state == 'completada')
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
                    <td class="machine">{{$item -> machine -> name}}</td>
                    <td class="machine">
                        @if ($item -> company_id)
                        {{$item -> company -> user -> name}}
                        @endif
                    </td>
                    <td>
                        @if ($item -> state != 'cancelada')
                            @if ($item -> worker_id)
                            {{$item -> worker -> user -> name}}
                            @else
                            <select wire:change="assign({{ $item->id }}, $event.target.value)" class="border rounded px-2 py-1">
                            <option value="" > asignar </option>    
                            @foreach($workers as $worker)
                                <option value="{{$worker -> id}}" @selected($item->worker_id === $worker -> id)>
                                    {{$worker -> user -> name}}
                                </option>
                                @endforeach
                            </select>
                            @endif
                        @endif
                    </td>
                    <td class="botones">
                        @if ($item -> state == 'procesando')
                        <div class="flex justify-content-center">
                            <button wire:click="confirmCancel({{$item -> id}})" class="font-medium text-red-700/90 hover:underline">
                                cancelar
                            </button>
                        </div>
                        @elseif ($item -> state == 'cancelada')
                        <div class="flex justify-content-center">
                            <button wire:click="confirmDelete({{$item -> id}})" class="font-medium text-red-700/90 hover:underline">
                                eliminar
                            </button>
                        </div>
                        @endif
                        <x-button wire:click="visualize({{$item -> id}})">ver aviso</x-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>