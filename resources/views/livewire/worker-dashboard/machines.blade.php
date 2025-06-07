<div>
    <div class="title">
        <h1><i class="fa-solid fa-star"></i>MAQUINAS<i class="fa-solid fa-star"></i></h1>

        <div class="head">
            <div class="head2" style="padding-left: 0 !important;">
                <div>
                    <form role="search">
                        <x-input type="search" placeholder="Buscar" aria-label="Buscar" wire:model.live="buscar"></x-input>
                    </form>
                </div>

                <select name="type" wire:model.live="type" class="rounded px-2 py-1 border">
                    <option value="">Todos los tipos</option>
                    @foreach ($types as $type)
                    <option value="{{$type}}">{{$type}}</option>
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
                <a href="{{route('worker-dashboard')}}"><x-button ><i class="fa-solid fa-house"></i></x-button></a>
            </div>
        </div>
    </div>

    @if (!count($machines))
        <x-self.message><i class="fa-solid fa-magnifying-glass" style="margin-right: 0.5rem;"></i>¿qué buscas?</x-self.message>
    @else
    <div class="content">
        <div class="mini-cards">
            @foreach ($machines as $item)
            <div class="mini-card">
                <img src="{{asset($item -> image)}}" alt="{{$item -> name}}">
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
                    @if ($item -> company_id == null)
                        <div class="state bg-green-500 mt-2"></div>libre
                    @endif
                    <div class="botones">
                        <p> {{$item -> n_serial}}<br>{{$item -> user_name}} </p>                    
                        <a style="align-content: center; margin-top: 0.9375rem;" href="{{route('worker-history', ['id' => $item -> id])}}"><x-button> ver historial </x-button></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>