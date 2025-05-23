<?php

namespace App\Livewire\Forms\AdminDashboard\Worker;

use App\Models\User;
use App\Models\Worker;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormUpdateWorker extends Form
{
    public ?Worker $worker = null;
    public ?User $user = null;

    public string $name = '';
    public string $email = '';

    public function rules(): array {
        return [
            'name' => ['required', 'string', 'min:4', 'max:255', 'unique:users,name,'. $this ->user -> id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'. $this -> user -> id]
        ];
    }


    public function setWorker(Worker $worker)
    {
        $this->worker = $worker;
        $this->user = $worker -> user;

        $this->name = $this -> user->name;
        $this->email = $this-> user ->email;
    }

    public function fromUpdateWorker()
    {
        $this->validate();

        $datosU = [
            'name' => $this -> name,
            'email' => $this -> email
        ];

        $this -> user -> update($datosU);
    }

    public function formReset()
    {
        $this->reset();
        $this->resetValidation();
    }
}
