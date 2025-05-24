<?php

namespace App\Livewire\Forms\AdminDashboard\Article;

use App\Models\Article;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCreateArticle extends Form
{
    #[Rule(['required', 'string', 'min:4', 'max:255', 'unique:articles,name'])]
    public string $name = '';

    #[Rule(['required', 'string', 'min:10', 'max:500'])]
    public string $description = "";

    #[Rule(['required', 'string', 'min:4', 'max:60'])]
    public string $brand = '';

    #[Rule(['required', 'numeric', 'min:10', 'max:9999.99'])]
    public float $price = 0.0;

    #[Rule(['required', 'numeric', 'max:9999'])]
    public float $stock = 0;

    #[Rule(['nullable', 'integer', 'exists:categories,id'])]
    public ?int $category_id = null;

    #[Rule(['required', 'array', 'exists:colors,id'])]
    public array $colors = [];

    #[Rule(['required', 'array', 'nullable'])]
    public array $images = [];


    public function formStoreArticle()
    {
        $this->validate();

        $article = Article::create([
            'name' => $this->name,
            'description' => $this->description,
            'brand' => $this->brand,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id
        ]);

        $article->colors()->attach($this->colors);
        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $storedPath = $image->store('images/articles');

                $article->images()->create([
                    'path' => $storedPath,
                ]);
            }
        } else {
            // Si no hay imágenes, crear una por defecto
            $article->images()->create([
                'path' => 'images/articles/default.png',
            ]);
        }
    }

    public function formReset()
    {
        $this->reset();
        $this->resetValidation();
    }
}
