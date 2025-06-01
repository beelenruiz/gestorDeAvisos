<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Category;
use App\Models\Color;
use Livewire\Component;

class Articles extends Component
{
    public string $buscar = '';

    public $selectedCategories = [];
    public $selectedColors = [];

    public function render()
    {
        $articles = Article::with('colors')
        -> where(function($q){
            $q -> where('name', 'like', "%{$this -> buscar}%")
            -> orWhere('brand', 'like', "%{$this -> buscar}%");
        })
        -> when(!empty($this -> selectedCategories), function ($query) {
            $query -> whereIn('category_id', $this -> selectedCategories);
        })
        -> when(!empty($this -> selectedColors), function ($query) {
            $query -> whereHas('colors', function ($q) {
                $q -> whereIn('colors.id', $this -> selectedColors);
            });
        })
        -> get();

        $categories = Category::get();
        $colors = Color::get();

        return view('livewire.articles', compact('articles', 'categories', 'colors'));
    }


    // metodo para mostrar vista detalle de los productos
    public function show(int $id){
        $article = Article::findOrFail($id);

        return view('articles.show', compact('article'));
    }
}
