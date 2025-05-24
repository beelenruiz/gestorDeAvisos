<?php

namespace App\Livewire\Forms\AdminDashboard\Article;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormUpdateArticle extends Form
{
    public ?Article $article = null;

    public string $name = '';

    #[Rule(['required', 'string', 'min:10', 'max:500'])]
    public string $description = "";

    #[Rule(['required', 'string', 'min:2', 'max:60'])]
    public string $brand = '';

    #[Rule(['required', 'numeric', 'min:1', 'max:9999.99'])]
    public float $price = 0.0;

    #[Rule(['required', 'numeric', 'max:9999'])]
    public int $stock = 0;

    #[Rule(['nullable', 'integer', 'exists:categories,id'])]
    public ?int $category_id = null;

    #[Rule(['required', 'array', 'exists:colors,id'])]
    public array $colors = [];

    // para almacenar las imagenes nuevas
    #[Rule(['array', 'nullable'])]
    public array $newImages = [];

    // imagenes a eliminar
    #[Rule(['array', 'nullable'])]
    public array $imagesToDelete = [];

    #[Rule(['required', 'array', 'nullable'])]
    public array $images = [];

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:4', 'max:255', 'unique:articles,name,' . $this->article->id]
        ];
    }

    public function setArticle(Article $article)
    {
        $this->article = $article;
        $arrayColors = $article->colors()->pluck('colors.id')->toArray();
        $arrayImages = $article->images()->pluck('path')->toArray();

        $this->name = $article->name;
        $this->description = $article->description;
        $this->brand = $article->brand;
        $this->price = $article->price;
        $this->stock = $article->stock;
        $this->category_id = $article->category_id;
        $this->colors = $arrayColors;
        $this->images = $arrayImages;
    }

    public function removeNewImage(int $index)
    {
        if (isset($this->newImages[$index])) {
            unset($this->newImages[$index]);
            $this->newImages = array_values($this->newImages);
        }
    }

    public function fromUpdateArticle()
    {
        $this->validate();

        $latestImages = $this->article->images()->pluck('path')->toArray();
        $currentImages = $this -> images;

        $datos = [
            'name' => $this->name,
            'description' => $this->description,
            'brand' => $this->brand,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
        ];

        $this->article->update($datos);

        $this->article->colors()->sync($this->colors);

        // eliminar imagenes quitadas
        if (!empty($this -> imagesToDelete)) {
            foreach ($this -> imagesToDelete as $imagePathToDelete) {
                if (basename($imagePathToDelete) !== 'default.png') {
                    Storage::delete($imagePathToDelete);
                }
                // Borra el registro de la tabla de imágenes del artículo
                $this->article->images()->where('path', $imagePathToDelete)->delete();
            }
        }

        // guardar imagenes nuevas
        if (!empty($this->newImages)) {
            foreach ($this->newImages as $file) {
                $path = $file->store('images/articles');
                $this->article->images()->create(['path' => $path]);
            }
        }

        // quito default del articulo si se han subido imagenes
        if (!empty($this->newImages)) {
            $this->article->images()
                ->where('path', 'images/articles/default.png')
                ->delete();
        }
    }

    public function formReset()
    {
        $this->reset();
        $this->resetValidation();
    }
}
