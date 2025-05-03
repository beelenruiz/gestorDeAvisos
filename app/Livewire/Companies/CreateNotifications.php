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

    public function render()
    {
        $machines = Machine::where('company_id', Auth::user() -> company -> id) -> get();

        return view('livewire.companies.create-notifications', compact('machines'));
    }

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
