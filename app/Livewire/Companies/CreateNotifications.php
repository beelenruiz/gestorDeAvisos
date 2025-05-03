<?php

namespace App\Livewire\Companies;

use App\Livewire\Forms\FormCreateNotification;
use App\Models\Machine;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateNotifications extends Component
{
    public bool $openCreate = false;
    public FormCreateNotification $cform;
    public $machineId;

    public function mount($machineId = null)
    {
        // si se pasa un id se rellenara el dato en el formulario
        if($machineId != null){
            $this -> cform -> machine_id = $machineId;
        }
    }

    public function render()
    {
        $machines = Machine::where('company_id', Auth::user() -> company -> id) -> get();

        return view('livewire.companies.create-notifications', compact('machines'));
    }


    // metodo para crear
    public function store(){
        $this -> cform -> formStoreNotification();

        $this -> dispatch('createdNotification') -> to(Notifications::class);
        $this -> dispatch('message', 'Notificación enviada');
        $this -> cancelar();
    }

    public function cancelar(){
        $this -> openCreate = false;
        $this -> cform -> formReset();
    }
}
