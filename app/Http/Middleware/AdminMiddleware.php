<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->usertype == '1') {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->usertype == '2') {
            // Users with usertype 2 can only access the /redirect route
            if ($request->is('pos','show_product','walkinName','walkInOrder/*','remove_order_walkIn/*','delivery','update_quantity/*','add_product')) {
                return $next($request);
            } else {
                return redirect('/redirect')->with('error', 'You do not have permission for this page.');
            }
        }

        return redirect('/redirect')->with('error', 'You do not have permission for this page.');
    }
}
