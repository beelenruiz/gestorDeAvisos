<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;

    protected $fillable = ['company_id'];

    //relacion n:m con articles
    public function articles(): BelongsToMany{
        return $this -> belongsToMany(Article::class)
        -> withPivot('quantity', 'price')
        -> withTimestamps();
    }

    //relacion 1:1 con companies
    public function company(){
        return $this -> belongsTo(Company::class);
    }

    // para acceder al precio total del carriro
    protected function totalPrice(): Attribute {
        return Attribute::make(
            get: fn () => $this -> articles -> sum(function ($article) {
                return $article -> pivot -> quantity * $article -> pivot -> price;
            }),
        );
    }

    // para acceder el total de articulos del carrito
    protected function totalQuantity(): Attribute {
        return Attribute::make(
            get: fn () => $this -> articles -> sum('pivot.quantity'),
        );
    }
}
