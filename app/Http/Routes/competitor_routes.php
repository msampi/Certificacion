<?php

Route::group(['namespace' => 'Competitor', 'middleware' => 'auth', 'prefix' => 'competitor'], function()
{
	//Route::get('/', ['as' => 'frontend.home.root', 'uses' => 'HomeController@index']);
	Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::get('/roleplay/{id}', 'HomeController@view');
    Route::get('/autoperception/{id}', 'HomeController@view');
    Route::get('/knowledges/{id}', 'HomeController@view');
    Route::get('/competencies/{id}', 'HomeController@view');
    Route::get('/link/{id}', 'HomeController@view');
    Route::any('/ecase/connect/{id}', 'HomeController@connectEcase');
    Route::get('/ecase/{id}', 'HomeController@view');
    
    Route::post('/autoperceptionSave', 'HomeController@autoperceptionSave');
    Route::post('/knowledgeSave', 'HomeController@knowledgeSave');

	
});
