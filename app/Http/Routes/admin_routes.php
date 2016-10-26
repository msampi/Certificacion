<?php

Route::group(['middleware' => 'admin', 'namespace' => 'Admin', 'prefix' => ''], function()
{
	Route::get('/', 'HomeController@index');
	Route::resource('evaluations', 'EvaluationController');
	Route::resource('evaluationUserEvaluators', 'EvaluationUserEvaluatorController');
	Route::resource('users', 'UserController');
	Route::resource('valorations', 'ValorationController');
	Route::resource('competitions', 'CompetitionController');
	Route::resource('objectives', 'ObjectiveController');

	Route::resource('posts', 'PostController');
	Route::resource('messages', 'MessageController');
	Route::resource('alerts', 'AlertController');
	Route::resource('values', 'ValueController');
	Route::resource('plans', 'PlanController');
	Route::resource('documents', 'DocumentController');

});

Route::group(['middleware' => 'superadmin', 'namespace' => 'Admin', 'prefix' => 'admin'], function()
{
	Route::resource('languages', 'LanguageController', ['names' => [ 'index' => 'languages.index' ] ]);
	Route::resource('clients', 'ClientController', ['names' => [ 'index' => 'clients.index' ] ]);
	Route::resource('translations', 'TranslationController',['names' => [ 'index' => 'translations.index' ] ]);
	Route::resource('ratings', 'RatingController');
	Route::resource('trackings', 'TrackingController');
});
