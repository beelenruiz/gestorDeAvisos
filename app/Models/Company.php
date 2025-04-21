<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    protected $fillable = ['phone', 'user_id'];

    //relacion 1:1 con cart
    public function cart(){
        return $this -> hasOne(Cart::class);
    }

    //relacion 1:n con orders
    public function orders(): HasMany{
        return $this -> hasMany(Order::class);
    }

    //relacion 1:n con notifications
    public function notifications(): HasMany{
        return $this -> hasMany(Notification::class);
    }

    //Relacion 1:1 con user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
