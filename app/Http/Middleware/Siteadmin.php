<?php

namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Closure;
use Illuminate\Http\Request;

class Siteadmin
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

        if (Auth()->check()) {

            // $password = Auth::user()->password;
            // $userdata = User::where('id', Auth::user()->id)->first();
            // dd($request);

            // Hash::make($data['password'])

            // Auth::logoutOtherDevices('cdit1234');

            if (Auth::user()->role_id == 2) {
                return $next($request);
            }
        } else {
            return redirect()->route('home');
        }
    }
}
