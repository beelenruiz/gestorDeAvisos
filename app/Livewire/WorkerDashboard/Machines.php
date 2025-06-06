<?php

namespace App\Livewire\WorkerDashboard;

use App\Models\Company;
use App\Models\Intervention;
use App\Models\Machine;
use Livewire\Component;

class Machines extends Component
{
    public string $buscar = '';
    public string $type = '';
    public string $company = '';

    public function render()
    {
        $machines = Machine::select('machines.*', 'users.name as user_name')
        ->leftJoin('companies', 'machines.company_id', '=', 'companies.id')
        ->leftJoin('users', 'companies.user_id', '=', 'users.id')
        -> where(function($q){
            $q -> where('machines.name', 'like', "%{$this -> buscar}%")
            -> orWhere('machines.n_serial', 'like', "{$this -> buscar}%");
        })
        ->when($this->type !== '', function ($query) {
            $query->where('machines.type', $this->type);
        })
        ->when($this->company !== '', function ($query) {
            if ($this->company === 'libre') {
                $query->whereNull('machines.company_id');
            } else {
                $query->where('users.name', $this->company);
            }
        })
        -> orderBy('name') ->get();

        $types = ['inyeccion de tinta', 'laser', 'termica', 'matricial', '3d', 'multifuncional'];
        $companies = Company::orderBy('name') ->get();

        return view('livewire.worker-dashboard.machines', compact('machines', 'types', 'companies'));
    }


    // quitar filtros
    public function filtersNo()
    {
        $this->buscar = '';
        $this->type = '';
        $this->company = '';
    }


    // abre vista del hitorial de una maquina
    public function openHistory(int $id){
        $machine = Machine::withTrashed()->findOrFail($id);
        $history = Intervention::with(['notification', 'worker.user'])
        ->where('machine_id', $id)
        ->orderByDesc('created_at')
        ->get();

        return view('worker-dashboard.history', compact('machine', 'history'));
    }
}
