<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Session;

class SuperUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Sentinel::check() && (Sentinel::inRole('super'))) {

            return $next($request);

        } else {

            dd(Sentinel::getUser());


            Session::flash('flash_message', 'You do not have permission to access. Please login again');

            return redirect()->route('login');
        }


    }
}
