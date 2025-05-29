<?php

namespace App\Livewire\AdminDashboard\Article;

use App\Livewire\Forms\AdminDashboard\Article\FormUpdateArticle;
use App\Models\Article;
use App\Models\Category;
use App\Models\Color;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Articles extends Component
{
    use WithFileUploads;

    public FormUpdateArticle $uform;
    public bool $openUpdate = false;

    public int $stockChange = 0;
    public ?int $articleId = null;
    public bool $modalStock = false;

    public string $buscar = '';
    public string $color = '';
    public string $category = '';

    #[On('createdArticle')]
    public function render()
    {
        $articles = Article::select('articles.*')
            ->join('categories', 'articles.category_id', '=', 'categories.id')
            -> where(function($q){
                $q -> where('articles.name', 'like', "%{$this -> buscar}%")
                -> orWhere('articles.brand', 'like', "{$this -> buscar}%");
            })
            ->when($this->color !== '', function ($query) {
                $query->whereHas('colors', function ($q) {
                    $q->where('colors.name', $this->color);
                });
            })
            ->when($this->category !== '', function ($query) {
                $query->where('categories.name', $this->category);
            })
            ->orderBy('name')->get();
        $trashedArticles = Article::with('colors', 'category')->onlyTrashed()->get();

        $colors = Color::get();
        $categories = Category::orderBy('name')->get();

        return view('livewire.admin-dashboard.article.articles', compact('articles', 'trashedArticles', 'colors', 'categories'));
    }


    // quitar filtros
    public function filtersNo()
    {
        $this->buscar = '';
        $this->color = '';
        $this->category = '';
    }


    //mostrar y ocualtar productos descatalogados
    public bool $trashed = true;

    public function seeTrashed()
    {
        $this->trashed = !$this->trashed;
    }


    // metodo para cambiar stock --------------------------------------------------
    public function openModalStock(int $id)
    {
        $this->stockChange = 0;
        $this->articleId = $id;
        $this->modalStock = true;
    }

    public function changeStock()
    {
        $article = Article::findOrfail($this->articleId);

        $newStock = max(0, $article->stock + $this->stockChange);
        $article->update(['stock' => $newStock]);

        $this->reset(['stockChange', 'modalStock', 'articleId']);
        $this->dispatch('message', 'actualizado');
    }


    // Metodos para borrar --------------------------------------------------------
    public function confirmDelete(int $id)
    {
        $article = Article::findOrfail($id);
        $this->dispatch('onDeleteArticle', $id);
    }

    #[On('yesDelete')]
    public function delete(int $id)
    {
        $article = Article::findOrfail($id);

        $article->delete();
        $this->dispatch('message', 'Producto Borrado');
    }


    public function totalDelete(int $id)
    {
        $article = Article::onlyTrashed()->find($id);

        foreach ($article->images as $image) {
            if (basename($image) != 'default.png') {
                Storage::delete($image);
            }
        }

        $article->forceDelete();
        $this->dispatch('message', 'Producto borrado para siempre');
    }


    // metodo para restaurar un articulo eliminado -------------------------------
    public function restore(int $id)
    {
        $article = Article::onlyTrashed()->find($id);

        $article->restore();
        $this->dispatch('message', 'Articulo restaurado');
    }


    // Metodos para editar --------------------------------------------------------
    public function edit(int $id)
    {
        $article = Article::findOrfail($id);

        $this->uform->setArticle($article);
        $this->openUpdate = true;
    }

    public function update()
    {
        $this->uform->fromUpdateArticle();
        $this->cancelar();
        $this->dispatch('message', 'Articulo actualizado');
    }

    public function cancelar()
    {
        $this->uform->formReset();
        $this->openUpdate = false;
    }
}
