<div>
    <x-button wire:click="$set('openCreate', true)"><i class="fas fa-add mr-2"></i>nueva maquina</x-button>

    <x-dialog-modal wire:model="openCreate">
        <x-slot name="title">
            NUEVA MAQUINA
        </x-slot>

        <x-slot name="content">
            {{-- Nombre --}}
            <div>
                <x-label for="name">Nombre</x-label>
                <input type="text" wire:model="cform.name" name="name" id="name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mb-3"></input>
                <x-input-error for="cform.name" />
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
                            wire:model="cform.color"
                            class="form-radio h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-700">A Color</span>
                    </label>

                    {{-- Opción: Blanco y Negro --}}
                    <label class="inline-flex items-center cursor-pointer" for="impresion_bn">
                        <input id="impresion_bn"
                            type="radio"
                            name="color_option"
                            value="0" 
                            wire:model="cform.color"
                            class="form-radio h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-700">Blanco y Negro</span>
                    </label>
                </div>
                <x-input-error for="cform.color" class="mt-2" />
            </div>

            {{-- n serial --}}
            <div>
                <x-label for="n_serial">Número de serie</x-label>
                <input type="text" wire:model="cform.n_serial" name="n_serial" id="n_serial" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mb-3"></input>
                <x-input-error for="cform.n_serial" />
            </div>

            {{-- tipo --}}
            <div>
                <x-label for="type" class="block text-sm font-medium text-gray-700">Tipo</x-label>
                <div class="mt-1 relative">
                    <select id="type" name="type" wire:model="cform.type"
                        class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Selecciona un tipo</option>
                        @foreach ($types as $tipo)
                        <option value="{{$tipo}}">{{$tipo}}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error for="cform.type" />
            </div>

            {{-- image --}}
            <div>
                <x-label for="image">Imagen</x-label>
                <input id="image_c" type="file" accept="image/*" wire:model="cform.image" class="hidden" />

                <div>
                    <div class="rounded-lg overflow-hidden border border-gray-300">
                        @if ($cform->image)
                        <img src="{{ $cform->image->temporaryUrl() }}" alt="Imagen cargado" class="object-cover w-full h-full" />
                        @else
                        <img src="{{Storage::url('images/machines/default.png')}}" class="w-400 h-500" />
                        @endif
                        <x-input-error for="cform.image" />
                    </div>

                    <div>
                        <label for="image_c"
                            class="gap-2 px-4 py-2 text-white font-medium rounded-xl bg-gray-700 hover:bg-black cursor-pointer">
                            <i class="fas fa-upload"></i> Subir imagen
                        </label>
                    </div>
                </div>
            </div>

            {{-- company_id --}}
            <div>
                <x-label for="company_id" class="block text-sm font-medium text-gray-700 mt-2">Empresa (si tiene)</x-label>
                <div class="mt-1 relative">
                    <select id="type" name="company_id" wire:model="cform.company_id"
                        class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Selecciona o no una empresa</option>
                        @foreach ($companies as $item)
                        <option value="{{$item -> id}}">{{$item -> user -> name}}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error for="cform.company_id" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end space-x-4">
                <button wire:click="store"
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
</div>