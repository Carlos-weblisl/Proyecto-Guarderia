<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario está autenticado y si su rol es 'administrador'
        if (auth()->check()) {
            $user = auth()->user();

            // Verifica si el rol del usuario es 'administrador'
            if ($user->rol === 'administrador') {
                return $next($request); // Permite la solicitud si es administrador
            } else {
                // Si el rol no es 'administrador', redirige a la página de inicio
                return redirect()->route('home')->with('error', 'No tienes acceso a esta página.');
            }
        }

        // Si el usuario no está autenticado, redirige a la página de login
        return redirect()->route('login')->with('error', 'Por favor, inicie sesión primero.');
    }
}
