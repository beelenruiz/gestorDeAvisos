<?php

namespace App\Livewire\Companies;

use App\Models\Machine;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Notifications extends Component
{
    #[On('createdNotification')]
    public function render()
    {
        $notifications = Notification::with('machine')
        -> where('company_id', Auth::user() -> company -> id)
        -> get();

        return view('livewire.companies.notifications', compact('notifications'));
    }


    //metodo para abrir vista de visualizer -----------------------------------------------------------
    public function visualize(int $id) {
        $notification = Notification::findOrFail($id);

        return redirect() -> route('visualizer-notification', $id);
    }


    // metodos para cancelar ----------------------------------------------------------------------------
    public function confirmCancel(int $id) {
        $notification = Notification::findOrFail($id);
        $this -> authorize('update', $notification);

        $this -> dispatch('onCancelNotification', $notification -> id);
    }

    #[On('yesCancel')]
    public function cancel(int $id) {
        $notification = Notification::findOrFail($id);
        $this -> authorize('update', $notification);

        $notification -> update(['state' => 'cancelada']);
        $this -> dispatch('message', 'Aviso cancelado');
    }
}
