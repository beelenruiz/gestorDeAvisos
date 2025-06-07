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
        <div class="cards">
            @foreach ($grouped[$state] as $item)
            <div class="card">
                <div class="card-content">
                    <h1>Aviso #{{ $item->id }}</h1>
                    <div>
                        <p><strong>Fecha:</strong> {{ $item->created_at->format('d M, Y') }}</p>
                        <p>
                            <strong>Estado:</strong>
                            <span style="
                            display: inline-block; 
                            width: 12px; 
                            height: 12px; 
                            border-radius: 50%; 
                            background-color: 
                                {{ $item->state == 'completada' ? '#22c55e' : 
                                ($item->state == 'aceptada' ? '#3b82f6' : 
                                ($item->state == 'cancelada' ? '#dc2626' : 
                                ($item->state == 'procesando' ? '#f97316' : '#ec4899'))) }};
                            margin-right: 5px;
                        "></span>
                            {{ $item->state }}
                        </p>
                        <p><strong>Máquina:</strong> {{ $item->machine->name }}</p>
                        <p><strong>Empresa:</strong> {{ $item->company_id ? $item->company->user->name : 'N/A' }}</p>
                    </div>
                    <div style="margin-top: 1rem;">
                        @if ($item->state == 'en espera')
                        <a href="{{ route('completeIntervention', ['id' => $item->id]) }}" style="margin-right: 1rem;">
                            <x-button>Completar</x-button>
                        </a>
                        @endif
                        <x-button wire:click="visualize({{ $item->id }})">Ver aviso</x-button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    @endif
    @endforeach
    @endif
</div>