<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Detalles del Pedido #{{$order -> id}}</h1>

    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Artículo</th>
                <th class="py-3 px-6 text-left">Precio</th>
                <th class="py-3 px-6 text-left">Cantidad</th>
                <th class="py-3 px-6 text-left">Subtotal</th>
                @if($isEditing)
                    <th class="py-3 px-6 text-center">Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($order -> articles as $article)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">
                        {{$article -> name}}
                    </td>
                    <td class="py-3 px-6 text-left">
                        {{$article -> price}} €
                    </td>
                    <td class="py-3 px-6 text-left">
                        {{$article -> cantidad}}
                    </td>
                    <td class="py-3 px-6 text-left">
                        €
                    </td>
                    @if($isEditing)
                        <td class="py-3 px-6 text-center">
                            <button wire:click="deleteArticle({{$article->id}})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                Eliminar
                            </button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6 text-right">
        <span class="text-lg font-semibold">Total: {{$order -> price}} €</span>
    </div>

    @if($isEditing)
        <div class="mt-6 flex justify-end space-x-4">
            <button wire:click="guardarCambios" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Guardar Cambios
            </button>
            <button wire:click="cancelarEdicion" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Cancelar
            </button>
        </div>
    @endif
</div>
