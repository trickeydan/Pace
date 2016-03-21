<?php

namespace Pace\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Pace\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       /* Validator::extend('emailhash', function($attribute, $value, $parameters, $validator) {
            $hash = hash('sha256',$value);
            return User::whereEmailhash($hash)->count() == 0;
        });*/
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
