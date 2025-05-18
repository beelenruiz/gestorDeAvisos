<div>
    <div class="title">
        <h1><i class="fa-solid fa-star"></i>MAQUINAS<i class="fa-solid fa-star"></i></h1>
        <div class="button-new">
            @livewire('admin-dashboard.machine.create-machine')
        </div>
    </div>

    <div class="content">
        <div class="mini-cards">
            @foreach ($machines as $item)
            <div class="mini-card">
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
                    @if ($item -> company_id == null)
                    <div class="state bg-green-500"></div>libre
                    @endif
                    <div class="botones">
                        <button wire:click="edit({{$item -> id}})" class="font-medium text-blue-700/90 hover:underline">
                            editar
                        </button><br>
                        <button wire:click="confirmDelete({{$item -> id}})" class="font-medium text-red-700/90 hover:underline">
                            eliminar
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="trashed">
        <h1>maquinas descatalogadas</h1>
        <x-button wire:click="seeTrashed()">
            mostrar/ocultar
        </x-button>
    </div>

    @if ($trashed == true)
    <div class="content">
        <div class="mini-cards">
            @foreach ($trashedMachines as $item)
            <div class="mini-card">
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

                    <div class="botones">
                        <button wire:click="restore({{$item -> id}})" class="font-medium text-blue-700/90 hover:underline">
                            restaurar
                        </button><br>
                        <button wire:click="totalDelete({{$item -> id}})" class="font-medium text-red-700/90 hover:underline">
                            eliminar
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif


    <!-- modal para update -------------------------------------------------------------------------- -->
    @if ($uform -> machine != null)
    <x-dialog-modal wire:model="openUpdate">
        <x-slot name="title">
            NUEVA MAQUINA
        </x-slot>

        <x-slot name="content">
            {{-- Nombre --}}
            <div>
                <x-label for="name">Nombre</x-label>
                <input type="text" wire:model="uform.name" name="name" id="name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mb-3"></input>
                <x-input-error for="uform.name" />
            </div>

            {{-- color --}}
            <div>
                <x-label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Impresión</x-label>
                <div class="mt-2 space-y-2 md:space-y-0 md:space-x-4 md:flex md:items-center">
                    {{-- Opción: A Color --}}
                    <label class="inline-flex items-center cursor-pointer" for="impresion_a_color">
                        <input id="impresion_a_color"
                            type="radio"
                            name="color_option"
                            value="1"
                            wire:model="uform.color"
                            class="form-radio h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-700">A Color</span>
                    </label>

                    {{-- Opción: Blanco y Negro --}}
                    <label class="inline-flex items-center cursor-pointer" for="impresion_bn">
                        <input id="impresion_bn"
                            type="radio"
                            name="color_option"
                            value="0"
                            wire:model="uform.color"
                            class="form-radio h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-700">Blanco y Negro</span>
                    </label>
                </div>
                <x-input-error for="uform.color" class="mt-2" />
            </div>

            {{-- n serial --}}
            <div>
                <x-label for="n_serial">Número de serie</x-label>
                <input type="text" wire:model="uform.n_serial" name="n_serial" id="n_serial" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mb-3"></input>
                <x-input-error for="uform.n_serial" />
            </div>

            {{-- tipo --}}
            <div>
                <x-label for="type" class="block text-sm font-medium text-gray-700">Tipo de Curso</x-label>
                <div class="mt-1 relative">
                    <select id="type" name="type" wire:model="uform.type"
                        class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Selecciona un tipo</option>
                        @foreach ($types as $tipo)
                        <option value="{{$tipo}}">{{$tipo}}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error for="uform.type" />
            </div>

            {{-- image --}}
            <div>
                <x-label for="image">Imagen</x-label>
                <input id="image_u" type="file" accept="image/*" wire:model="uform.image" class="hidden" />

                <div>
                    <div class="rounded-lg overflow-hidden border border-gray-300">
                        @if ($uform->image)
                        <img src="{{ $uform->image->temporaryUrl() }}" alt="Imagen cargado" class="object-cover w-full h-full" />
                        @else
                        <img src="{{Storage::url('images/machines/default.png')}}" class="w-400 h-500" />
                        @endif
                        <x-input-error for="uform.image" />
                    </div>

                    <div>
                        <label for="image_u"
                            class="gap-2 px-4 py-2 text-white font-medium rounded-xl bg-gray-700 hover:bg-black cursor-pointer">
                            <i class="fas fa-upload"></i> Subir imagen
                        </label>
                    </div>
                </div>
            </div>

            {{-- company_id --}}
            <div>
                <x-label for="company_id" class="block text-sm font-medium text-gray-700">Tipo de Curso</x-label>
                <div class="mt-1 relative">
                    <select id="type" name="company_id" wire:model="uform.company_id"
                        class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Selecciona o no una empresa</option>
                        @foreach ($companies as $item)
                        <option value="{{$item -> id}}">{{$item -> user -> name}}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error for="uform.company_id" />
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