<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Notification;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id();
        $company_id = Auth::user() -> company -> id;
        
        $user = User::with('company') -> findOrFail(Auth::id());

        $orders = Order::where('company_id', $company_id) 
        -> whereNotIn('estado', ['completado', 'cancelado']) 
        ->orderBy('estado', 'asc')
        -> get();

        $notifications = Notification::where('company_id', $company_id) 
        -> whereNotIn('estado', ['completada', 'cancelada']) 
        ->orderBy('estado', 'asc')
        -> get();;

        return view('dashboard', compact('user', 'orders', 'notifications'));
    }

    /* boton que envia a la vista de mis maquinas */
    public function machines(){
        $machines = Machine::where('company_id', Auth::user() -> company -> id) -> get();

        return view('companies.machines', compact('machines'));
    }
}
