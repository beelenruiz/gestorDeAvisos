<div>
    <x-button wire:click="$set('openCreate', true)"><i class="fas fa-add mr-2"></i>nuevo empleado</x-button>

    <x-dialog-modal wire:model="openCreate">
        <x-slot name="title">
            NUEVO EMPLEADO
        </x-slot>

        <x-slot name="content">
            {{-- Nombre --}}
            <div>
                <x-label for="name">Nombre</x-label>
                <x-input type="text" wire:model="cform.name" name="name" id="name"></x-input>
                <x-input-error for="cform.name" />
            </div>

            {{-- email --}}
            <div>
                <x-label for="email">Email</x-label>
                <x-input type="text" wire:model="cform.email" name="email" id="email"></x-input>
                <x-input-error for="cform.email" />
            </div>

            {{-- password --}}
            <div>
                <x-label for="password">Contraseña</x-label>
                <x-input type="password" wire:model="cform.password" name="password" id="password"></x-input>
                <x-input-error for="cform.password" />
            </div>

            {{-- password --}}
            <div>
                <x-label for="password_confirmation">Confirma tu contraseña</x-label>
                <x-input type="password" wire:model="cform.password_confirmation" name="password_confirmation" id="password_confirmation"></x-input>
                <x-input-error for="cform.password_confirmation" />
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