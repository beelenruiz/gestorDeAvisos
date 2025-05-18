<?php

namespace App\Livewire\AdminDashboard\Category;

use App\Livewire\Forms\AdminDashboard\Category\FormUpdateCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Categories extends Component
{
    use WithFileUploads;

    public FormUpdateCategory $uform;
    public bool $openUpdate = false;

    public function render()
    {
        $categories = Category::orderBy('name')->get();

        return view('livewire.admin-dashboard.category.categories', compact('categories'));
    }


    // Metodos para borrar --------------------------------------------------------
    public function confirmDelete(int $id)
    {
        $category = Category::findOrfail($id);
        $this->dispatch('onDeleteCategory', $id);
    }

    #[On('yesDelete')]
    public function delete(int $id)
    {
        $category = Category::findOrfail($id);

        if(basename($category->image)!='default.png'){
            Storage::delete($category->image);
        }

        $category->delete();
        $this->dispatch('message', 'Categoría Borrada');
    }


    // Metodos para editar --------------------------------------------------------
    public function edit(int $id){
        $category = Category::findOrfail($id);
        
        $this -> uform -> setCategory($category);
        $this -> openUpdate = true;
    }

    public function update(){
        $this -> uform -> fromUpdateCategory();
        $this -> cancelar();
        $this -> dispatch('message', 'Categoría actualizada');
    }

    public function cancelar(){
        $this->uform->formReset();
        $this->openUpdate=false;
    }
}
