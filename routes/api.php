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

Route::group(['middleware' => ['api'], 'prefix' => ''], function ($router) {
    Route::post('login', 'AuthController@login')->name('user.login');
    Route::post('logout', 'AuthController@logout')->name('user.logout');
    Route::post('refresh', 'AuthController@refresh')->name('user.refresh');
    Route::get('users', 'UserController@list')->name('user.list');
    Route::get('users/{id}', 'UserController@show')->name('user.show');
    Route::delete('users/{id}', 'UserController@delete')->name('user.delete');
    Route::post('users', 'UserController@create')->name('user.create');
    Route::put('users/{id}', 'UserController@update')->name('user.update');
    Route::patch('users/{id}', 'UserController@updatePartial')->name('user.updatePartial');
    
    //Route::post('me', 'AuthController@me');
});