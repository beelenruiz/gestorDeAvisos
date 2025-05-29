<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Intervention extends Model
{
    protected $fillable = ['worker_id', 'notification_id', 'machine_id', 'duration'];

    //relacion 1:1 con notifications
    public function notification(): BelongsTo {
        return $this -> belongsTo(Notification::class);
    }

    //relacion n:1 con workers
    public function worker(): BelongsTo {
        return $this -> belongsTo(Worker::class);
    }

    //relacion n:1 con machines
    public function machine(): BelongsTo {
        return $this -> belongsTo(Machine::class)->withTrashed();
    }
}
