<div>
    <div class="title">
        <h1><i class="fa-solid fa-star"></i>CATEGORÍAS<i class="fa-solid fa-star"></i></h1>

        <div class="head">
            <div>
                <form role="search">
                    <x-input type="search" placeholder="Buscar" aria-label="Buscar" wire:model.live="buscar"></x-input>
                </form>
            </div>

            <div class="button-new">
                @livewire('admin-dashboard.category.create-category')
            </div>
        </div>
    </div>


    @if (!count($categories))
    <x-self.message><i class="fa-solid fa-heart-crack" style="margin-right: 0.5rem;"></i>¡Ups! No hay ninguna categoría, que raro...</x-self.message>
    @else
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th max-width="300px">id</th>
                    <th max-width="300px">icon</th>
                    <th width="300px">name</th>
                    <th class="description">descripcion</th>
                    <th class="botones"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $item)
                <tr>
                    <td>{{$item -> id}}</td>
                    <td><img class="icon" src="{{Storage::url($item -> icon)}}" alt="icono de la categoria {{$item -> name}}"></td>
                    <td>{{$item -> name}}</td>
                    <td class="description">{{Str::limit($item -> description, 70)}}</td>
                    <td class="botones">
                        <div>
                            <button wire:click="edit({{$item -> id}})" class="font-medium text-blue-700/90 hover:underline">
                                editar
                            </button><br>
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
    @if ($uform -> category != null)
    <x-dialog-modal wire:model="openUpdate">
        <x-slot name="title">
            EDITAR CATEGORÍA
        </x-slot>

        <x-slot name="content">
            {{-- Nombre --}}
            <div>
                <x-label for="name">Nombre</x-label>
                <input type="text" wire:model="uform.name" name="name" id="name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mb-3"></input>
                <x-input-error for="uform.name" />
            </div>

            {{-- Descripción --}}
            <div>
                <x-label for="description">Descripción</x-label>
                <textarea wire:model="uform.description" name="description" id="description" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mb-3"></textarea>
                <x-input-error for="uform.description" />
            </div>

            {{-- icono --}}
            <div>
                <x-label for="icon">Icono</x-label>
                <input id="icon_u" type="file" accept="image/*" wire:model="uform.icon" class="hidden" />

                <div class="flex">
                    <div class="w-24 h-24 rounded-lg overflow-hidden border border-gray-300">
                        @isset ($uform->icon)
                        <img src="{{$uform->icon->temporaryUrl()}}" alt="Icono cargado" class="object-cover w-full h-full" />
                        @else
                        <div class="flex items-center justify-center w-full h-full bg-gray-200 text-gray-500">
                            <img src="{{Storage::url($uform->category->icon)}}" />
                        </div>
                        @endisset
                        <x-input-error for="uform.icon" />
                    </div>

                    <div>
                        <label for="icon_u"
                            class="gap-2 px-4 py-2 text-white font-medium rounded-xl bg-gray-700 hover:bg-black cursor-pointer">
                            <i class="fas fa-upload"></i> Subir icono
                        </label>
                    </div>
                </div>
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