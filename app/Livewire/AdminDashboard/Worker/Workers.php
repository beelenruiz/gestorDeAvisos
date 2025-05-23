<?php

namespace App\Livewire\AdminDashboard\Worker;

use App\Livewire\Forms\AdminDashboard\Worker\FormUpdateWorker;
use App\Models\Worker;
use Livewire\Attributes\On;
use Livewire\Component;

class Workers extends Component
{
    public FormUpdateWorker $uform;
    public bool $openUpdate = false;

    #[On('createdWorker')]
    public function render()
    {
        $workers = Worker::with('user') -> orderBy('name') -> get();

        return view('livewire.admin-dashboard.worker.workers', compact('workers'));
    }


    // Metodos para borrar --------------------------------------------------------
    public function confirmDelete(int $id)
    {
        $worker = Worker::findOrfail($id);
        $this->dispatch('onDeleteWorker', $id);
    }

    #[On('yesDelete')]
    public function delete(int $id)
    {
        $worker = Worker::findOrfail($id);
        $user = $worker -> user();

        $worker->delete();
        $user -> delete();
        $this->dispatch('message', 'Empleado eliminado');
    }


    // Metodos para editar --------------------------------------------------------
    public function edit(int $id){
        $worker = Worker::findOrfail($id);
        
        $this -> uform -> setWorker($worker);
        $this -> openUpdate = true;
    }

    public function update(){
        $this -> uform -> fromUpdateWorker();
        $this -> cancelar();
        $this -> dispatch('message', 'Empleado actualizado');
    }

    public function cancelar(){
        $this->uform->formReset();
        $this->openUpdate=false;
    }
}
