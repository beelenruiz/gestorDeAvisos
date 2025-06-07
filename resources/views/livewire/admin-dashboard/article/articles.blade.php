<div>
    <div class="title">
        <h1><i class="fa-solid fa-star"></i>PRODUCTOS<i class="fa-solid fa-star"></i></h1>
        <div class="head">
            <div class="head2" style="padding-left: 0 !important;">
                <div>
                    <form role="search">
                        <x-input type="search" placeholder="Buscar" aria-label="Buscar" wire:model.live="buscar"></x-input>
                    </form>
                </div>

                <select name="color" wire:model.live="color" class="rounded px-2 py-1 border">
                    <option value="">Todos los colores</option>
                    @foreach ($colors as $color)
                    <option value="{{$color-> name}}">{{$color -> name}}</option>
                    @endforeach
                </select>

                <select name="category" wire:model.live="category" class="rounded px-2 py-1 border">
                    <option value="">Todas las categorías</option>
                    @foreach ($categories as $category)
                    <option value="{{$category-> name}}">{{$category -> name}}</option>
                    @endforeach
                </select>

                <x-button wire:click="filtersNo()">quitar filtros</x-button>
            </div>

            <div class="button-new">
                @livewire('admin-dashboard.article.create-article')
            </div>
        </div>
    </div>

    @if (!count($articles))
    <x-self.message><i class="fa-solid fa-magnifying-glass" style="margin-right: 0.5rem;"></i>¿qué buscas? ...prueba otra vez</x-self.message>
    @else
    <div class="content">
        <div class="mini-cards">
            @foreach ($articles as $item)
            <div class="mini-card">
                <img src="{{Storage::url($item -> images -> first() -> path)}}" alt="{{$item -> name}}">
                <div class="card-content">
                    <h1>{{$item -> name}}<span>{{$item -> price}}€</span></h1>
                    <div class="colores">
                        @foreach ($item -> colors as $color)
                        <section style="background-color: {{$color -> color}};"></section>
                        @endforeach
                    </div>
                    <div class="flex gap-5 justify-center">
                        <p>{{$item -> brand}}</p>
                        <p>
                            stock: {{$item -> stock}}
                            <button wire:click="openModalStock({{$item -> id}})" class="font-medium text-blue-700/90 hover:underline">
                                cambiar
                            </button>
                        </p>
                    </div>

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
        <h1>articulos descatalogados</h1>
        <x-button wire:click="seeTrashed()">
            mostrar/ocultar
        </x-button>
    </div>

    @if ($trashed == true)
    <div class="content">
        <div class="mini-cards">
            @foreach ($trashedArticles as $item)
            <div class="mini-card" style="background-color: #d6d9d9;">
                <img src="{{Storage::url($item -> images[0])}}" alt="{{$item -> name}}">
                <div class="card-content">
                    <h1>{{$item -> name}}<span>{{$item -> price}}€</span></h1>
                    <div class="colores">
                        @foreach ($item -> colors as $color)
                        <section style="background-color: {{$color -> color}};"></section>
                        @endforeach
                    </div>
                    <p>{{$item -> brand}}</p>

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
    @endif


    <!-- modal para update -------------------------------------------------------------------------- -->
    @if ($uform -> article != null)
    <x-dialog-modal wire:model="openUpdate">
        <x-slot name="title">
            ACTUALIZAR ARTICULO
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

            {{-- marca --}}
            <div>
                <x-label for="brand">Marca</x-label>
                <x-input type="text" wire:model="uform.brand" name="brand" id="brand"></x-input>
                <x-input-error for="uform.brand" />
            </div>

            {{-- precio --}}
            <div class="relative">
                <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                <div class="mt-1 relative">
                    <input type="number" id="price" name="price" placeholder="Escribe el precio" wire:model="uform.price"
                        class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <i class="fa-solid fa-dollar-sign absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <x-input-error for="uform.price" />
            </div>

            {{-- stock --}}
            <div class="relative">
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                <div class="mt-1 relative">
                    <input type="number" id="stock" name="stock" placeholder="Escribe el precio" wire:model="uform.stock"
                        class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <i class="fa-solid fa-dollar-sign absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <x-input-error for="uform.stock" />
            </div>

            {{-- category_id --}}
            <div>
                <x-label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</x-label>
                <div class="mt-1 relative">
                    <select id="type" name="category_id" wire:model="uform.category_id"
                        class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Selecciona la categoria</option>
                        @foreach ($categories as $item)
                        <option value="{{$item -> id}}">{{$item -> name}}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error for="uform.category_id" />
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
                            wire:model.live="uform.colors"
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
                <x-input-error for="uform.colors" />
            </div>

            {{-- images --}}
            <div class="mt-6">
                <x-label>Imágenes del Artículo</x-label>

                {{-- Mostrar Imágenes Existentes con checkboxes para marcar para eliminar --}}
                @if (!empty($uform->images))
                <p class="text-sm text-gray-600 mb-2">Imágenes actuales:</p>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach ($uform->images as $imagePath)
                    @if ($imagePath)
                    <div class="rounded-lg overflow-hidden border border-gray-300 p-2">
                        <img src="{{ Storage::url($imagePath) }}" alt="Imagen" class="object-cover w-full h-32 md:h-40 mb-2">
                        @if(basename($imagePath) !== 'default.png')
                        <label class="inline-flex items-center text-xs">
                            <input type="checkbox"
                                value="{{ $imagePath }}"
                                wire:model.live="uform.imagesToDelete" {{-- .live para feedback inmediato si quieres (opcional) --}}
                                class="form-checkbox h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                            <span class="ml-2 text-gray-700">Marcar para eliminar</span>
                        </label>
                        @else
                        <p class="text-xs text-gray-500 text-center">(Imagen por defecto)</p>
                        @endif
                    </div>
                    @endif
                    @endforeach
                </div>
                <x-input-error for="uform.imagesToDelete" class="mt-1" />
                @else
                <div class="rounded-lg overflow-hidden border border-gray-300">
                    <img src="{{ Storage::url('images/articles/default.png') }}" alt="Imagen por defecto" class="object-cover w-full h-40 md:h-48" />
                    <p class="text-xs text-gray-500 text-center p-2">(Imagen por defecto)</p>
                </div>
                @endif

                {{-- Input para Subir Nuevas Imágenes --}}
                <div class="mt-4">
                    <x-label for="new_article_images_update">Añadir nuevas imágenes (opcional)</x-label>
                    <input id="new_article_images_update"
                        type="file"
                        wire:model="uform.newImages"
                        multiple
                        accept="image/*"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none mt-1">
                    <x-input-error for="uform.newImages" class="mt-1" />
                    <x-input-error for="uform.newImages.*" class="mt-1" />

                    <div wire:loading wire:target="uform.newImages" class="mt-2 text-sm text-gray-500">
                        Cargando imágenes...
                    </div>
                </div>

                {{-- Previsualización de Nuevas Imágenes --}}
                @if (!empty($uform->newImages))
                <div class="mt-4">
                    <p class="text-sm text-gray-600 mb-2">Previsualización de nuevas imágenes:</p>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach ($uform->newImages as $index => $tempImage)
                        @if (method_exists($tempImage, 'temporaryUrl'))
                        <div class="relative group rounded-lg overflow-hidden border border-gray-300">
                            <img src="{{ $tempImage->temporaryUrl() }}" alt="Nueva imagen {{ $index + 1 }}" class="object-cover w-full h-32 md:h-40">
                            <button type="button"
                                wire:click="uform.removeNewImage({{ $index }})"
                                title="Quitar esta imagen"
                                class="absolute top-1 right-1 bg-yellow-500 text-white rounded-full p-1 w-6 h-6 flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif
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


    <!-- modal para stock -->
    @if($modalStock)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-4 rounded-lg w-96">
            <h2 class="text-lg font-semibold mb-3">Modificar Stock</h2>

            <input type="number" wire:model="stockChange" placeholder="Ej. 5 o -3"
                class="w-full border rounded p-2 mb-4" />

            <div class="flex justify-end gap-2">
                <button wire:click="$set('modalStock', false)" class="bg-gray-300 px-4 py-2 rounded">Cancelar</button>
                <button wire:click="changeStock" class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
            </div>
        </div>
    </div>
    @endif
</div>