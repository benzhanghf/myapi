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
// create a new property
Route::post('property', 'Api\PropertyController@create');
// add or upate an analytic to propert
Route::post('property/analytic', 'Api\PropertyController@upsertAnalytic');
// Get all analytics for an inputted property
Route::get('property/analytic/{pid}', 'Api\PropertyController@allAnalyticByProperty');
// Get a summary of all property analytics for an inputted suburb 
// (min value, max value, median value, percentage properties with a value, percentage properties without a value)
Route::get('property/report/suburb/{suburb}', 'Api\PropertyController@suburbReport');
//Get a summary of all property analytics for an inputted state 
// (min value, max value, median value, percentage properties with a value, percentage properties without a value)
Route::get('property/report/state/{state}', 'Api\PropertyController@stateReport');
//Get a summary of all property analytics for an inputted country 
// (min value, max value, median value, percentage properties with a value, percentage properties without a value)
Route::get('property/report/country/{country}', 'Api\PropertyController@countryReport');