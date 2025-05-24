<div>
    <x-button wire:click="$set('openCreate', true)"><i class="fas fa-add mr-2"></i>nuevo articulo</x-button>

    <x-dialog-modal wire:model="openCreate">
        <x-slot name="title">
            NUEVO ARTICULO
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

            {{-- marca --}}
            <div>
                <x-label for="brand">Marca</x-label>
                <x-input type="text" wire:model="cform.brand" name="brand" id="brand"></x-input>
                <x-input-error for="cform.brand" />
            </div>

            {{-- precio --}}
            <div class="relative">
                <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                <div class="mt-1 relative">
                    <input type="number" id="price" name="price" placeholder="Escribe el precio" wire:model="cform.price"
                        class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <i class="fa-solid fa-dollar-sign absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <x-input-error for="cform.price" />
            </div>

            {{-- stock --}}
            <div class="relative">
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                <div class="mt-1 relative">
                    <input type="number" id="stock" name="stock" placeholder="Escribe el precio" wire:model="cform.stock"
                        class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <i class="fa-solid fa-dollar-sign absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <x-input-error for="cform.stock" />
            </div>

            {{-- category_id --}}
            <div>
                <x-label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</x-label>
                <div class="mt-1 relative">
                    <select id="type" name="category_id" wire:model="cform.category_id"
                        class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Selecciona la categoria</option>
                        @foreach ($categories as $item)
                        <option value="{{$item -> id}}">{{$item -> name}}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error for="cform.category_id" />
            </div>

            {{-- colores --}}
            <div>
                <x-label for="colors" class="block text-sm font-medium text-gray-700">colores disposibles</x-label>
                <div class="flex flex-wrap gap-4 mt-2">
                    @foreach ($colors as $color)
                    <label class="cursor-pointer flex flex-col items-center space-y-1">
                        <input
                            type="checkbox"
                            value="{{ $color->id }}"
                            wire:model="cform.colors"
                            class="sr-only">

                        <section
                            style="background-color: {{ $color->color }};"
                            @class([ 'w-10 h-10 rounded-full border-2 border-gray-300 transition duration-200' , 'ring-2 ring-black'=> in_array($color->id, $cform->colors ?? []),
                            ])
                            ></section>

                        <span class="text-sm">{{ $color->name }}</span>
                    </label>
                    @endforeach
                </div>
                <x-input-error for="cform.colors" />
            </div>

            {{-- images --}}
            <div>
                <x-label for="images">Imágenes</x-label>
                <input id="images_input" type="file" accept="image/*" multiple wire:model="cform.images" class="hidden" />

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                    @if (!empty($cform->images))
                    @foreach ($cform->images as $image)
                    <div class="rounded-lg overflow-hidden border border-gray-300">
                        <img src="{{ $image->temporaryUrl() }}" alt="Imagen cargada" class="object-cover w-full h-48" />
                    </div>
                    @endforeach
                    @else
                    <div class="rounded-lg overflow-hidden border border-gray-300">
                        <img src="{{ Storage::url('images/articles/default.png') }}" class="object-cover w-full h-48" />
                    </div>
                    @endif
                </div>

                <x-input-error for="cform.images.*" />

                <div class="mt-2">
                    <label for="images_input"
                        class="gap-2 px-4 py-2 text-white font-medium rounded-xl bg-gray-700 hover:bg-black cursor-pointer">
                        <i class="fas fa-upload"></i> Subir imágenes
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