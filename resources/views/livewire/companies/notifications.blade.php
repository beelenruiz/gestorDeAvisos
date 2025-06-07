<div>
    <div class="title">
        <h1><i class="fa-solid fa-star"></i>AVISOS<i class="fa-solid fa-star"></i></h1>
        <div class="button-new">
            @livewire('companies.create-notifications')
            <a href="{{route('dashboard')}}"><x-button ><i class="fa-solid fa-house"></i></x-button></a>
        </div>
    </div>

    @if (!count($notifications))
        <x-self.message><i class="fa-solid fa-face-smile-wink" style="margin-right: 0.5rem;"></i>Parece que no has tenido ningun problema... ¿o si?</x-self.message>
    @else
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th max-width="300px">id</th>
                    <th width="300px">fecha</th>
                    <th class="description">descripción</th>
                    <th width="300px">estado</th>
                    <th class="machine">maquina</th>
                    <th class="botones"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($notifications as $item)
                <tr>
                    <td>{{$item -> id}}</td>
                    <td>{{$item -> created_at -> format('d M, Y')}}</td>
                    <td class="description">{{Str::limit($item -> description, 70)}}</td>
                    <td>
                        <div @class([ 'state' , 'bg-green-500'=> $item -> state == 'completada',
                            'bg-blue-500' => $item -> state == 'aceptada',
                            'bg-red-600' => $item -> state == 'cancelada',
                            'bg-orange-400' => $item -> state == 'procesando',
                            'bg-pink-400' => $item -> state == 'en espera',
                            ])></div>{{$item -> state}}
                    </td>
                    <td class="machine">{{$item -> machine -> name}}</td>
                    <td class="botones">
                        @if ($item -> state == 'procesando')
                        <div class="flex justify-content-center">
                            <button wire:click="confirmCancel({{$item -> id}})" class="font-medium text-red-700/90 hover:underline">
                                cancelar
                            </button>
                        </div>
                        @endif
                        <x-button wire:click="visualize({{$item -> id}})">ver aviso</x-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>