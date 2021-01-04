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
Route::middleware('auth:api')->group(function () {

    Route::post('/task/create','TaskController@create');
    //Route model binding
    Route::put('/task/update/{task}','TaskController@update');
    //Route model binding
    Route::get('/task/view/{task}','TaskController@view');
    Route::get('/task','TaskController@index');
    //Route model binding
    Route::delete('/task/delete/{task}', 'TaskController@delete');
});
