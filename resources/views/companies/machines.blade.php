@push('styles')
<link rel="stylesheet" href="{{ asset('css/cards.css') }}">
@endpush

<x-app-layout>
    <div class="title">
        <h1><i class="fa-solid fa-star"></i>MAQUINAS<i class="fa-solid fa-star"></i></h1>
        <div>
            <a href="{{route('notifications')}}"><x-button >mis avisos</x-button></a>
        </div>
    </div>

    <div class="cards">
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
                    @livewire('companies.create-notifications')
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>