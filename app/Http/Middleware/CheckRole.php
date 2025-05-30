<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        foreach ($roles as $role){
            if ($role === 'admin' && $user->admin) {
                return $next($request);
            }

            if ($role === 'company' && $user->company) {
                return $next($request);
            }

            if ($role === 'worker' && $user->worker) {
                return $next($request);
            }
        }

        abort(403, "Usuario no autorizado.");
    }
}
