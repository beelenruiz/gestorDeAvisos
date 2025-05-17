<?php

namespace App\Livewire\Forms\AdminDashboard\Category;

use App\Models\Category;
use Livewire\Attributes\Rule;
use Livewire\Form;

class FormCreateCategory extends Form
{
    #[Rule(['nullable', 'image', 'max:2048'])]
    public $icon;

    #[Rule(['required', 'min:4', 'max:255', 'unique:categories,name'])]
    public string $name = '';

    #[Rule(['required', 'string', 'min:5', 'max:255'])]
    public string $description = '';

    public function formStoreCategory()
    {
        $this->validate();

        Category::create([
            'icon' => $this->icon?->store('images/iconsCategories') ?? 'images/iconsCategories/default.png',
            'name' => $this->name,
            'description' => $this->description
        ]);
    }

    public function formReset()
    {
        $this->reset();
        $this->resetValidation();
    }
}
