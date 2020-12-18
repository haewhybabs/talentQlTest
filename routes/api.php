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

Route::post('/register','UserController@register');
Route::post('/login','UserController@login');
Route::get('/users/{user}','UserController@test');

Route::middleware('auth:api')->group(function () {

    Route::post('/task/create','TaskController@create');
    Route::put('/task/update','TaskController@update');
    Route::get('/task/edit/{task}','TaskController@edit');
});
