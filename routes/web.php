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

    Route::group(['middleware' => ['type:App\Pupil'],'prefix' => 'pupil'],function(){
        Route::get('/', 'PupilController@index')->name('pupil.home');
        Route::get('/tutorgroup', 'PupilController@tutorgroup')->name('pupil.tutorgroup');
        Route::get('/house', 'PupilController@house')->name('pupil.house');
    });

    Route::group(['middleware' => ['type:App\Teacher'],'prefix' => 'teacher'],function(){
        Route::get('/', 'TeacherController@index')->name('teacher.home');

    });

    Route::group(['middleware' => ['type:App\Administrator'], 'namespace' => 'Admin','prefix' => 'admin'],function(){
        Route::get('/', 'AdminController@index')->name('admin.home');

        Route::get('pupils', 'PupilController@index')->name('admin.pupils.index');
        Route::get('pupils/{pupil}', 'PupilController@view')->name('admin.pupils.view');

    });

});
