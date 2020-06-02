<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'AuthController@register')->name('register');
Route::post('/login', 'AuthController@login')->name('login');
Route::post('/logout', 'AuthController@logout')->name('logout');

Route::middleware('isLogin')->group(static function () {
    Route::resource('users', 'UserController');
    Route::resource('posts', 'PostController');
    Route::get('/posts/{post}/comments', 'PostController@showComments');
    Route::resource('categories', 'CategoryController');
    Route::resource('comments', 'CommentController');
});
