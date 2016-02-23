<?php

namespace Pace\Http\Middleware;

use Closure;

class userTypeStrict
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$type)
    {
        $typelist = ['pupil' => 1,'teacher' => 2,'admin' => 3];

        if($request->user()->user_level != $typelist[$type]){
            return redirect($request->user()->homeUrl());

        }

        return $next($request);
    }
}
