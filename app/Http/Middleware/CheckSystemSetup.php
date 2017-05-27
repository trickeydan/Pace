<?php

namespace App\Http\Middleware;

use App\Models\Configuration;
use Closure;
use Illuminate\Support\Facades\Schema;

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
        if(!Schema::hasTable('configurations') || Configuration::get('isSetup') != 'true'){
            abort(503,'PACE Points has not been setup. Please run the setup command');
        }

        return $next($request);
    }
}
