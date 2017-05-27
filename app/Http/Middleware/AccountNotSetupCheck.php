<?php

namespace App\Http\Middleware;

use Closure;

class AccountNotSetupCheck
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
        $user = $request->user();
        if($user->accountable->isSetup()) return redirect($user->accountable->getHome());
        return $next($request);
    }
}
