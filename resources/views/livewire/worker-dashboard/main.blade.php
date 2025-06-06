<div class="worker-dashboard">
    <div class="summary">
        <div>
            <h1>{{$notifications->filter(fn($n) => in_array($n->state, ['aceptada', 'en espera']))->count()}}</h1>
            <h2>avisos asignados</h1>
        </div>

        <div>
            <h1>{{$notifications->where('state', 'en espera')->count()}}</h1>
            <h2>intervenciones en espera</h2>
        </div>

        <div>
            <h1>8</h1>
            <h2>horas/dia</h2>
        </div>

        <div>
            <h1>{{$notifications->where('state', 'completada')->count()}}</h1>
            <h2>avisos completados</h2>
        </div>
    </div>

    <div class="title">
        <div class="head">
            <div>
                <form role="search">
                    <x-input type="search" placeholder="Buscar" aria-label="Buscar" wire:model.live="buscar"></x-input>
                </form>
            </div>

            <div class="button-new">
                <a href="{{route('worker-machines')}}"><x-button>ver maquinas</x-button></a>
                <a href="{{route('worker-newIntervention')}}"><x-button>nueva intervención</x-button></a>
            </div>
        </div>
    </div>

    @php
    $grouped = $notifications->groupBy('state');
    $displayStates = ['procesando' => 'Avisos activos', 'en espera' => 'Avisos en espera', 'aceptada' => 'Avisos asignados'];
    @endphp

    @if (!count($notifications))
    <x-self.message><i class="fa-solid fa-face-smile-wink" style="margin-right: 0.5rem;"></i>descansaa... no hay problemas</x-self.message>
    @else

    @foreach ($displayStates as $state => $label)
    @if ($grouped->has($state))
    <div class="trashed" style="margin-top: 2rem;">
        <h1>{{ $label }}</h1>
        <x-button wire:click="toggleTable('{{$state}}')">
            mostrar/ocultar
        </x-button>
    </div>
    <div class="table-container">
        @if ($tablesVisible[$state])
        <table class="list" style="margin-top: 0.5rem;">
            <thead style="background-color: #531919; color: #fff;">
                <tr>
                    <th max-width="300px">id</th>
                    <th width="300px">fecha</th>
                    <th width="300px">estado</th>
                    <th class="machine">maquina</th>
                    <th class="machine">empresa</th>
                    <th class="botones"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($grouped[$state] as $item)
                <tr>
                    <td>{{$item -> id}}</td>
                    <td>{{$item -> created_at -> format('d M, Y')}}</td>
                    <td>
                        <div @class([ 'state' , 'bg-green-500'=> $item -> state == 'completada',
                            'bg-blue-500' => $item -> state == 'aceptada',
                            'bg-red-600' => $item -> state == 'cancelada',
                            'bg-orange-400' => $item -> state == 'procesando',
                            'bg-pink-400' => $item -> state == 'en espera',
                            ])></div>
                        {{$item -> state}}
                    </td>
                    <td class="machine">{{$item -> machine -> name}}</td>
                    <td class="machine">
                        @if ($item -> company_id)
                        {{$item -> company -> user -> name}}
                        @endif
                    </td>
                    <td class="botones">
                        @if ($item -> state == 'en espera')
                        <div>
                            <a href="{{route('completeIntervention', ['id' => $item->id])}}"><button class="font-medium text-blue-700/90 hover:underline">
                                completar
                            </button></a>
                        </div>
                        @endif
                        <x-button wire:click="visualize({{$item -> id}})">ver aviso</x-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    @endif
    @endforeach
    @endif
</div>