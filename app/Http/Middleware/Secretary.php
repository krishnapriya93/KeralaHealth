<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Secretary
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);

        if (Auth()->check()) {
            if (Auth::user()->role_id == 4) {
                return $next($request);
            }
        } else {
            return redirect()->route('home');
        }
    }
}
