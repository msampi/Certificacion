<?php

Route::group(['middleware' => 'admin', 'namespace' => 'Admin', 'prefix' => ''], function()
{
	Route::get('/', 'HomeController@index');
	Route::resource('evaluations', 'EvaluationController');
    Route::resource('clients', 'ClientController');
	Route::resource('evaluationUser', 'EvaluationUserController');
	Route::resource('users', 'UserController');
	Route::resource('competencies', 'CompetencyController');
    Route::resource('ratings', 'RatingController');
    Route::resource('exercises', 'ExerciseController');
    Route::resource('messages', 'MessageController');

});

