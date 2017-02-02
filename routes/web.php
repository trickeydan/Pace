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
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password');;


// Main Routes
Route::get('/', 'HomeController@index')->name('home');
