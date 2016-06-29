<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'IndexController@index');

Route::post('/task/create', 'TaskController@create');
Route::post('/task/remove/{id}', 'TaskController@remove');
Route::post('/task/edit/done/{id}', 'TaskController@editDone');
Route::get('/task/show/{id}', 'TaskController@show');
Route::post('/comment/create/{taskId}', 'CommentController@create');