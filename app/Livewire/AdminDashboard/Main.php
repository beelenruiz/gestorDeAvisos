<?php

namespace App\Livewire\AdminDashboard;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Main extends Component
{
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
