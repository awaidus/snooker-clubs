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


        } elseif (Sentinel::check()) {

            return redirect()->back()->with(['Error' => 'You do not have permission to access !']);

        } else {

            return redirect()->route('login')->with(['Error' => 'Not logged in !']);;
        }


    }
}
