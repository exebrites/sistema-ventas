<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // Verifica si el usuario tiene el rol de administrador
        if ($request->user() && $request->user()->isAdmin()) {
            return $next($request);
        }

        // Si el usuario no es un administrador, redirige a la página de inicio u otra página de tu elección
        return redirect()->route('shop')->with('error', 'No tienes permisos de administrador.');
    }
}
