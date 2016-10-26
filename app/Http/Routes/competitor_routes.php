<?php

Route::group(['namespace' => 'competitor', 'middleware' => 'auth', 'prefix' => 'competitor'], function()
{
	Route::get('/', ['as' => 'frontend.home.root', 'uses' => 'HomeController@index']);
	Route::get('/home/{id?}', ['as' => 'frontend.home', 'uses' => 'HomeController@index']);

	Route::get('users', 'UserController@index');

	Route::get('objectives', 'ObjectiveController@index');
	Route::get('objectives/{id}', 'ObjectiveController@index');
	Route::post('objectives/save', 'ObjectiveController@save');
	Route::post('objectives/delete', 'ObjectiveController@delete');

	Route::get('competitions', 'CompetitionController@index');
	Route::get('competitions/{id}', 'CompetitionController@index');
	Route::post('competitions/save', 'CompetitionController@save');

	Route::get('valorations', 'ValorationController@index');
	Route::get('valorations/{id}', 'ValorationController@index');
	Route::post('valorations/save', 'ValorationController@save');

	Route::get('pdp', 'PlanController@index');
	Route::get('pdp/{id}', 'PlanController@index');
	Route::post('pdp/save', 'PlanController@save');

	Route::get('documents', 'DocumentController@index');
	Route::get('quit', 'HomeController@quit');

	Route::get('performances', 'PerformanceController@index');
	Route::get('performances/{id}', 'PerformanceController@index');
	Route::post('performances/store', 'PerformanceController@store');





});
