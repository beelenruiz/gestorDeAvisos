<?php

namespace App\Livewire\WorkerDashboard;

use App\Models\Company;
use App\Models\Machine;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Main extends Component
{
    public string $buscar = '';

    public function mount()
    {
        // Por defecto todas las tablas se muestran
        foreach (['aceptada', 'procesando', 'en espera'] as $state) {
            $this->tablesVisible[$state] = true;
        }
    }

    public function render()
    {
        $id = Auth::id();
        $worker_id = Auth::user()->worker->id;

        $notifications = Notification::select('notifications.*')
            ->leftJoin('companies', 'notifications.company_id', '=', 'companies.id')
            ->leftJoin('users as company_users', 'companies.user_id', '=', 'company_users.id')
            ->leftJoin('machines', 'notifications.machine_id', '=', 'machines.id')
            ->where('worker_id', $worker_id)
            ->where(function ($q) {
                $q->where('company_users.name', 'like', "%{$this->buscar}%")
                ->orWhere('machines.name', 'like', "{$this->buscar}%");
            })
            ->get();

        $states = ['procesando', 'aceptada', 'cancelada', 'en espera', 'completada'];

        return view('livewire.worker-dashboard.main', compact('notifications', 'states'));
    }


    //mostrar y ocualtar tabla
    public array $tablesVisible = [];

    public function toggleTable($state)
    {
        $this->tablesVisible[$state] = !$this->tablesVisible[$state];
    }


    //metodo para abrir vista de visualizer -----------------------------------------------------------
    public function visualize(int $id) {
        $notification = Notification::findOrFail($id);

        return redirect() -> route('visualizer-notification', $id);
    }


    // metodo que marca como completado un avviso que esta en espera
    public function complete(int $id){
        $notification = Notification::findOrFail($id);

        $notification -> update(['state' => 'completada']);
        $this->dispatch('message', 'Estado del aviso actualizado. Intervención finalizada');
    }
}
