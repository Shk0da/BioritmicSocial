<?php

Route::get('/', [
    'uses' => 'MainController@index',
    'as' => 'main'
]);

Route::post('/', [
    'uses' => 'AuthController@create',
    'as' => 'auth'
]);

Route::get('/id{user}', 'UserController@show')
    ->where('user', '[0-9]+');