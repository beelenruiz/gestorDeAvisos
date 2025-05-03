<div class="max-w-4xl mx-auto py-10 px-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Detalle del Aviso</h1>

    {{-- Información de la Notificación --}}
    <div class="bg-white shadow-md rounded-2xl p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Aviso</h2>
        <div class="space-y-2">
            <p><span class="font-semibold text-gray-500">Estado:</span> {{ $notification->state }}</p>
            <p><span class="font-semibold text-gray-500">Descripción:</span> {{ $notification->description }}</p>
        </div>
    </div>

    {{-- Información de la Empresa --}}
    <div class="bg-white shadow-md rounded-2xl p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Empresa</h2>
        <div class="space-y-2">
            <p><span class="font-semibold text-gray-500">Nombre:</span> {{ $notification->company -> user -> name }}</p>
            <p><span class="font-semibold text-gray-500">Teléfono:</span> {{ $notification->company->phone}}</p>
            <p><span class="font-semibold text-gray-500">Correo:</span> {{ $notification->company -> user -> email}}</p>
        </div>
    </div>

    {{-- Información de la Máquina --}}
    <div class="bg-white shadow-md rounded-2xl p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Máquina</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <p><span class="font-semibold text-gray-500">Nombre:</span> {{ $notification->machine->name }}</p>
            <p><span class="font-semibold text-gray-500">Color:</span> {{ $notification->machine->color }}</p>
            <p><span class="font-semibold text-gray-500">N° Serie:</span> {{ $notification->machine->n_serial }}</p>
            <p><span class="font-semibold text-gray-500">Tipo:</span> {{ $notification->machine->type }}</p>
            @if($notification->machine->image)
                <div class="col-span-2">
                    <span class="font-semibold text-gray-500">Imagen:</span>
                    <img src="{{ asset('storage/' . $notification->machine->image) }}" alt="Imagen de la máquina" class="mt-2 rounded-xl shadow-md h-60">
                </div>
            @endif
        </div>
    </div>
</div>