<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPasswordChange
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Si el usuario debe cambiar su contraseña y no está en la ruta de cambio
        if (
            $user &&
            $user->must_change_password == 1 &&
            !$request->routeIs('password.change') &&
            !$request->routeIs('password.change.update') &&
            !$request->is('logout')
        ) {
            return redirect()->route('password.change')
                ->with('warning', 'Debes cambiar tu contraseña antes de continuar.');
        }

        return $next($request);
    }
}
