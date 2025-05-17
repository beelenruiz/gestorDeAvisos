<?php

namespace App\Livewire\AdminDashboard;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;

class Main extends Component
{
    // no queremos perder la vista abierta al recargar
    #[Url(as: 'seccion', keep: true, history: true)]
    public $view = 'dashboard';

    public function render()
    {
        return view('livewire.admin-dashboard.main');
    }

    public function setView($view){
        $this -> view = $view;
        $this -> render();
    }
}
