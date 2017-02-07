<?php

Route::group(['namespace' => 'Consultant', 'middleware' => 'auth', 'prefix' => 'consultant'], function()
{
	//Route::get('/', ['as' => 'frontend.home.root', 'uses' => 'HomeController@index']);
	Route::get('/', 'HomeController@index');
    Route::get('/progress/{id}', 'HomeController@progress');
    Route::get('/status/{id}/{status}', 'HomeController@changeStatus');
    Route::get('/roleplay/{exercise_id}/{competitor_id}/{consultant_id}', 'HomeController@view');
    Route::get('/autoperception/{exercise_id}/{competitor_id}/{consultant_id}', 'HomeController@view');
    Route::get('/knowledges/{exercise_id}/{competitor_id}/{consultant_id}', 'HomeController@view');
    Route::get('/competencies/{exercise_id}/{competitor_id}/{consultant_id}', 'HomeController@view');
    Route::get('/link/{exercise_id}/{competitor_id}/{consultant_id}', 'HomeController@view');
    Route::get('/ecase/{exercise_id}/{competitor_id}/{consultant_id}', 'HomeController@view');
    Route::post('/save', 'HomeController@save');
    

});
