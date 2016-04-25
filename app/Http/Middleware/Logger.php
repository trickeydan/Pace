<?php

namespace Pace\Http\Middleware;

use Pace\Log;
use Closure;

class Logger
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
        Log::log('Accessed:' . $request->route()->getName());

        return $next($request);
    }
}
