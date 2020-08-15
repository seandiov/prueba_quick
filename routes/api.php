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

Route::group(['middleware' => 'api', 'prefix' => ''], function ($router) {
    Route::post('login', 'AuthController@login')->name("api.login");
    Route::post('logout', 'AuthController@logout')->name("api.logout");
    Route::post('refresh', 'AuthController@refresh')->name("api.refresh");
    Route::post('me', 'AuthController@me')->name("api.me");;
});