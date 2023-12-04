<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use FactelBundle\Controller\CompraController;
use App\Http\Controllers\Backend\UsuarioController;

class RolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $rol): Response
    {
        if($request->user()->rol !== $rol){
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
