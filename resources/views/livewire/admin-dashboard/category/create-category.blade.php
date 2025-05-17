<div>
    <x-button wire:click="$set('openCreate', true)"><i class="fas fa-add mr-2"></i>nueva categoría</x-button>

    <x-dialog-modal wire:model="openCreate">
        <x-slot name="title">
            NUEVA CATEGORÍA
        </x-slot>

        <x-slot name="content">
            {{-- Nombre --}}
            <div>
                <x-label for="name">Nombre</x-label>
                <input type="text" wire:model="cform.name" name="name" id="name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mb-3"></input>
                <x-input-error for="cform.name" />
            </div>

            {{-- Descripción --}}
            <div>
                <x-label for="description">Descripción</x-label>
                <textarea wire:model="cform.description" name="description" id="description" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mb-3"></textarea>
                <x-input-error for="cform.description" />
            </div>

            {{-- icono --}}
            <div>
                <x-label for="icon">Icono</x-label>
                <input id="icon_c" type="file" accept="image/*" wire:model="cform.icon" class="hidden" />

                <div class="flex">
                    <div class="w-24 h-24 rounded-lg overflow-hidden border border-gray-300">
                        @if ($cform->icon)
                        <img src="{{ $cform->icon->temporaryUrl() }}" alt="Icono cargado" class="object-cover w-full h-full" />
                        @else
                        <div class="flex items-center justify-center w-full h-full bg-gray-200 text-gray-500">
                            <img src="{{Storage::url('images/iconsCategories/default.png')}}" />
                        </div>
                        @endif
                        <x-input-error for="cform.icon" />
                    </div>

                    <div>
                        <label for="icon_c"
                            class="gap-2 px-4 py-2 text-white font-medium rounded-xl bg-gray-700 hover:bg-black cursor-pointer">
                            <i class="fas fa-upload"></i> Subir icono
                        </label>
                    </div>
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