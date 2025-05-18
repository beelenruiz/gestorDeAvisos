<?php

namespace App\Livewire\Forms\AdminDashboard\Machine;

use App\Models\Machine;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormUpdateMachine extends Form
{
    public ?Machine $machine = null;

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

    public function rules(): array {
        return [
            'name' => ['required', 'min:4', 'max:255', 'unique:machines,name,'. $this -> machine -> id]
        ];
    }

    public function setMachine(Machine $machine)
    {
        $this->machine = $machine;

        $this->name = $machine->name;
        $this->color = $machine -> color;
        $this -> n_serial = $machine -> n_serial;
        $this -> type = $machine -> type;
        $this -> company_id = $machine -> company_id;
    }

    public function fromUpdateMachine()
    {
        $this->validate();

        $lastImage = $this->machine->image;
        $datos = [
            'name' => $this->name,
            'color' => $this -> color,
            'n_serial' => $this -> n_serial,
            'type' => $this -> type,
            'image' => $this->image?->store('images/machines') ?? $lastImage,
            'company_id' => $this -> company_id
        ];

        $this -> machine -> update($datos);

        if($this->image && basename($lastImage)!='default.png'){
            Storage::delete($lastImage);
        }
    }

    public function formReset()
    {
        $this->reset();
        $this->resetValidation();
    }
}
