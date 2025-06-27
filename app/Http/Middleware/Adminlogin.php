<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class Adminlogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);
        // dd(Auth::user()->role_id);

        if (Auth()->check()) {
            if (Auth::user()->role_id == 1) {
                return $next($request);
            }
        } else {
            dd(Auth::user()->role_id);

            return response()->json('Login Authentication failed');
        }

    }
}
