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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/post', 'PostController@index')->name('home');


Route::middleware(['auth'])->group(function () {


    Route::post('/post', 'PostController@store');
    Route::get('/post', 'PostController@index');

    Route::get('/post/{id}/edit', 'PostController@edit')->name('post.edit');
    Route::post('/post/{id}/edit', 'PostController@update')->name('post.update');
    Route::post('/post/{id}/delete', 'PostController@destroy')->name('post.delete');
    Route::get('/YourPosts/', 'PostController@YourPosts')->name('post.yourposts');
    Route::get('/ShowAllPosts', 'PostController@showall')->name('post.ShowAllPosts');

    Route::get('/post/{id}', 'PostController@show')->name('post.comment');

    Route::post('/comment', 'CommentController@index');




});

