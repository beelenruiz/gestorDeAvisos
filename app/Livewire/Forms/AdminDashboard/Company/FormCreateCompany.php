<?php

namespace App\Livewire\Forms\AdminDashboard\Company;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCreateCompany extends Form
{
    #[Rule(['required', 'string', 'min:4', 'max:255', 'unique:users,name'])]
    public string $name = '';

    #[Rule(['required', 'string', 'email', 'max:255', 'unique:users,email'])]
    public string $email = '';

    public string $password = '';
    public string $password_confirmation = '';

    #[Rule(['required', 'string', 'digits_between:7,15'])]
    public string $phone = '';

    public function rules(): array {
        return [
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers(), 'confirmed'],
            'password_confirmation' => ['required']
        ];
    }

    public function formStoreCompany()
    {
        $this->validate();

        $user = User::create([
            'name' => $this -> name,
            'email' => $this -> email,
            'password' => Hash::make($this -> password),
        ]);

        $user -> company() -> create([
            'phone' => $this -> phone,
        ]);
    }

    public function formReset()
    {
        $this->reset();
        $this->resetValidation();
    }
}
