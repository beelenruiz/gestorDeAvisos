<?php

namespace App\Livewire\Forms;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCreateNotification extends Form
{
    #[Rule(['required', 'string', 'min:5', 'max:255'])]
    public string $description = '';

    #[Rule(['required', 'exists:machines,id'])]
    public int $machine_id = 0;

    public function formStoreNotification(){
        $this -> validate();

        Notification::create([
            'description' => $this -> description,
            'company_id' => Auth::user() -> company -> id,
            'machine_id' => $this -> machine_id
        ]);
    }

    public function formReset(){
        $this -> reset();
        $this -> resetValidation();
    }

}
