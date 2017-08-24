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

Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@index']);

Route::group(['prefix' => 'posts'], function () {

    Route::get('/', ['as' => 'post.index', 'uses' => 'PostController@index']);
    Route::post('/', ['as' => 'post.store', 'uses' => 'PostController@store']);

    Route::group(['prefix' => '{postSlug}'], function () {

        Route::get('/', ['as' => 'post.show', 'uses' => 'PostController@show']);
        Route::patch('/update', ['as' => 'post.update', 'uses' => 'PostController@update']);
        Route::delete('/delete', ['as' => 'post.delete', 'uses' => 'PostController@destroy']);

        Route::get('/publish', ['as' => 'post.publish', 'uses' => 'PublishedPostController@store']);
        Route::get('/unpublish', ['as' => 'post.unpublish', 'uses' => 'PublishedPostController@destroy']);
    });
});

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', ['as' => 'admin.index', 'uses' => 'Admin\AdminController@index']);
});

Route::group(['prefix' => 'subjects'], function () {

    Route::get('/', ['as' => 'subject.index', 'uses' => 'SubjectController@index']);
    Route::post('/', ['as' => 'subject.store', 'uses' => 'SubjectController@store']);

    Route::group(['prefix' => '{subjectSlug}'], function () {

        Route::get('/', ['as' => 'subject.show', 'uses' => 'SubjectController@show']);
        Route::patch('/', ['as' => 'subject.update', 'uses' => 'SubjectController@update']);
        Route::delete('/', ['as' => 'subject.delete', 'uses' => 'SubjectController@destroy']);
    });
});
