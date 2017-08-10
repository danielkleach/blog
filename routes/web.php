<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['prefix' => 'posts'], function () {

    Route::get('/', ['as' => 'post.index', 'uses' => 'PostController@index']);
    Route::post('/', ['as' => 'post.store', 'uses' => 'PostController@store']);

    Route::group(['prefix' => '{postId}'], function () {

        Route::get('/', ['as' => 'post.show', 'uses' => 'PostController@show']);
        Route::patch('/', ['as' => 'post.update', 'uses' => 'PostController@update']);
        Route::delete('/', ['as' => 'post.delete', 'uses' => 'PostController@destroy']);
    });
});
