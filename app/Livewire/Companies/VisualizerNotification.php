<?php

namespace App\Livewire\Companies;

use App\Models\Machine;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VisualizerNotification extends Component
{
    public Notification $notification;

    public function mount($id)
    {
        $this -> notification = Notification::with('machine', 'company') -> findOrFail($id);
    }

    public function render()
    {        
        return view('livewire.companies.visualizer-notification');
    }
}
