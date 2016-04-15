<?php

Route::bind('user', function($value) {
    return \Pace\User::whereEmail($value)->first();
});

Route::bind('tutorgroup', function($value) {
    return \Pace\Tutorgroup::whereName($value)->first();
});

Route::group(['middleware' => ['auth','strict:pupil']], function () {
    Route::get('/',[ //My PACE Points
        'as' => 'home',
        'uses' => 'MainController@home',
    ]);

    Route::get('housepoints',[ //My PACE Points
        'as' => 'stats',
        'uses' => 'MainController@stats'
    ]);

    Route::get('competitions',[ //My PACE Points
        'as' => 'eventstats',
        'uses' => 'MainController@eventstats'
    ]);

    Route::get('competitions/{series}',[ //My PACE Points
        'as' => 'eventstats.series',
        'uses' => 'MainController@eventstatsseries'
    ]);

    Route::get('competitions/event/{event}',[ //My PACE Points
        'as' => 'eventstats.series.event',
        'uses' => 'MainController@eventstatsseriesevent'
    ]);

    /*Route::get('feedback',[ //Pupil Feedback
        'as' => 'feedback',
        'uses' => 'MainController@feedback'
    ]);

    Route::post('feedback',[ //Pupil Feedback
        'as' => 'feedback.store',
        'uses' => 'MainController@feedbackStore'
    ]);*/
});

Route::group(['prefix' => 'teacher','namespace' => 'Admin','middleware' => ['auth','check:teacher']], function () {
    Route::get('/',[
        'as' => 'teacher.home',
        'uses' => 'AdminController@home'
    ]);

    Route::group(['prefix' => 'series'],function(){

        Route::get('/',[
            'as' => 'series.index',
            'uses' => 'SeriesController@index'
        ]);

        Route::get('{series}/view',[
            'as' => 'series.view',
            'uses' => 'SeriesController@view'
        ]);

        Route::get('{series}/delete',[
            'as' => 'series.delete',
            'uses' => 'SeriesController@delete'
        ]);

        Route::get('create',[
            'as' => 'series.create',
            'uses' => 'SeriesController@create'
        ]);

        Route::post('create',[
            'as' => 'series.store',
            'uses' => 'SeriesController@store'
        ]);

        Route::group(['prefix' => '{series}/event'],function(){

            Route::get('create',[
                'as' => 'event.initial',
                'uses' => 'EventController@initial'
            ]);

            Route::post('create/2',[
                'as' => 'event.create',
                'uses' => 'EventController@create'
            ]);

            Route::post('create/3',[
                'as' => 'event.store',
                'uses' => 'EventController@store'
            ]);

            Route::get('{event}/edit',[
                'as' => 'event.edit',
                'uses' => 'EventController@edit'
            ]);

            Route::post('{event}/edit',[
                'as' => 'event.update',
                'uses' => 'EventController@update'
            ]);

            Route::get('{event}/delete',[
                'as' => 'event.delete',
                'uses' => 'EventController@delete'
            ]);

        });
    });

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

        /*Route::get('create',[
            'as' => 'admin.pupils.create',
            'uses' => 'PupilController@create'
        ]);

        Route::post('create',[
            'as' => 'admin.pupils.store',
            'uses' => 'PupilController@store'
        ]);*/

        Route::post('/',[
            'as' => 'admin.pupils.search',
            'uses' => 'PupilController@search'
        ]);

        Route::get('{user}',[
            'as' => 'admin.pupils.view',
            'uses' => 'PupilController@view'
        ]);

        /*Route::post('{user}/updatetg',[
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
        ]);*/

    });

    Route::group(['prefix' => 'tutorgroups'],function(){

        Route::get('view/{tutorgroup}',[
            'as' => 'admin.tutorgroups.view',
            'uses' => 'TGController@view'
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

        Route::get('changepassword', [
            'as' => 'admin.users.changepassword',
            'uses' => 'UserController@changepassword'
        ]);
        Route::post('changepassword', [
            'as' => 'admin.users.passwordStore',
            'uses' => 'UserController@passwordStore'
        ]);

        Route::get('{user}/delete', [
            'as' => 'admin.users.delete',
            'uses' => 'UserController@delete'
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

    /*Route::get('forgottenpin',[
        'as' => 'forgot',
        'uses' => 'PinController@forgotten'
    ]);
    Route::post('forgottenpin',[
        'as' => 'forgot.send',
        'uses' => 'PinController@send'
    ]);*/

    Route::get('graphs',[ //My PACE Points
        'as' => 'publicstats',
        'uses' => 'MainController@publicstats'
    ]);
});