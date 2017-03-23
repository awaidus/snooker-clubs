<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class GuestMiddleware
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
        if (Sentinel::guest()) {

            return $next($request);

        } else {

            Session::flash('flash_message', 'You do not have permission to access. Please login again');

            return redirect()->route('login');
        }

    }
}
