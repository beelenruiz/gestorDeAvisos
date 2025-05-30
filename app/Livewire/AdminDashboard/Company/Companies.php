<?php

namespace App\Livewire\AdminDashboard\Company;

use App\Livewire\Forms\AdminDashboard\Company\FormUpdateCompany;
use App\Models\Company;
use Livewire\Attributes\On;
use Livewire\Component;

class Companies extends Component
{
    public string $buscar = '';

    public FormUpdateCompany $uform;
    public bool $openUpdate = false;

    #[On('createdCompany')]
    public function render()
    {
        $companies = Company::select('companies.*')
            ->join('users', 'companies.user_id', '=', 'users.id')
            ->where('users.name', 'like', '%' . $this->buscar . '%')
            ->orderBy('users.name')
            ->with('user')
            ->get();

        return view('livewire.admin-dashboard.company.companies', compact('companies'));
    }


    // Metodos para borrar --------------------------------------------------------
    public function confirmDelete(int $id)
    {
        $company = Company::findOrfail($id);
        $this->dispatch('onDeleteCompany', $id);
    }

    #[On('yesDelete')]
    public function delete(int $id)
    {
        $company = Company::findOrfail($id);
        $user = $company->user;

        $company->delete();
        $user->delete();
        $this->dispatch('message', 'Empresa eliminada');
    }


    // Metodos para editar --------------------------------------------------------
    public function edit(int $id)
    {
        $company = Company::findOrfail($id);

        $this->uform->setCompany($company);
        $this->openUpdate = true;
    }

    public function update()
    {
        $this->uform->fromUpdateCompany();
        $this->cancelar();
        $this->dispatch('message', 'Empresa actualizada');
    }

    public function cancelar()
    {
        $this->uform->formReset();
        $this->openUpdate = false;
    }
}
