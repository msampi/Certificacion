<?php

Route::group(['namespace' => 'client', 'middleware' => 'auth', 'prefix' => 'client'], function()
{
	//Route::get('/', ['as' => 'frontend.home.root', 'uses' => 'HomeController@index']);
	Route::get('/', 'HomeController@index');

});
