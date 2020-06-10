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
    Route::get('/posts/{post}/test_email', 'PostController@testEmail');
    Route::resource('categories', 'CategoryController');
    Route::resource('comments', 'CommentController');
});

//Route::get('test_email', function () {
//    Mail::raw('Sending emails with Mailgun and Laravel !', function ($message) {
//        $message->to('ivanenkoaleksei@mail.ru');
//    });
//});
