<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class verificarRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (empty($roles)){
            return $next($request);
        }

        if(!$request->user()){
            return redirect('/');
        }

        foreach($roles as $role){
            if($request->user()->role->contains('name', $role)){
                return $next($request);
            }
        }

        return redirect('/')->with('error', 'No tienes permiso para acceder a esta página');
        
    }
}
