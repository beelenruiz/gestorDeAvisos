<?php

namespace App\Livewire\Companies;

use Livewire\Component;

class CreateNotifications extends Component
{
    public bool $openCreate = false;

    public function render()
    {
        return view('livewire.companies.create-notifications');
    }
}
