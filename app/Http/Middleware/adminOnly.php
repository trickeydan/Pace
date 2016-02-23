<?php

namespace Pace\Http\Middleware;

use Closure;

class adminOnly
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
        if(!$request->user()->admin_level == 3){
            return(redirect(route('home')));
        }
        return $next($request);
    }
}
