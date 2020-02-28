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

Route::middleware(['Privilages'])->group(function() {
            Route::get('/posts', 'PostController@index')->name('posts');
    }
);

Route::resource('post', 'PostController');
Route::get('/hapus/{id}', 'PostController@hapus')->name('destr');
Route::resource('comments', 'CommentsController');
Route::get('detail-news/{id}', 'PostController@UpdateDataNews')->name('show.detail.news');
Route::get('update-detail-data/{id}', 'CommentsController@updateDataNews')->name('updates.data.detail.news');