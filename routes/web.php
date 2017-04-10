<?php

/**
 *  This file defines the routes for the application.
 *
 */

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
Route::post('login', 'Auth\LoginController@login')->name('auth.login');
Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Password Reset Route
Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password');

Route::group(['middleware' => ['auth','account']],function (){

    Route::get('/',function(){abort(500);})->name('home')->middleware('type:null'); //Redirect to correct home

    // Main Routes - Pupils

    Route::group(['middleware' => ['type:App\Models\Pupil'],'prefix' => 'pupil'],function(){
        Route::get('/', 'PupilController@index')->name('pupil.home');
        Route::get('/tutorgroup', 'PupilController@tutorgroup')->name('pupil.tutorgroup');
        Route::get('/house', 'PupilController@house')->name('pupil.house');
    });

    Route::group(['middleware' => ['type:App\Models\Teacher'],'prefix' => 'teacher'],function(){
        Route::group(['middleware' => ['setupcheck']],function (){
            Route::get('/', 'TeacherController@index')->name('teacher.home');
            Route::get('pupils/{pupil}', 'TeacherController@viewPupil')->name('teacher.pupils.view');
        });

        Route::group(['middleware' => ['notsetupcheck']],function (){
            Route::get('setup', 'TeacherController@setupOne')->name('teacher.setup');
            Route::post('setup', 'TeacherController@setupOnePost')->name('teacher.setup');

            Route::get('setup/2', 'TeacherController@setupTwo')->name('teacher.setup.two');
            Route::post('setup/2', 'TeacherController@setupTwoPost')->name('teacher.setup.two');
        });
    });

    Route::group(['middleware' => ['type:App\Models\Administrator'], 'namespace' => 'Admin','prefix' => 'admin'],function(){
        Route::get('/', 'AdminController@index')->name('admin.home');

        Route::get('gsp','AccountController@checkGSPView')->name('admin.gsp');
        Route::post('gsp','AccountController@checkGSPLogic')->name('admin.gsp');

        Route::get('pupils', 'PupilController@index')->name('admin.pupils.index');
        Route::get('pupils/{pupil}', 'PupilController@view')->name('admin.pupils.view');

        Route::get('teachers', 'TeacherController@index')->name('admin.teachers.index');
        Route::get('teachers/{teacher}', 'TeacherController@view')->name('admin.teachers.view');

        Route::group(['prefix' => 'competitions','namespace' => 'Competitions'],function(){
            Route::get('','CompetitionController@index')->name('admin.competitions.index');

            Route::get('create','CompetitionController@create')->name('admin.competitions.create');
            Route::post('create/2','CompetitionController@createTwo')->name('admin.competitions.create.two');
            Route::post('','CompetitionController@store')->name('admin.competitions.store');

            Route::get('{competition}','CompetitionController@show')->name('admin.competitions.show');

            Route::get('{competition}/edit','CompetitionController@edit')->name('admin.competitions.edit');
            Route::put('{competition}','CompetitionController@update')->name('admin.competitions.update');

            Route::get('{competition}/delete','CompetitionController@delete')->name('admin.competitions.delete');

            // Events

        });

        Route::group(['prefix' => 'settings'],function(){
           Route::get('status','SettingsController@status')->name('admin.settings.status');


           Route::get('password','PasswordController@change')->name('admin.settings.password');
           Route::post('password','PasswordController@changePost')->name('admin.settings.password');

           Route::group(['prefix' => 'administrators'],function(){
               Route::get('/','AccountController@index')->name('admin.administrators.index');
               Route::get('{administrator}/delete','AccountController@delete')->name('admin.administrators.delete');

               Route::get('create','AccountController@create')->name('admin.administrators.create');
               Route::post('create','AccountController@createPost')->name('admin.administrators.create');
           });

            Route::group(['prefix' => 'uploads'],function(){
                Route::get('/','UploadController@index')->name('admin.uploads.index');
                Route::get('{upload}','UploadController@view')->name('admin.uploads.view');
            });

        });

    });

});
