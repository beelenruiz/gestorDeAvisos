<?php

namespace App\Livewire\AdminDashboard\Notification;

use App\Models\Notification;
use App\Models\Worker;
use Livewire\Attributes\On;
use Livewire\Component;

class Notifications extends Component
{
    #[On('createdNotification')]
    public function render()
    {
        $notifications = Notification::with('machine', 'company', 'worker') -> get();
        $states = ['procesando', 'aceptada', 'cancelada', 'en espera', 'completada'];
        $workers = Worker::get();

        return view('livewire.admin-dashboard.notification.notifications', compact('notifications', 'states','workers'));
    }


    // metodo para cambiar estado
    public function updateState(int $id, string $newState)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['state' => $newState]);
        $this->dispatch('message', 'Estado del aviso actualizado.');
    }


    // metodo para asignar trabajador a una notificacion
    public function assign(int $id, string $workerId)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['worker_id' => $workerId]);
        $this->dispatch('message', 'Aviso asignado.');
    }


    // metodos para cancelar ----------------------------------------------------------------------------
    public function confirmCancel(int $id)
    {
        $notification = Notification::findOrFail($id);

        $this->dispatch('onCancelNotification', $notification->id);
    }

    #[On('yesCancel')]
    public function cancel(int $id)
    {
        $notification = Notification::findOrFail($id);

        $notification->update(['state' => 'cancelada']);
        $this->dispatch('message', 'Aviso Cancelado');
    }


    // Metodos para borrar --------------------------------------------------------
    public function confirmDelete(int $id)
    {
        $notification = Notification::findOrfail($id);
        $this->dispatch('onDeleteNotification', $id);
    }

    #[On('yesDelete')]
    public function delete(int $id)
    {
        $notification = Notification::findOrfail($id);

        $notification->delete();
        $this->dispatch('message', 'Aviso eliminado');
    }


    //metodo para abrir vista de visualizer -----------------------------------------------------------
    public function visualize(int $id) {
        $notification = Notification::findOrFail($id);
        $this -> authorize('view', $notification);

        return redirect() -> route('visualizer-notification', $id);
    }
}
