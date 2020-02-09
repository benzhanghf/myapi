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

// APIs
Route::get('test', 'Api\PropertyController@test');
Route::get('property', 'Api\PropertyController@index');
Route::get('property/{id}', 'Api\PropertyController@show');
Route::post('property', 'Api\PropertyController@store');
Route::put('property/{id}', 'Api\PropertyController@update');
Route::delete('property/{id}', 'Api\PropertyController@delete');