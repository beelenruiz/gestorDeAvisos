<?php

namespace App\Livewire\Companies;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Orders extends Component
{
    public function render()
    {
        $orders = Auth::user() -> company -> orders;

        return view('livewire.companies.orders', compact('orders'));
    }


    //metodo para abrir vista de visualizer -----------------------------------------------------------
    public function visualize(int $id) {
        $order = Order::findOrFail($id);
        $this -> authorize('view', $order);

        return redirect() -> route('visualizer-order', ['id' => $id, 'edit' => false]);
    }


    // metodos para abrir vista de visualizer con isEditing = true ------------------------------------
    public function edit(int $id) {
        $order = Order::findOrFail($id);
        $this -> authorize('update', $order);

        return redirect() -> route('visualizer-order', ['id' => $id, 'edit' => true]);
    }


    // metodos para cancelar ----------------------------------------------------------------------------
    public function confirmCancel(int $id) {
        $order = Order::findOrFail($id);
        $this -> authorize('update', $order);

        $this -> dispatch('onCancelOrder', $order -> id);
    }

    #[On('yesCancel')]
    public function cancel(int $id) {
        $order = Order::findOrFail($id);
        $this -> authorize('update', $order);

        $order -> update(['state' => 'cancelado']);
        $this -> dispatch('message', 'Pedido Cancelado');
    }
}
