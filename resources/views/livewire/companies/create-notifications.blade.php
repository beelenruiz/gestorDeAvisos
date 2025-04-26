<div>
    <x-button wire:click="$set('openCreate', true)"><i class="fas fa-add mr-2"></i>nuevo aviso</x-button>

    <x-dialog-modal wire:model="openCreate">
        <x-slot name="title">
            NUEVO ARTÍCULO
        </x-slot>

        <x-slot name="content">

        </x-slot>

        <x-slot name="footer">

        </x-slot>
    </x-dialog-modal>
</div>