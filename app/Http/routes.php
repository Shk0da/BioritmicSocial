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

Route::any('/reset', [
    'uses' => 'AuthController@reset',
    'as' => 'user.password.reset'
]);

Route::group(['middleware' => 'auth'], function () {

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

    Route::post('/edit', [
        'uses' => 'UserController@save',
        'as' => 'user.save'
    ]);

    Route::post('/edit/imageprofile', [
        'uses' => 'ProfileController@saveImage',
        'as' => 'user.save.image'
    ]);

    Route::post('/edit/background', [
        'uses' => 'ProfileController@saveBackground',
        'as' => 'user.save.background'
    ]);

    Route::get('/search', [
        'uses' => 'SearchController@search',
        'as' => 'search'
    ]);

});
