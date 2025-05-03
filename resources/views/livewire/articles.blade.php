@push('styles')
<link rel="stylesheet" href="{{ asset('css/cards.css') }}">
@endpush

<div class="content">
    <div class="filter">
        <div class="filter-secction">
            <p>BUSCADOR</p>
            <form role="search">
                <x-input type="search" placeholder="Buscar" aria-label="Buscar" wire:model.live="buscar"></x-input>
            </form>
        </div>

        <div class="filter-secction">
            <p>CATEGORÍA:</p>
            @foreach($categories as $category)
            <label class="filter-option">
                <input type="checkbox" wire:model.live="selectedCategories" value="{{$category -> id}}">
                <span>{{$category -> name}}</span><br>
            </label>
            @endforeach
        </div>

        <div class="filter-secction">
            <p>COLORES:</p>
            @foreach($colors as $color)
            <label class="filter-option">
                <input type="checkbox" wire:model.live="selectedColors" value="{{$color -> id}}">
                <span>{{$color -> name}}</span><br>
            </label>
            @endforeach
        </div>
    </div>

    <div class="cards">
        @foreach ($articles as $item)
        <a class="card">
            <img src="{{Storage::url($item -> images[0])}}" alt="{{$item -> name}}">
            <div class="card-content">
                <h1>{{$item -> name}}</h1>
                <div class="colores">
                    @foreach ($item -> colors as $color)
                    <section style="background-color: {{$color -> color}};"></section>
                    @endforeach
                </div>
                <p>{{$item -> brand}}</p>
            </div>
        </a>
        @endforeach
    </div>
</div>