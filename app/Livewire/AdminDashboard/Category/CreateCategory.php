<?php

namespace App\Livewire\AdminDashboard\Category;

use App\Livewire\Forms\AdminDashboard\Category\FormCreateCategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCategory extends Component
{
    use WithFileUploads;

    public bool $openCreate = false;
    public FormCreateCategory $cform;

    public function render()
    {
        return view('livewire.admin-dashboard.category.create-category');
    }

    public function store()
    {
        $this->cform->formStoreCategory();

        $this->dispatch('createdCategory')->to(Categories::class);
        $this->dispatch('message', 'Categoría creada');
        $this->cancelar();
    }

    public function cancelar()
    {
        $this->openCreate = false;
        $this->cform->formReset();
    }
}
