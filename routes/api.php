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

//Route::middleware('auth:api')->get('user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'static'], function () {
    Route::get('about', 'StaticController@about');
});

Route::group(['prefix' => 'word'], function () {
    Route::post('add/{word}', 'WordController@add');
});

Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::get('auth/user', 'AuthController@user');
    Route::post('auth/logout', 'AuthController@logout');
});
Route::group(['middleware' => 'jwt.refresh'], function(){
    Route::get('auth/refresh', 'AuthController@refresh');
});


Route::get('texts', 'TextController@index');
Route::group(['prefix' => 'text'], function () {
    Route::post('add', 'TextController@add');
    Route::get('edit/{id}', 'TextController@edit');
    Route::post('update/{id}', 'TextController@update');
    Route::get('view/{id}', 'TextController@view');
//    Route::get('process', 'TextController@process');
});
