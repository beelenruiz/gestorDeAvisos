<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine extends Model
{
    /** @use HasFactory<\Database\Factories\MachineFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'color', 'n_serial', 'type', 'image', 'company_id'];

    //relacion 1:n con notifications
    public function notifications(): HasMany{
        return $this -> hasMany(Notification::class);
    }
}
