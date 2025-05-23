<?php

namespace App\Livewire\AdminDashboard\Company;

use App\Livewire\Forms\AdminDashboard\Company\FormCreateCompany;
use Livewire\Component;

class CreateCompany extends Component
{
    public bool $openCreate = false;
    public FormCreateCompany $cform;

    public function render()
    {
        return view('livewire.admin-dashboard.company.create-company');
    }

    public function store()
    {
        $this->cform->formStoreCompany();

        $this->dispatch('createdCompany')->to(Companies::class);
        $this->dispatch('message', 'Empresa creada');
        $this->cancelar();
    }

    public function cancelar()
    {
        $this->openCreate = false;
        $this->cform->formReset();
    }
}
