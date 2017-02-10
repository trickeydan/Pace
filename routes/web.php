<?php

/**
 *  This file defines the routes for the application.
 *
 */

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');;

// Password Reset Route
Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');


// Main Routes - Pupils

Route::get('/', 'HomeController@index')->name('home');
Route::get('/tutorgroup', 'HomeController@tutorgroup')->name('tutorgroup');
Route::get('/house', 'HomeController@house')->name('house');
