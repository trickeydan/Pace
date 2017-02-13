<?php

namespace App\Http\Middleware;

use App\System;
use Closure;

class UserHasAccount
{
    /**
     * Handle an incoming request.
     *
     * Throw an error if the logged in user doesn't have an associated account.
     * This should never happen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->user()->accountable){
            System::logError(System::ERROR_NOACCOUNT,$request->user());
        }
        return $next($request);
    }
}
