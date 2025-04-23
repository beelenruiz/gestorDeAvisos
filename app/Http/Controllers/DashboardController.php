<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with('company')
        -> findOrFail(Auth::id());

        return view('dashboard', compact('user'));
    }

    /* boton que envia a la vista de mis maquinas */
    public function machines(){
        $machines = Machine::where('company_id', Auth::user() -> company -> id) -> get();

        return view('companies.machines', compact('machines'));
    }

    /* boton que envia a la vista de mis pedidos */
    public function orders(){
        $orders = Auth::user() -> orders;

        return view('livewire.companies.orders', compact('orders'));
    }
}
