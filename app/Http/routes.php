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

    Route::get('/add/id{user}', [
        'uses' => 'FriendController@add',
        'as' => 'friend.add'
    ]);

    Route::get('/accept/id{user}', [
        'uses' => 'FriendController@accept',
        'as' => 'friend.accept'
    ]);

    Route::get('/remove-request/id{user}', [
        'uses' => 'FriendController@removeRequest',
        'as' => 'friend.remove.request'
    ]);

    Route::get('/remove/id{user}', [
        'uses' => 'FriendController@remove',
        'as' => 'friend.remove'
    ]);

    Route::post('/post-send', [
        'uses' => 'PostController@send',
        'as' => 'post.send'
    ]);

    Route::post('/post/{postId}/comment', [
        'uses' => 'PostController@comment',
        'as' => 'post.comment'
    ]);

    Route::get('/post/{postId}/like', [
        'uses' => 'PostController@getLike',
        'as' => 'post.like'
    ]);

    Route::get('/post/{postId}/repost', [
        'uses' => 'PostController@repost',
        'as' => 'post.repost'
    ]);

    Route::get('/post/{postId}/delete', [
        'uses' => 'PostController@delete',
        'as' => 'post.delete'
    ]);

    Route::get('/photo/', [
        'uses' => 'PhotoController@edit',
        'as' => 'photo.edit'
    ]);

    Route::post('/photo/album-create', [
        'uses' => 'PhotoController@albumCreate',
        'as' => 'photo.album.create'
    ]);

    Route::get('/photo/album/{albumId}', [
        'uses' => 'PhotoController@albumShow',
        'as' => 'photo.album.show'
    ]);

    Route::post('/photo/album/{albumId}/add', [
        'uses' => 'PhotoController@addPhoto',
        'as' => 'photo.add'
    ]);

    Route::any('/messages', [
        'uses' => 'MessageController@main',
        'as' => 'messages'
    ]);

    Route::get('/messages/chat/{to}', [
        'uses' => 'MessageController@chat',
        'as' => 'chat'
    ]);

    Route::any('/api/{action}', [
        'uses' => 'ApiController@main',
        'as' => 'api'
    ]);
});
