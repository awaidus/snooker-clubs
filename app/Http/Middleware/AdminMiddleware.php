<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Session;

class AdminMiddleware
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
        if (Sentinel::check() && (Sentinel::inRole('super') || Sentinel::inRole('admin')))



            return $next($request);

        else {


            Session::flash('flash_message', 'You do not have permission to access !');

            return redirect()->route('login');
        }


    }
}
