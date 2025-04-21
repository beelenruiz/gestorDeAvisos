<?php

namespace App\Models;

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
        -> wherePivot('quantity', 'price')
        -> withTimestamps();
    }

    //relacion 1:1 con companies
    public function company(){
        return $this -> belongsTo(Company::class);
    }
}
