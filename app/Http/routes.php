<?php

Route::group(['middleware' => ['auth','pupil']], function () {
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

Route::group(['prefix' => 'manage','namespace' => 'Admin','middleware' => ['auth','admin']], function () {

    Route::get('/',[ //My PACE Points
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

        Route::get('changepin/{user}',[ //My PACE Points
            'as' => 'admin.pupils.changepin',
            'uses' => 'PupilController@changepin'
        ]);
        Route::post('changepin/{user}',[ //My PACE Points
            'as' => 'admin.pupils.changepin',
            'uses' => 'PupilController@postChangepin'
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

Route::group([], function () {

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

