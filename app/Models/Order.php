<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = ['state', 'price', 'company_id'];

    //Relacion n:1 con company
    public function company(): BelongsTo{
        return $this -> belongsTo(Company::class);
    }

    //relacion n:m con articles
    public function articles(): BelongsToMany{
        return $this -> belongsToMany(Article::class)
        -> withTimestamps();
    }
}
