<?php

Route::group(['namespace' => 'Consultant', 'middleware' => 'auth', 'prefix' => 'consultant'], function()
{
	//Route::get('/', ['as' => 'frontend.home.root', 'uses' => 'HomeController@index']);
	Route::get('/', 'HomeController@index');
    Route::get('/progress/{search}', 'HomeController@progress');
    Route::get('/follow/{exercise_id}/{competitor_id}', 'HomeController@follow');
    

});
