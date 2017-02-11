<?php

namespace App\Providers;

use App\Account;
use App\System;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*', function ($view) {
            if(Auth::check()){
                $view->with('user',Auth::User()); // Send the user variable to all logged in pages.
            }

            if(Auth::check() && Auth::user()->accountable->getType() == Account::PUPIL){

                // Firstly, check for null models.

                $pupil = Auth::User()->accountable;

                if(is_null($pupil->tutorgroup)) {
                    System::logError(System::ERROR_NULLMODEL,'Tutorgroup Missing');
                }else{
                    if(is_null($pupil->tutorgroup->year)) {
                        System::logError(System::ERROR_NULLMODEL,'Year Missing');
                    }

                    if(is_null($pupil->tutorgroup->house)) {
                        System::logError(System::ERROR_NULLMODEL,'House Missing');
                    }
                }

                $view->with('pupil',$pupil);
            }
        });
    }
}
