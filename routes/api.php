<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', 'API\UserController@login')->name('login.apis');
Route::post('/register', 'API\UserController@register')->name('register.apis');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/get-all-posted', 'API\APIpostsedComments@getALLposted')->name('detail.data.posted');
});