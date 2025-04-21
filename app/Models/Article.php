<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description', 'color', 'brand', 'price', 'stock'];

    //relacion n:m con orders
    public function orders(): BelongsToMany{
        return $this -> belongsToMany(Order::class)
        -> withTimestamps();
    }

    // relacion n:m con carts
    public function carts(): BelongsToMany{
        return $this -> belongsToMany(Cart::class)
        -> withPivot('quantity', 'price')
        -> withTimestamps();
    }
}
