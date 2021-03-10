<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('users' ,'\App\Http\Controllers\UserController@index');
// Route::get('users/{id}' ,'\App\Http\Controllers\UserController@show');
// Route::post('users' ,'\App\Http\Controllers\UserController@store');
// Route::put('users/{id}' ,'\App\Http\Controllers\UserController@update');
// Route::delete('users/{id}' ,'\App\Http\Controllers\UserController@destroy');

Route::post('login', '\App\Http\Controllers\authController@login');
Route::post('register', '\App\Http\Controllers\authController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::apiResource('users', '\App\Http\Controllers\UserController');

});
