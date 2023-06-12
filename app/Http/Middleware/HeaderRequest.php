<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class HeaderRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        $session = null;
        if(Session::has('token_login') && Session::get('token_login')){
            $session = Session::get('token_login');
        }
        $request->headers->set('Authorization', 'Bearer ' . $session);
        return $next($request);
    }
}
