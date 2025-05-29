<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

    protected $fillable = ['state', 'description', 'company_id', 'machine_id', 'worker_id'];

    //relacion n:1 con machine
    public function machine(): BelongsTo{
        return $this -> belongsTo(Machine::class)->withTrashed();
    }

    //relacion n:1 con company
    public function company(): BelongsTo{
        return $this -> belongsTo(Company::class);
    }

    //relacion n:1 con workers
    public function worker(): BelongsTo {
        return $this -> belongsTo(Worker::class);
    }

    //relacion 1:1 con interventions
    public function intervention() {
        return $this -> hasOne(Intervention::class);
    }
}
