<?php

namespace App\Livewire\Companies;

use App\Models\Order;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class VisualizerOrder extends Component
{
    public Order $order;
    public $isEditing = false;

    public function mount($id)
    {
        $this -> order = Order::with('articles') -> findOrFail($id);
        $this -> isEditing = filter_var(Request::query('edit', false), FILTER_VALIDATE_BOOLEAN);
    }

    public function render()
    {
        return view('livewire.companies.visualizer-order');
    }


    // metodo para eliminar articulos del pedido --------------------------------------------------------
    public function deleteArticle(int $id) {
        $this -> authorize('update', $this -> order);
        $article = $this -> order -> articles() -> find($id);

        $this -> dispatch('onDeleteArticle', $id);
    }

    #[On('yesDelete')]
    public function cancel(int $id) {
        $this -> authorize('update', $this -> order);
        $article = $this -> order -> articles() -> find($id);

        $this -> order -> articles() -> detach($article -> id);
        $this -> dispatch('message', 'Articulo eliminado del pedido');
    }


    // metodos para abrir vista de visualizer con isEditing = true ------------------------------------
    public function edit(int $id) {
        $order = Order::findOrFail($id);
        $this -> authorize('update', $order);

        return redirect() -> route('visualizer-order', ['id' => $id, 'edit' => true]);
    }

    public function cancelarEdicion(int $id) {
        return redirect() -> route('visualizer-order', ['id' => $id, 'edit' => false]);
    }
}
