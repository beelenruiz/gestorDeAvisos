<?php

namespace App\Livewire\AdminDashboard\Worker;

use App\Livewire\Forms\AdminDashboard\Worker\FormCreateWorker;
use Livewire\Component;

class CreateWorker extends Component
{
    public bool $openCreate = false;
    public FormCreateWorker $cform;

    public function render()
    {
        return view('livewire.admin-dashboard.worker.create-worker');
    }

    public function store()
    {
        $this->cform->formStoreWorker();

        $this->dispatch('createdWorker')->to(Workers::class);
        $this->dispatch('message', 'Empleado creado');
        $this->cancelar();
    }

    public function cancelar()
    {
        $this->openCreate = false;
        $this->cform->formReset();
    }
}
