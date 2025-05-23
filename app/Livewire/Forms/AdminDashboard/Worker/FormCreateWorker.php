<?php

namespace App\Livewire\Forms\AdminDashboard\Worker;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCreateWorker extends Form
{
    #[Rule(['required', 'string', 'min:4', 'max:255', 'unique:users,name'])]
    public string $name = '';

    #[Rule(['required', 'string', 'email', 'max:255', 'unique:users,email'])]
    public string $email = '';

    public string $password = '';
    public string $password_confirmation = '';

    public function rules(): array {
        return [
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers(), 'confirmed'],
            'password_confirmation' => ['required']
        ];
    }

    public function formStoreWorker()
    {
        $this->validate();

        $user = User::create([
            'name' => $this -> name,
            'email' => $this -> email,
            'password' => Hash::make($this -> password),
        ]);

        $user -> worker() -> create();
    }

    public function formReset()
    {
        $this->reset();
        $this->resetValidation();
    }
}
