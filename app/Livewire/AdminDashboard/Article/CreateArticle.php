<?php

namespace App\Livewire\AdminDashboard\Article;

use App\Livewire\Forms\AdminDashboard\Article\FormCreateArticle;
use App\Models\Category;
use App\Models\Color;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateArticle extends Component
{
    use WithFileUploads;
    public bool $openCreate = false;
    public FormCreateArticle $cform;

    public function render()
    {
        $colors = Color::get();
        $categories = Category::orderBy('name') ->get();

        return view('livewire.admin-dashboard.article.create-article', compact('colors', 'categories'));
    }

    public function store()
    {
        $this->cform->formStoreArticle();

        $this->dispatch('createdArticle')->to(Articles::class);
        $this->dispatch('message', 'Articulo creado');
        $this->cancelar();
    }

    public function cancelar()
    {
        $this->openCreate = false;
        $this->cform->formReset();
    }
}
