<?php

namespace App\Livewire\AdminDashboard\Notification;

use App\Models\Company;
use App\Models\Notification;
use App\Models\Worker;
use Livewire\Attributes\On;
use Livewire\Component;

class Notifications extends Component
{
    public string $buscar = '';
    public string $company = '';
    public string $state = '';

    #[On('createdNotification')]
    public function render()
    {
        $notifications = Notification::select('notifications.*')
        ->leftJoin('companies', 'notifications.company_id', '=', 'companies.id')
        ->leftJoin('workers', 'notifications.worker_id', '=', 'workers.id')
        ->leftJoin('users as company_users', 'companies.user_id', '=', 'company_users.id')
        ->leftJoin('users as worker_users', 'workers.user_id', '=', 'worker_users.id')
        ->leftJoin('machines', 'notifications.machine_id', '=', 'machines.id')
        -> where(function($q){
            $q -> where('company_users.name', 'like', "%{$this -> buscar}%")
            -> orWhere('worker_users.name', 'like', "%{$this -> buscar}%")
            -> orWhere('notifications.state', 'like', "{$this -> buscar}%");
        })
        ->when($this->company !== '', function ($query) {
            $query->where('company_users.name', $this->company);
        })
        ->when($this->state !== '', function ($query) {
            $query->where('notifications.state', $this->state);
        })
        -> get();

        $states = ['procesando', 'aceptada', 'cancelada', 'en espera', 'completada'];
        $workers = Worker::get();
        $companies = Company::get();

        return view('livewire.admin-dashboard.notification.notifications', compact('notifications', 'states','workers', 'companies'));
    }


    // quitar filtros
    public function filtersNo()
    {
        $this->buscar = '';
        $this->state = '';
        $this->company = '';
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
