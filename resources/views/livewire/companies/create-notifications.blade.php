<div>
    <x-button wire:click="$set('openCreate', true)"><i class="fas fa-add mr-2" aria-hidden="true"></i>nuevo aviso</x-button>

    <x-dialog-modal wire:model="openCreate">
        <x-slot name="title">
            NUEVA NOTIFICACIÓN
        </x-slot>

        <x-slot name="content">
            {{-- Descripción --}}
            <div>
                <x-label for="description">Descripción</x-label>
                <textarea wire:model="cform.description" name="description" id="description" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                <x-input-error for="cform.description" />
            </div>

            {{-- Máquina --}}
            <div class="mt-4">
                <x-label for="machine_id">Máquina</x-label>
                <select wire:model="cform.machine_id" name="machine_id" id="machine_id" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Selecciona una maquina</option>
                @foreach($machines as $machine)
                    <option value="{{ $machine->id }}">{{ $machine->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="cform.machine_id" />
            </div>
        </x-slot>

        <x-slot name="footer">
        <div class="flex justify-end space-x-4">
            <button wire:click="store"
               class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               aria-label="Enviar formulario">
               <i class="fa-solid fa-paper-plane mr-2" aria-hidden="true"></i>Enviar
            </button>
            <button type="button" wire:click="cancelar"
               class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               aria-label="Cancelar creación de la notificacion">
               <i class="fa-solid fa-ban mr-2" aria-hidden="true"></i>Cancelar
            </button>
         </div>
        </x-slot>
    </x-dialog-modal>
</div>