<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class ManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Sentinel::check() && (Sentinel::inRole('super') || Sentinel::inRole('admin') || Sentinel::inRole('manager')))

            return $next($request);

        else {


            Session::flash('flash_message', 'You do not have permission to access !');

            return redirect()->route('login');
        }
    }
}
