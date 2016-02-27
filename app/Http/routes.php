<?php

Route::bind('user', function($value) {
    return \Pace\User::whereEmailhash(hash('sha256',$value))->first();
});

Route::group(['middleware' => ['auth','strict:pupil']], function () {
    Route::get('/',[ //My PACE Points
        'as' => 'home',
        'uses' => 'MainController@home',
    ]);

    Route::get('stats',[ //My PACE Points
        'as' => 'stats',
        'uses' => 'MainController@stats'
    ]);

    Route::get('feedback',[ //Pupil Feedback
        'as' => 'feedback',
        'uses' => 'MainController@feedback'
    ]);

    Route::post('feedback',[ //Pupil Feedback
        'as' => 'feedback.store',
        'uses' => 'MainController@feedbackStore'
    ]);
});

Route::group(['prefix' => 'teacher','namespace' => 'Admin','middleware' => ['auth','strict:teacher']], function () {
    Route::get('/',[
        'as' => 'teacher.home',
        'uses' => 'AdminController@home'
    ]);

    Route::get('events',[
        'as' => 'events.index',
        'uses' => 'EventController@index'
    ]);

});

Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','check:admin']], function () {

    Route::get('/',[
        'as' => 'admin.home',
        'uses' => 'AdminController@home'
    ]);

    Route::get('feedback',[ //View Pupil Feedback
        'as' => 'admin.feedback',
        'uses' => 'AdminController@feedback'
    ]);

    Route::group(['prefix' => 'pupils'],function(){
        Route::get('/',[
            'as' => 'admin.pupils.index',
            'uses' => 'PupilController@index'
        ]);

        Route::get('create',[
            'as' => 'admin.pupils.create',
            'uses' => 'PupilController@create'
        ]);

        Route::post('create',[
            'as' => 'admin.pupils.store',
            'uses' => 'PupilController@store'
        ]);

        Route::post('/',[
            'as' => 'admin.pupils.search',
            'uses' => 'PupilController@search'
        ]);

        Route::get('{user}',[
            'as' => 'admin.pupils.view',
            'uses' => 'PupilController@view'
        ]);

        Route::post('{user}/updatetg',[
            'as' => 'admin.pupils.updatetg',
            'uses' => 'PupilController@updatetg'
        ]);

        Route::post('{user}/updatehouse',[
            'as' => 'admin.pupils.updatehouse',
            'uses' => 'PupilController@updatehouse'
        ]);

        Route::get('{user}/edit',[
            'as' => 'admin.pupils.edit',
            'uses' => 'PupilController@edit'
        ]);

        Route::post('{user}/edit',[
            'as' => 'admin.pupils.update',
            'uses' => 'PupilController@update'
        ]);

    });

    Route::group(['prefix' => 'admins'],function() { //For Admin Users
        Route::get('/', [
            'as' => 'admin.users.index',
            'uses' => 'UserController@index'
        ]);

        Route::get('create', [
            'as' => 'admin.users.create',
            'uses' => 'UserController@create'
        ]);

        Route::post('create', [
            'as' => 'admin.users.store',
            'uses' => 'UserController@store'
        ]);
    });
});

Route::group(['middleware' => ['throttle:60']], function () {

    Route::get('login',[
        'as' => 'login',
        'uses' => 'Auth\AuthController@showLoginForm'
    ]);
    Route::get('logout',[
        'as' => 'logout',
        'uses' => 'Auth\AuthController@logout'
    ]);
    Route::post('login',[
        'as' => 'login',
        'uses' => 'Auth\AuthController@login'
    ]);

    Route::get('forgottenpin',[
        'as' => 'forgot',
        'uses' => 'PinController@forgotten'
    ]);
    Route::post('forgottenpin',[
        'as' => 'forgot.send',
        'uses' => 'PinController@send'
    ]);

    Route::get('graphs',[ //My PACE Points
        'as' => 'publicstats',
        'uses' => 'MainController@publicstats'
    ]);
});

