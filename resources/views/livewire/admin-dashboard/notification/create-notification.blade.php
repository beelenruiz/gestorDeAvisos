<div>
    <x-button wire:click="$set('openCreate', true)"><i class="fas fa-add mr-2"></i>nuevo aviso</x-button>

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

            {{-- empresa --}}
            <div class="mt-4">
                <x-label for="company_id">Empresa</x-label>
                <select wire:model.live="selectedCompanyId" wire:model="cform.company_id" name="company_id" id="company_id"
                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Sin empresa</option>
                    @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company-> user ->name }}</option>
                    @endforeach
                </select>
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

            {{-- Trabajador --}}
            <div class="mt-4">
                <x-label for="worker_id">Trabajador</x-label>
                <select wire:model="cform.worker_id" name="worker_id" id="worker_id"
                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Sin trabajador asignado</option>
                    @foreach($workers as $worker)
                    <option value="{{ $worker->id }}">{{ $worker-> user->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="cform.worker_id" />
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