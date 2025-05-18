<?php

namespace App\Livewire\AdminDashboard\Machine;

use App\Livewire\Forms\AdminDashboard\Machine\FormCreateMachine;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateMachine extends Component
{
    use WithFileUploads;

    public bool $openCreate = false;
    public FormCreateMachine $cform;

    public function render()
    {
        $types = ['inyeccion de tinta', 'laser', 'termica', 'matricial', '3d', 'multifuncional'];
        $companies = Company::get();

        return view('livewire.admin-dashboard.machine.create-machine', compact('types', 'companies'));
    }

    public function store()
    {
        $this->cform->formStoreMachine();

        $this->dispatch('createdMachine')->to(Machines::class);
        $this->dispatch('message', 'Maquina creada');
        $this->cancelar();
    }

    public function cancelar()
    {
        $this->openCreate = false;
        $this->cform->formReset();
    }
}
