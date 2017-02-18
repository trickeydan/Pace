<?php

namespace App\Http\Middleware;

use App\Configuration;
use Closure;

class CheckSystemSetup
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
        if(Configuration::get('isSetup') != 'true'){
            abort(503,'PACE Points has not been setup. Please run the setup command');
        }

        return $next($request);
    }
}
