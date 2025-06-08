<div>
    <div class="title">
        <h1><i class="fa-solid fa-star"></i>AVISOS<i class="fa-solid fa-star"></i></h1>
        <div class="button-new">
            @livewire('companies.create-notifications')
            <x-button href="{{route('dashboard')}}" aria-label="Pulsa para ir al panel de usuario"><i class="fa-solid fa-house" aria-hidden="true"></i></x-button>
        </div>
    </div>

    @if (!count($notifications))
        <x-self.message><i class="fa-solid fa-face-smile-wink" aria-hidden="true" style="margin-right: 0.5rem;"></i>Parece que no has tenido ningun problema... ¿o si?</x-self.message>
    @else
    <div class="table-container">
        <table aria-label="Listado de avisos">
        <caption class="sr-only">Tabla con los avisos creados por el usuario</caption>
            <thead>
                <tr>
                    <th scope="col" max-width="300px">id</th>
                    <th scope="col" width="300px">fecha</th>
                    <th scope="col" class="description">descripción</th>
                    <th scope="col" width="300px">estado</th>
                    <th scope="col" class="machine">maquina</th>
                    <th scope="col" class="botones"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($notifications as $item)
                <tr>
                    <td>{{$item -> id}}</td>
                    <td>{{$item -> created_at -> format('d M, Y')}}</td>
                    <td class="description">{{Str::limit($item -> description, 70)}}</td>
                    <td>
                        <div @class([ 'state' , 'bg-green-500'=> $item -> state == 'completada',
                            'bg-blue-500' => $item -> state == 'aceptada',
                            'bg-red-600' => $item -> state == 'cancelada',
                            'bg-orange-400' => $item -> state == 'procesando',
                            'bg-pink-400' => $item -> state == 'en espera',
                            ])></div>{{$item -> state}}
                    </td>
                    <td class="machine">{{$item -> machine -> name}}</td>
                    <td class="botones">
                        @if ($item -> state == 'procesando')
                        <div class="flex justify-content-center">
                            <button wire:click="confirmCancel({{$item -> id}})" aria-label="Cancelar aviso aún no aceptado" class="font-medium text-red-700/90 hover:underline">
                                cancelar
                            </button>
                        </div>
                        @endif
                        <x-button wire:click="visualize({{$item -> id}})" aria-label="Ver detalles del aviso">ver aviso</x-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>