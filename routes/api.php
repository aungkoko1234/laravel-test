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

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'API\AuthController@details');
    Route::get('users','Api\UserController@index');

});
Route::apiResource('/type', 'Api\TypeController')->middleware('auth:api');
