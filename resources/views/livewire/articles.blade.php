@push('styles')
<link rel="stylesheet" href="{{ asset('css/cards.css') }}">
@endpush

<div class="content">
    @foreach ($articles as $item)
    <a class="card">
        <img src="{{Storage::url($item -> images[0])}}" alt="{{$item -> name}}">
        <div class="card-content">
            <h1>{{$item -> name}}</h1>
            <div class="colores">
                @foreach ($item -> colors as $name => $color)
                <section style="background-color: {{$color}};"></section>
                @endforeach
            </div>
            <p>{{$item -> brand}}</p>
        </div>
    </a>
    @endforeach
</div>