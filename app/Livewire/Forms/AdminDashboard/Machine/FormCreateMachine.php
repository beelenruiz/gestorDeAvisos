<?php

namespace App\Livewire\Forms\AdminDashboard\Machine;

use App\Models\Machine;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCreateMachine extends Form
{
    #[Rule(['required', 'min:4', 'max:255', 'unique:machines,name'])]
    public string $name = '';

    #[Rule(['required', 'boolean'])]
    public bool $color = true;

    #[Rule(['required', 'string', 'min:5', 'max:255'])]
    public string $n_serial = '';

    #[Rule(['required', 'in:inyeccion de tinta,laser,termica,matricial,3d,multifuncional'])]
    public string $type = '';

    #[Rule(['nullable', 'image', 'max:2048'])]
    public $image;

    #[Rule(['nullable', 'integer', 'exists:companies,id'])]
    public ?int $company_id = null;


    public function formStoreMachine()
    {
        $this->validate();

        Machine::create([
            'name' => $this->name,
            'color' => $this->color,
            'n_serial' => $this->n_serial,
            'type' => $this->type,
            'image' => $this->image?->store('images/machines') ?? 'images/machines/default.png',
            'company_id' => $this->company_id == 0 ? null : $this->company_id
        ]);
    }

    public function formReset()
    {
        $this->reset();
        $this->resetValidation();
    }
}
