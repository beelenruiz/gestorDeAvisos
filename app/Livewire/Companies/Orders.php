<?php

namespace App\Livewire\Companies;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Orders extends Component
{
    public function render()
    {
        $orders = Auth::user() -> company -> orders;

        return view('livewire.companies.orders', compact('orders'));
    }
}
