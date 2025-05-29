<?php

namespace App\Livewire\AdminDashboard\Order;

use App\Livewire\Forms\AdminDashboard\Order\FormUpdateOrder;
use App\Models\Company;
use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Component;

class Orders extends Component
{
    public string $buscar = '';
    public string $company = '';
    public string $state = '';

    public function render()
    {
        $orders = Order::select('orders.*')
        ->join('companies', 'orders.company_id', '=', 'companies.id')
        ->join('users', 'companies.user_id', '=', 'users.id')
        -> where(function($q){
            $q -> where('users.name', 'like', "%{$this -> buscar}%")
            -> orWhere('orders.id', 'like', "{$this -> buscar}%");
        })
        ->when($this->company !== '', function ($query) {
            $query->where('users.name', $this->company);
        })
        ->when($this->state !== '', function ($query) {
            $query->where('orders.state', $this->state);
        })
        ->orderBy('date')
        ->get();
        $states = ['completado', 'aceptado', 'cancelado', 'pendiente'];
        $companies = Company::with('user') -> get();

        return view('livewire.admin-dashboard.order.orders', compact('orders', 'states', 'companies'));
    }


    // quitar filtros
    public function filtersNo(){
        $this -> buscar = '';
        $this -> company = '';
        $this -> state = '';
    }


    // metodo para cambiar estado
    public function updateState(int $id, string $newState)
    {
        $order = Order::findOrFail($id);
        $order->update(['state' => $newState]);
        $this->dispatch('message', 'Estado del pedido actualizado.');
    }


    // metodos para cancelar ----------------------------------------------------------------------------
    public function confirmCancel(int $id)
    {
        $order = Order::findOrFail($id);

        $this->dispatch('onCancelOrder', $order->id);
    }

    #[On('yesCancel')]
    public function cancel(int $id)
    {
        $order = Order::findOrFail($id);

        $order->update(['state' => 'cancelado']);
        $this->dispatch('message', 'Pedido Cancelado');
    }


    // Metodos para borrar --------------------------------------------------------
    public function confirmDelete(int $id)
    {
        $order = Order::findOrfail($id);
        $this->dispatch('onDeleteOrder', $id);
    }

    #[On('yesDelete')]
    public function delete(int $id)
    {
        $order = Order::findOrfail($id);

        $order->delete();
        $this->dispatch('message', 'Pedido Borrado');
    }


    //metodo para abrir vista de visualizer -----------------------------------------------------------
    public function visualize(int $id)
    {
        $order = Order::findOrFail($id);

        return redirect()->route('visualizer-order', $id);
    }


    // metodos para abrir vista de visualizer con isEditing = true ------------------------------------
    public function edit(int $id)
    {
        $order = Order::findOrFail($id);

        return redirect()->route('visualizer-order', ['id' => $id, 'edit' => true]);
    }
}
