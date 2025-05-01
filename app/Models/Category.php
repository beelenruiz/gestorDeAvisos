<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'icon'];
    public $timestamps = false;

    // relacion 1:n con articles
    public function articles(): HasMany {
        return $this -> hasMany(Article::class);
    }
}
