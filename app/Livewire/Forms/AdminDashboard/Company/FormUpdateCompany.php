<?php

namespace App\Livewire\Forms\AdminDashboard\Company;

use App\Models\Company;
use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormUpdateCompany extends Form
{
    public ?Company $company = null;
    public ?User $user = null;

    public string $name = '';
    public string $email = '';

    #[Rule(['required', 'string', 'digits_between:7,15'])]
    public string $phone = '';

    public function rules(): array {
        return [
            'name' => ['required', 'string', 'min:4', 'max:255', 'unique:users,name,'. $this ->user -> id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'. $this -> user -> id]
        ];
    }


    public function setCompany(Company $company)
    {
        $this->company = $company;
        $this->user = $company -> user;

        $this->name = $this -> user->name;
        $this->email = $this-> user ->email;
        $this -> phone = $company -> phone;
    }

    public function fromUpdateCompany()
    {
        $this->validate();

        $datosU = [
            'name' => $this -> name,
            'email' => $this -> email
        ];
        $datosC = ['phone' => $this -> phone];

        $this -> company -> update($datosC);
        $this -> user -> update($datosU);
    }

    public function formReset()
    {
        $this->reset();
        $this->resetValidation();
    }
}
