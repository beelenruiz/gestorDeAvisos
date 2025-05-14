<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['user_id'];

    //Relacion 1:1 con user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
