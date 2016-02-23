<?php

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
        Route::get('/',[ //My PACE Points
            'as' => 'admin.pupils.index',
            'uses' => 'PupilController@index'
        ]);
        Route::post('/',[ //My PACE Points
            'as' => 'admin.pupils.search',
            'uses' => 'PupilController@search'
        ]);

        Route::get('{user}',[ //My PACE Points
            'as' => 'admin.pupils.view',
            'uses' => 'PupilController@view'
        ]);

        Route::post('{user}/updatetg',[ //My PACE Points
            'as' => 'admin.pupils.updatetg',
            'uses' => 'PupilController@updatetg'
        ]);

        Route::post('{user}/updatehouse',[ //My PACE Points
            'as' => 'admin.pupils.updatehouse',
            'uses' => 'PupilController@updatehouse'
        ]);

        Route::get('{user}/edit',[ //My PACE Points
            'as' => 'admin.pupils.edit',
            'uses' => 'PupilController@edit'
        ]);

        Route::post('{user}/edit',[ //My PACE Points
            'as' => 'admin.pupils.update',
            'uses' => 'PupilController@update'
        ]);

    });

    Route::group(['prefix' => 'admins'],function() { //For Admin Users
        Route::get('/', [ //My PACE Points
            'as' => 'admin.users.index',
            'uses' => 'UserController@index'
        ]);

        Route::get('create', [ //My PACE Points
            'as' => 'admin.users.create',
            'uses' => 'UserController@create'
        ]);

        Route::post('create', [ //My PACE Points
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
});

