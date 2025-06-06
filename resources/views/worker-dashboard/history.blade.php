<x-app-layout>
    <div class="title">
        <h1>Historial: {{$machine -> name}}</h1>

        <div class="button-new">

            <a href="{{route('worker-machines')}}"><x-button><i class="fa-solid fa-arrow-left"></i></x-button></a>
            <a href="{{route('worker-dashboard')}}"><x-button><i class="fa-solid fa-house"></i></x-button></a>
        </div>
    </div>

    @if (!count($history))
    <x-self.message><i class="fa-solid fa-face-smile-wink" style="margin-right: 0.5rem;"></i>No hay nada por aqui...</x-self.message>
    @else

    <div class="content">
        <div class="cards" style="display: flex; flex-direction: column;">
            @foreach ($history as $intervention)
            <div class="medium-card">
                <div class="card-content">
                    <h1>Intervención #{{$intervention->id}}</h1>

                    <div class="inter-content">
                        <span><strong>Duración:</strong> {{ $intervention->duration ?? 'N/D' }} min</span>
                        <span><strong>Fecha:</strong> {{ $intervention->created_at->format('d/m/Y') }}</span>
                        <span><strong>Trabajador:</strong> {{ $intervention->worker->user->name ?? 'N/A' }}</span>
                    </div>

                    @if ($intervention->notification)
                    <div class="notifi">
                        <strong>Problema reportado:</strong><br>
                        {{ $intervention->notification->description }}
                    </div>
                    @endif

                    <p>
                        <strong>Observaciones:</strong><br>
                        {{ $intervention->observations }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</x-app-layout>