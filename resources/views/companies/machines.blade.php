<x-app-layout>
    <div class="title">
        <h1><i class="fa-solid fa-star" aria-hidden="true"></i>MAQUINAS<i class="fa-solid fa-star" aria-hidden="true"></i></h1>
        <div class="button-new">
            <x-button href="route('notifications')">mis avisos</x-button>
            <x-button href="route('dashboard')"><i class="fa-solid fa-house" aria-label="Ir al panel del usuario"></i></x-button>
        </div>
    </div>

    @if (!count($machines))
        <x-self.message><i class="fa-solid fa-heart-crack" style="margin-right: 0.5rem;"></i>No tienes máquinas registradas. ¿Seguro que no quieres agregar alguna?</x-self.message>
    @else
    <div class="cards" role="list">
        @foreach ($machines as $item)
        <div class="card">
            <img src="{{Storage::url($item -> image)}}" alt="{{$item -> name}}">
            <div class="card-content">
                <h1>{{$item -> name}}</h1>
                <div class="info-machine">
                    <section> {{$item -> type}} </section>
                    @if ($item -> color)
                        <section> color </section>
                    @else
                        <section> blanco/negro </section>
                    @endif
                </div>
                <p> {{$item -> n_serial}} </p>
                <div class="button-create-notification">
                    @livewire('companies.create-notifications', ['machineId' => $item->id])
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</x-app-layout>