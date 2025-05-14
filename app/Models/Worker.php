<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Worker extends Model
{
    protected $fillable = ['user_id'];

    //Relacion 1:1 con user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacion 1:n con notifications
    public function notifications(): HasMany {
        return $this -> hasMany(Notification::class);
    }

    //relacion 1:n con interventions
    public function interventions(): HasMany {
        return $this -> hasMany(Intervention::class);
    }
}
