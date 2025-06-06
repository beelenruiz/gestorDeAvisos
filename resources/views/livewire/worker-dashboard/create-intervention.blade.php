<div class="worker-dashboard">
        @if ($cform->started_at)
            <div class="mb-4 p-3 bg-gray-100 border border-gray-200 rounded-md">
                <p class="text-sm text-gray-700">
                    Intervención iniciada el: <strong>{{ $cform->started_at->format('d/m/Y H:i:s') }}</strong>
                </p>
                <p class="text-xs text-gray-500">(El tiempo se está registrando internamente)</p>
            </div>
        @endif

        <div>
            <x-label for="machine_id" class="block text-sm font-medium text-gray-700">Máquina <span class="text-red-500">*</span></x-label>
            <select wire:model="cform.machine_id" id="machine_id" name="machine_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="">Seleccione una máquina...</option>
                @foreach ($machines as $machine)
                    <option value="{{ $machine->id }}">{{ $machine->name }}</option>
                @endforeach
            </select>
            <x-input-error for="cform.machine_id" />
        </div>

        <div>
            <x-label for="observations" class="block text-sm font-medium text-gray-700">Observaciones <span class="text-red-500">*</span></x-label>
            <textarea wire:model.debounce.1000ms="cform.observations" id="observations" name="observations" rows="4" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
            <x-input-error for="cform.observations" />
        </div>

        <div class="flex items-center justify-end mt-6 space-x-3">
            <button type="button" wire:click="cancelar" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Cancelar
            </button>
            <button wire:click="store" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Marcar como completada
            </button>
            @if ($cform -> notification_id)
                <x-button wire:click="markAsPending">
                    Marcar en espera
                </x-button>
            @endif
        </div>
</div>
