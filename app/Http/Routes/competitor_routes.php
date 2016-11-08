<?php

Route::group(['namespace' => 'competitor', 'middleware' => 'auth', 'prefix' => 'competitor'], function()
{
	//Route::get('/', ['as' => 'frontend.home.root', 'uses' => 'HomeController@index']);
	Route::get('/', 'HomeController@index');

	
});
