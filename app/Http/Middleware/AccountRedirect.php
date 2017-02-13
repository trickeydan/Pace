<?php

namespace App\Http\Middleware;

use Closure;

class AccountRedirect
{
    /**
     *  Handle the current request.
     *
     *  Redirect the user if they are not permitted to access a resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$type)
    {
        $account = $request->user()->accountable;
        if($account->getType() != $type){
            return redirect($account->getHome())->withErrors('You are not allowed to access that!');
        }
        return $next($request);
    }
}
