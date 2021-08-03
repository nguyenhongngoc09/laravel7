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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', 'ApiAuthenController@register');
    Route::post('login', 'ApiAuthenController@login');
    Route::post('logout', 'ApiAuthenController@logout');
    Route::post('refresh', 'ApiAuthenController@refresh');
    Route::get('profile', 'ApiAuthenController@profile');
});