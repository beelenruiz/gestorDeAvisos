<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Color extends Model
{
    protected $fillable = ['name', 'color'];
    public $timestamps = false;

    // relacion n:m con articles
    public function articles(): BelongsToMany {
        return $this -> belongsToMany(Article::class);
    }
}
