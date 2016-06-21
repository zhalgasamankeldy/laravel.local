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

    /*
     * Show task dashboard
     * */

    Route::get('/', function () {
        return view('welcome');
    });


Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'],function (){
   Route::get('/tasks','TaskController@index');
   Route::get('/task/create','TaskController@create');
   Route::post('/task','TaskController@store');
   Route::get('/task/{task}','TaskController@edit');
   Route::put('/task/{task}','TaskController@update');
   Route::delete('/task/{task}','TaskController@destroy');

    Route::resource('/newTask','NewTaskController');
});
