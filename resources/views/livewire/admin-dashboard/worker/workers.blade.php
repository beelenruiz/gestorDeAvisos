<div>
    <div class="title">
        <h1><i class="fa-solid fa-star"></i>TRABAJADORES<i class="fa-solid fa-star"></i></h1>

        <div class="head">
            <div>
                <form role="search">
                    <x-input type="search" placeholder="Buscar" aria-label="Buscar" wire:model.live="buscar"></x-input>
                </form>
            </div>

            <div class="button-new">
                @livewire('admin-dashboard.worker.create-worker')
            </div>
        </div>
    </div>

    @if (!count($workers))
        <x-self.message><i class="fa-solid fa-face-smile-wink" style="margin-right: 0.5rem;"></i>Aqui no hay nadie... ¿contrato nuevo?</x-self.message>
    @else
    <div class="table-container">
        <table class="list">
            <thead>
                <tr>
                    <th max-width="300px">id</th>
                    <th>nombre</th>
                    <th>email</th>
                    <th class="botones"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($workers as $item)
                <tr>
                    <td>{{$item -> id}}</td>
                    <td>{{$item -> user -> name}}</td>
                    <td>{{$item -> user -> email}}</td>
                    <td class="botones">
                        <div class="flex justify-content-center">
                            <button wire:click="edit({{$item -> id}})" class="font-medium text-blue-700/90 hover:underline mr-5">
                                editar
                            </button>
                            <button wire:click="confirmDelete({{$item -> id}})" class="font-medium text-red-700/90 hover:underline">
                                eliminar
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif


    <!-- modal para update -------------------------------------------------------------------------- -->
    @if ($uform -> worker != null)
    <x-dialog-modal wire:model="openUpdate">
        <x-slot name="title">
            NUEVA EMPRESA
        </x-slot>

        <x-slot name="content">
            {{-- Nombre --}}
            <div>
                <x-label for="name">Nombre</x-label>
                <x-input type="text" wire:model="uform.name" name="name" id="name"></x-input>
                <x-input-error for="uform.name" />
            </div>

            {{-- email --}}
            <div>
                <x-label for="email">Email</x-label>
                <x-input type="text" wire:model="uform.email" name="email" id="email"></x-input>
                <x-input-error for="uform.email" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end space-x-4">
                <button wire:click="update"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fa-solid fa-paper-plane mr-2"></i>Enviar
                </button>
                <button type="button" wire:click="cancelar"
                    class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fa-solid fa-ban mr-2"></i>Cancelar
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
    @endif
</div>
