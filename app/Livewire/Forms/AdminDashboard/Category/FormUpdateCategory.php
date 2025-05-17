<?php

namespace App\Livewire\Forms\AdminDashboard\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormUpdateCategory extends Form
{
    public ?Category $category = null;

    #[Rule(['nullable', 'image', 'max:2048'])]
    public $icon;

    public string $name = '';

    #[Rule(['required', 'string', 'min:5', 'max:255'])]
    public string $description = '';

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:4', 'max:255', 'unique:categories,name,' . $this->category->id]
        ];
    }


    public function setCategory(Category $category)
    {
        $this->category = $category;

        $this->name = $category->name;
        $this->description = $category->description;
    }

    public function fromUpdateCategory()
    {
        $this->validate();

        $lastIcon = $this->category->icon;
        $datos = [
            'icon' => $this->icon?->store('images/iconsCategories') ?? $lastIcon,
            'name' => $this->name,
            'description' => $this->description
        ];

        $this -> category -> update($datos);

        if($this->icon && basename($lastIcon)!='default.png'){
            Storage::delete($lastIcon);
        }
    }

    public function formReset()
    {
        $this->reset();
        $this->resetValidation();
    }
}
