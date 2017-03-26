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
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Sentinel::check() && (Sentinel::inRole('super') || Sentinel::inRole('admin')))

            return $next($request);

        elseif (Sentinel::check()) {

            return redirect()->back()->with(['error' => 'You do not have permission to access !']);
        }

        else {

            return redirect()->route('login')->with(['error' => 'Not logged in !']);;
        }


    }
}
