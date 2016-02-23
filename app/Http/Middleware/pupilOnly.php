<?php

namespace Pace\Http\Middleware;

use Closure;

class pupilOnly
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
        if($request->user()->user_level != 1){
            return(redirect(route('admin.home')));
        }
        return $next($request);
    }
}
