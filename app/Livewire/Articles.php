<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class Articles extends Component
{
    public function render()
    {
        $articles = Article::get();

        return view('livewire.articles', compact('articles'));
    }
}
