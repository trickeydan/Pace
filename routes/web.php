<?php

/**
 *  This file defines the routes for the application.
 *
 */

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Password Reset Route
Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

Route::group(['middleware' => ['auth','account']],function (){

    Route::get('/',function(){})->name('home')->middleware('type:null'); //Redirect to correct home

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

        Route::group(['prefix' => 'settings'],function(){
           Route::get('status','SettingsController@status')->name('admin.settings.status');

           Route::get('administrators','AccountController@index')->name('admin.administrators.index');

           Route::get('administrators/{administrator}/delete','AccountController@delete')->name('admin.administrators.delete');

        });

    });

});
