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

Route::post('/todoAdd', 'TodoController@store');
Route::post('/todoUpdate', 'TodoController@update');
Route::post('/todoDelete', 'TodoController@delete');
Route::post('/todoGet', 'TodoController@search');
Route::post('/todoClear', 'TodoController@clear');
Route::post('/todoHold', 'TodoController@hold');
Route::get('/userGet', 'UserController@search');