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

Route::get('/', "ScheduleController@index");

Route::auth();

// Route::get('/home', 'HomeController@index');
Route::get('/home', function(){
	return redirect('/');
});
Route::group(['prefix' => 'trains', 'middleware' => 'auth'], function () {
	Route::get('/', "TrainController@index");	
	Route::get('/add', "TrainController@add");
	Route::get('/{id}/delete', "TrainController@delete");
	Route::get('/{id}', "TrainController@update");
	Route::post('/save', "TrainController@store");
	Route::post('/saveupdate', "TrainController@storeupdate");
});
Route::group(['prefix' => 'schedule', 'middleware' => 'auth'], function () {
	Route::get("/add", "ScheduleController@add");
	Route::get("/{id}", "ScheduleController@update");
	Route::post("/save", "ScheduleController@store");
	Route::post("/saveupdate", "ScheduleController@storeupdate");
	Route::get('/{id}/delete', "ScheduleController@delete");
});