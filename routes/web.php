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
    Route::post('/GustosAgregar', 'ApiController@GustosAgregar');
    Route::get('/imagen', 'ApiController@imagen');
    Route::get('/icon', 'ApiController@icon');
    Route::get('/marca', 'ApiController@marca');
    Route::post('/ProveedorGuardar', 'ApiController@ProveedorGuardar');
    Route::post('/ProveedorListar', 'ApiController@ProveedorListar');
    Route::post('/SubirImagen', 'ApiController@SubirImagen');
    Route::get('/buscarimagen', 'ApiController@buscarimagen');
});