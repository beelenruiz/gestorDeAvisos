<?php

namespace App\Livewire\AdminDashboard\Notification;

use App\Livewire\Forms\AdminDashboard\Notification\FormCreateNotification;
use App\Models\Company;
use App\Models\Machine;
use App\Models\Worker;
use Livewire\Component;

class CreateNotification extends Component
{
    public bool $openCreate = false;
    public FormCreateNotification $cform;

    public ?int $selectedCompanyId = null;

    public function render()
    {
        $machines = Machine::when($this->selectedCompanyId, function ($query) {
            return $query->where('company_id', $this->selectedCompanyId);
        }, function ($query) {
            return $query->whereNull('company_id');
        })->get();
        
        $companies = Company::get();
        $workers = Worker::get();

        return view('livewire.admin-dashboard.notification.create-notification', compact('machines', 'companies', 'workers'));
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
