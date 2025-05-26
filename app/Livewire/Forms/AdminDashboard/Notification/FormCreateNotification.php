<?php

namespace App\Livewire\Forms\AdminDashboard\Notification;

use App\Models\Notification;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCreateNotification extends Form
{
    #[Rule(['required', 'string', 'min:5', 'max:255'])]
    public string $description = '';

    #[Rule(['required', 'exists:machines,id'])]
    public int $machine_id = 0;

    #[Rule(['nullable', 'exists:companies,id'])]
    public ?int $company_id = null;

    #[Rule(['nullable', 'exists:workers,id'])]
    public ?int $worker_id = null;

    public function formStoreNotification(){
        $this -> validate();

        Notification::create([
            'description' => $this -> description,
            'company_id' => $this -> company_id,
            'machine_id' => $this -> machine_id,
            'worker_id' => $this -> worker_id
        ]);
    }

    public function formReset(){
        $this -> reset();
        $this -> resetValidation();
    }
}
