<?php

namespace App\Http\Controllers;

use App\Models\Machine;
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
        $user = User::with('company')
        -> findOrFail(Auth::id());

        return view('dashboard', compact('user'));
    }

    /* boton que envia a la vista de mis maquinas */
    public function machines(){
        $machines = Machine::where('company_id', Auth::user() -> company -> id) -> get();

        return view('companies.machines', compact('machines'));
    }
}
