<?php

namespace App\Providers;

use App\Models\Account;
use App\System;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

        Validator::extend('pwdcorrect', function($attribute, $value, $parameters, $validator) {
            return Auth::validate(['email' => Auth::User()->email,'password' => $value]);
        });
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
                $view->with('user',Auth::User()); // Make the user instance available to all views.
            }

            if(Auth::check() && Auth::user()->accountable->getType() == Account::PUPIL){

                // Firstly, check for null models.

                $pupil = Auth::User()->accountable;

                // Todo: Move this somewhere else. Perhaps middleware. This will increase Teacher / Admin response times.
                //Todo: Also add similar check for teachers and tutorgroups
                if(is_null($pupil->tutorgroup)) {
                    //Throw an error, the pupil has no tutorgroup.
                    System::logError(System::ERROR_NULLMODEL,'Tutorgroup Missing');
                }

                if(is_null($pupil->tutorgroup->year)) {
                    //Throw an error, the pupil has no year.
                    System::logError(System::ERROR_NULLMODEL,'Year Missing');
                }

                if(is_null($pupil->tutorgroup->house)) {
                    //Throw an error, the pupil has no year.
                    System::logError(System::ERROR_NULLMODEL,'House Missing');
                }


                $view->with('pupil',$pupil); // Make the pupil instance available to all views.
                //Todo: remove this, it is messy. Use $user->accountable instead.
            }
        });
    }
}
