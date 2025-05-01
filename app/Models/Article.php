<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'brand', 'price', 'stock', 'images', 'category_id'];

    protected $casts = [
        'images' => 'array'
    ];

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

    // relacion n:1 con category
    public function category(): BelongsTo {
        return $this  -> belongsTo(Category::class);
    }

    // relacion n:m con colors
    public function colors(): BelongsToMany {
        return $this -> belongsToMany(Color::class);
    }
}
