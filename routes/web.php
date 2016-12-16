<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'cors'], function(){
    Route::post('/auth_login', 'ApiAuthController@UserAuth');
    Route::post('/signup', 'ApiAuthController@signup');
    Route::post('/validator', 'Auth\RegisterController@validator');
    Route::post('/create', 'Auth\RegisterController@create');
    Route::post('/auth_token', 'ApiAuthController@UserAuthToken');
    Route::post('/ActualizarTipoUsuario', 'ApiAuthController@ActualizarTipoUsuario');
    Route::post('/GustosListar', 'ApiController@GustosListar');
});