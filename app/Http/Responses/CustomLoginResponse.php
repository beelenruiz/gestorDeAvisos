<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class CustomLoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        if ($user->admin) {
            return redirect()->route('admin-dashboard');
        }

        if ($user->client) {
            return redirect()->route('dashboard');
        }

        return redirect('/');
    }
}
