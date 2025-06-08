<?php

namespace App\Livewire\Forms\WorkerDashboard;

use App\Models\Intervention;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCreateIntervention extends Form
{
    #[Rule(['nullable', 'exists:notifications,id'])]
    public ?int $notification_id = null;

    #[Rule(['required', 'exists:machines,id'])]
    public ?int $machine_id = null;

    #[Rule(['required', 'string', 'min:5'])]
    public string $observations = '';

    public ?Carbon $started_at = null;
    public ?Intervention $intervention = null;


    public function initialize(?int $notification_id = null)
    {
        if ($notification_id) {
            $existing = Intervention::where('notification_id', $notification_id)->first();
            $notification = Notification::findOrFail($notification_id);

            if (!$existing) {
                $this->intervention = Intervention::create([
                    'notification_id' => $notification_id,
                    'machine_id' => $notification->machine_id,
                    'started_at' => Carbon::now(),
                    'worker_id' => Auth::user()->worker->id,
                    'observations' => '',
                    'duration' => 0,
                ]);

                $this->started_at = $this->intervention->started_at;
                $this->notification_id = $notification_id;
                $this->machine_id = $notification->machine_id;
                $this->observations = '';
            } else {
                $this->intervention = $existing;

                if ($notification->state == 'en espera') {
                    $this->started_at = Carbon::now();
                    $existing->started_at = $this->started_at;
                    $existing->save();

                } else {
                    $this->started_at = $existing->started_at;
                }

                $this->notification_id = $existing->notification_id;
                $this->machine_id = $existing->machine_id;
                $this->observations = $existing->observations ?? '';
            }
        } else {
            $this->started_at = Carbon::now();
            $this->notification_id = null;
            $this->machine_id = null;
            $this->intervention = null;
            $this->observations = '';
        }
        $this->resetValidation();
    }


    public function formStoreIntervention()
    {
        $this->validate();

        $ended_at = Carbon::now();
        $seconds = $this->started_at->diffInSeconds($ended_at);
        $duration = (int) ceil($seconds / 60);
        $duration = max($duration, 1);

        if (!$this->intervention) {
            $this->intervention = Intervention::create([
                'worker_id' => Auth::user()->worker->id,
                'notification_id' => $this->notification_id ? $this->notification_id : null,
                'machine_id' => $this->machine_id,
                'observations' => $this->observations,
                'started_at' => $this->started_at,
                'ended_at' => $ended_at,
                'duration' => $duration,
            ]);
        } else {
            $this->intervention->duration = $duration;
            $this->intervention->ended_at = $ended_at;

            $notification = Notification::findOrFail($this->intervention->notification->id);
            $notification->update(['state' => 'completada']);

            $this->intervention->save();
        }
    }


    public function formPendingIntervention()
    {
        if (!$this->intervention) {
            return redirect()->route('worker-dashboard');
        }

        $now = Carbon::now();

        // Duración tramo actual
        $partialDuration = $this->started_at->diffInMinutes($now);
        $partialDuration = max($partialDuration, 1);

        // Sumar duración parcial a la duración acumulada
        $this->intervention->duration += $partialDuration;
        $this->intervention->ended_at = $now;
        $this->intervention->save();

        Notification::findOrFail($this->notification_id)->update(['state' => 'en espera']);

        return redirect()->route('worker-dashboard');
    }


    public function formCompleteIntervention(int $id)
    {
        $notification = Notification::findOrFail($id);
        $intervention = Intervention::where('notification_id', $id)->first();

        $notification->update(['state' => 'completada']);
    }


    public function formReset()
    {
        $this->reset();
        $this->started_at = null;
        $this->resetValidation();
    }
}
