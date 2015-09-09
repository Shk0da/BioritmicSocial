<?php

Route::get('/', [
    'uses' => 'MainController@index',
    'as' => 'main'
]);

Route::post('/', [
    'uses' => 'AuthController@create',
    'as' => 'auth.create'
]);

Route::get('/login', [
    'uses' => 'AuthController@index',
    'as' => 'auth.index'
]);

Route::post('/login', [
    'uses' => 'AuthController@login',
    'as' => 'auth.login'
]);

Route::get('/logout', [
    'uses' => 'AuthController@logout',
    'as' => 'auth.logout'
]);

Route::get('/id{user}', [
    'uses' => 'UserController@show',
    'as' => 'profile'
])->where('user', '[0-9]+');

Route::get('/edit', [
    'uses' => 'UserController@edit',
    'as' => 'edit'
]);