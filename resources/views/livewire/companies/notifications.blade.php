@push('styles')
   <link rel="stylesheet" href="{{ asset('css/lists.css') }}">
@endpush

<div>
    <table>
        <thead>
            <tr>
                <th>aviso</th>
                <th>fecha</th>
                <th>estado</th>
                <th>descripcion</th>
                <th>maquina</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($notifications as $item)
            <tr>
                <td>{{$item -> created_at -> format('d M, Y H:i')}}</td>
                <td>{{$item -> state}}</td>
                <td>{{$item -> price}}</td>
                <td>$999.00</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>