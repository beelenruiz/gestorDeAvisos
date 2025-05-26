<?php

namespace App\Livewire\Companies;

use App\Models\Machine;
use App\Models\Notification;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VisualizerNotification extends Component
{
    public Notification $notification;

    public function mount($id)
    {
        $this->notification = Notification::with('machine', 'company', 'worker')->findOrFail($id);
    }

    public function render()
    {
        $workers = Worker::get();

        return view('livewire.companies.visualizer-notification', compact('workers'));
    }


    // metodo para asignar trabajador a una notificacion
    public function assign(int $id, string $workerId)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['worker_id' => $workerId]);
        $this->dispatch('message', 'Aviso asignado.');
    }
}
