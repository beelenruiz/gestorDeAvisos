<?php

namespace App\Livewire\AdminDashboard\Machine;

use App\Livewire\Forms\AdminDashboard\Machine\FormUpdateMachine;
use App\Models\Company;
use App\Models\Machine;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Machines extends Component
{
    use WithFileUploads;

    public FormUpdateMachine $uform;
    public bool $openUpdate = false;

    public function render()
    {
        $machines = Machine::orderBy('name')->get();
        $trashedMachines = Machine::onlyTrashed()->get();
        $types = ['inyeccion de tinta', 'laser', 'termica', 'matricial', '3d', 'multifuncional'];
        $companies = Company::get();

        return view('livewire.admin-dashboard.machine.machines', compact('machines', 'trashedMachines', 'types', 'companies'));
    }


    //mostrar y ocualtar maquinas borradas
    public bool $trashed = true;

    public function seeTrashed(){
        $this->trashed = !$this->trashed;
    }


    // Metodos para borrar --------------------------------------------------------
    public function confirmDelete(int $id)
    {
        $machine = Machine::findOrfail($id);
        $this->dispatch('onDeleteMachine', $id);
    }

    #[On('yesDelete')]
    public function delete(int $id)
    {
        $machine = Machine::findOrfail($id);

        $machine->delete();
        $this->dispatch('message', 'Maquina Borrada');
    }


    public function totalDelete(int $id){
        $machine = Machine::onlyTrashed()->find($id);

        if(basename($machine->image)!='default.png'){
            Storage::delete($machine->image);
        }

        $machine->forceDelete();
        $this->dispatch('message', 'Maquina Borrada para siempre');
    }


    // metodo para restaurar una maquina eliminada -------------------------------
    public function restore(int $id){
        $machine = Machine::onlyTrashed()->find($id);

        $machine -> update(['company_id' => null]);

        $machine->restore();
        $this->dispatch('message', 'Maquina restaurada');
    }


    // Metodos para editar --------------------------------------------------------
    public function edit(int $id)
    {
        $machine = Machine::findOrfail($id);

        $this->uform->setMachine($machine);
        $this->openUpdate = true;
    }

    public function update()
    {
        $this->uform->fromUpdateMachine();
        $this->cancelar();
        $this->dispatch('message', 'Maquina actualizada');
    }

    public function cancelar()
    {
        $this->uform->formReset();
        $this->openUpdate = false;
    }
}
