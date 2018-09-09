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

#Route::middleware('auth:api')->get('/user', function (Request $request) {
#    return $request->user();
#});

Route::post('auth/signup', 'AuthController@signup');
Route::post('auth/login', 'AuthController@login');

Route::middleware('auth:api')->group(function () {
    Route::post('auth/logout', 'AuthController@logout');
    Route::get('auth/get-user', 'AuthController@getUser');
    Route::post('dataset', 'Dataset\DatasetController@store');
});



