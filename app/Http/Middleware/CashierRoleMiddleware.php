<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class CashierRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->usertype == '2') {
            
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->usertype == '1')
        {
            return $next($request);
        }
        return redirect('/')->with('error', 'You do not have permission for this page.');
    }
}
