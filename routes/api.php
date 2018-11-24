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

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');


Route::group(['middleware' => 'auth:api'], function() {

	Route::get('/user', function (Request $request) {
    	return $request->user();
    });

    Route::get('subscribers', 'SubscriberController@index');
    Route::get('subscribers/{subscriber}', 'SubscriberController@show');
    Route::post('subscribers', 'SubscriberController@store');
    Route::put('subscribers/{subscriber}', 'SubscriberController@update');
    Route::delete('subscribers/{subscriber}', 'SubscriberController@delete');

    Route::get('fields', 'FieldController@index');
    Route::get('fields/{field}', 'FieldController@show');
    Route::post('fields', 'FieldController@store');
    Route::put('fields/{field}', 'FieldController@update');
    Route::delete('fields/{field}', 'FieldController@delete');
});
