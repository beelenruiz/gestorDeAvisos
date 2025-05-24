<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleImage extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleImageFactory> */
    use HasFactory;

    protected $fillable = ['article_id', 'path'];

    // relacion n:1 con articles
    public function article(): BelongsTo {
        return $this -> belongsTo(Article::class);
    }
}
