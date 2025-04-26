<?php

namespace App\Livewire\Companies;

use App\Models\Machine;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notifications extends Component
{
    public function render()
    {
        $notifications = Auth::user() -> company -> notifications;

        return view('livewire.companies.notifications', compact('notifications'));
    }
}
