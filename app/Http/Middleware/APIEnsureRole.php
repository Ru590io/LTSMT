<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
class APIEnsureRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        //!auth()->check() || !in_array(auth()->user()->role, $roles)
        if (!auth()->check() || !auth()->user()->hasRole($role)) {

            return response()->json(['message' => 'Acceso denegado. No tienes los permisos necesarios.'], 403);
        }

        return $next($request);
    }
}
