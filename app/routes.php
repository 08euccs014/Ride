<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@home');
Route::get('aboutus', 'HomeController@aboutus');


Route::get('signup', 'UserController@signupForm');
Route::post('ajax/signup', 'UserController@signup');

Route::get('login', 'UserController@loginForm');
Route::post('ajax/login', 'UserController@login');