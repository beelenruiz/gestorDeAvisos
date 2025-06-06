<?php

namespace App\Livewire\WorkerDashboard;

use App\Livewire\Forms\WorkerDashboard\FormCreateIntervention;
use App\Models\Machine;
use App\Models\Notification;
use Livewire\Component;

class CreateIntervention extends Component
{
    public FormCreateIntervention $cform;

    public $machines = [];

    public function mount(?int $notification_id = null)
    {
        $this->machines = Machine::orderBy('name')->get();

        $this->cform->initialize($notification_id);
    }

    public function render()
    {
        return view('livewire.worker-dashboard.create-intervention');
    }


    public function store()
    {
        $this->cform->formStoreIntervention();
        $this->cancelar();

        return redirect('worker-dashboard');
    }

    public function markAsPending()
    {
        $this->cform->formPendingIntervention();
        $this->cancelar();

        return redirect('worker-dashboard');
    }


    public function complete(int $id)
    {
        if (!isset($this->cform)) {
            $this->cform = new FormCreateIntervention($this, 'cform');
        }

        $this->cform->formCompleteIntervention($id);
        $this->cancelar();

        return redirect('worker-dashboard');
    }


    public function cancelar()
    {
        $this->cform->formReset();
        return redirect('worker-dashboard');
    }


    // actualiza el valor de observations cada vez que cambia
    public function updatedCformObservations($value)
    {
        if ($this->cform->intervention) {
            $this->cform->intervention->observations = $value;
            $this->cform->intervention->save();
        }
    }
}
