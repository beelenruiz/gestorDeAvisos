<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

    protected $fillable = ['state', 'description', 'company_id'];

    //relacion n:1 con machine
    public function machine(): BelongsTo{
        return $this -> belongsTo(Machine::class);
    }

    //relacion n:1 con company
    public function company(): BelongsTo{
        return $this -> belongsTo(Company::class);
    }
}
