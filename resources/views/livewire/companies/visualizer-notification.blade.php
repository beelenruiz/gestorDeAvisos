<div>
    <div class="title">
        <h2>Detalle del Aviso</h2>

        <div class="button-new">
            @if (auth() -> user() -> company)
            <a href="{{route('notifications')}}"><x-button><i class="fa-solid fa-arrow-left"></i></x-button></a>
            @elseif (auth() -> user() -> admin)
            <a href="{{route('admin-dashboard', ['seccion' => 'notifications'])}}"><x-button><i class="fa-solid fa-arrow-left"></i></x-button></a>
            @elseif (auth() -> user() -> worker)
            <a href="{{route('worker-dashboard')}}"><x-button><i class="fa-solid fa-arrow-left"></i></x-button></a>
            @endif
        </div>
    </div>

    <div class="medium-cards">
        {{-- Información de la Notificación --}}
        <div class="medium-card">
            <div class="card-content">
                <h1>Aviso</h1>
                <div class="space-y-2">
                    <p><span class="font-semibold text-gray-500">Estado:</span> {{ $notification->state }}</p>
                    <p><span class="font-semibold text-gray-500">Descripción:</span> {{ $notification->description }}</p>
                </div>
            </div>
        </div>


        {{-- Información de la Empresa --}}
        <div class="medium-card">
            <img src="{{$notification->company -> user -> profile_photo_url}}">
            <div class="card-content">
                <h1>Empresa</h1>
                <div class="space-y-2">
                    <p><span class="font-semibold text-gray-500">Nombre:</span> {{ $notification->company -> user -> name }}</p>
                    <p><span class="font-semibold text-gray-500">Teléfono:</span> {{ $notification->company->phone}}</p>
                    <p><span class="font-semibold text-gray-500">Correo:</span> {{ $notification->company -> user -> email}}</p>
                </div>
            </div>
        </div>


        {{-- Información de la Máquina --}}
        <div class="medium-card">
            <img src="{{asset($notification->machine->image) }}">

            <div class="card-content">
                <h1>Máquina</h1>
                <div class="space-y-2">
                    <p><span class="font-semibold text-gray-500">Nombre:</span> {{ $notification->machine->name }}</p>
                    <p>
                        <span class="font-semibold text-gray-500">Color:</span>
                        @if ($notification->machine -> color)
                        si
                        @else
                        no
                        @endif
                    </p>
                    <p><span class="font-semibold text-gray-500">N° Serie:</span> {{ $notification->machine->n_serial }}</p>
                    <p><span class="font-semibold text-gray-500">Tipo:</span> {{ $notification->machine->type }}</p>

                </div>
            </div>
        </div>


        @if (Auth::user() -> admin)
        {{-- Información del trabajador --}}
        <div class="medium-card">
            <img src="{{$notification->worker -> user -> profile_photo_url}}">

            <div class="card-content">
                <h1>Trabajador asignado</h1>
                @if ($notification -> worker_id)
                <div class="space-y-2">
                    <p><span class="font-semibold text-gray-500">Nombre:</span> {{ $notification->worker -> user->name }}</p>
                    <p><span class="font-semibold text-gray-500">Email:</span> {{ $notification->worker->user->email }}</p>
                </div>
                @else
                <select wire:change="assign({{ $notification->id }}, $event.target.value)" class="border rounded px-2 py-1">
                    <option value=""> asignar </option>
                    @foreach($workers as $worker)
                    <option value="{{$worker -> id}}">
                        {{$worker -> user -> name}}
                    </option>
                    @endforeach
                </select>
                @endif
            </div>
        </div>
        @endif


        @if (Auth::user() -> worker)
        {{-- Información de la intervencion --}}
        <div class="medium-card">
            <div class="card-content">
                <h1>Intervención</h1>
                <div class="space-y-2">
                    <p><span class="font-semibold text-gray-500">Trabajador:</span> {{ $notification->worker -> user->name }}</p>
                    @if (!empty($notification->intervention->observations))
                    <p>
                        <span class="font-semibold text-gray-500">Observaciones:</span>
                        {{ $notification->intervention->observations }}
                    </p>
                    <p>
                        <span class="font-semibold text-gray-500">Duración:</span>
                        {{ $notification->intervention->duration }} min
                    </p>
                    @endif
                </div>

                <div class="button-new">
                    <a href="{{route('worker-newIntervention', ['notification_id' => $notification->id])}}"><x-button>
                        {{$notification->state === 'en espera' ? 'Continuar' : 'Iniciar'}}
                    </x-button></a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>