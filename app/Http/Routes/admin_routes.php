<?php

Route::group(['middleware' => 'admin', 'namespace' => 'Admin', 'prefix' => ''], function()
{
	Route::get('/', 'HomeController@index');
    Route::post('/upload', 'HomeController@upload');
    Route::post('/competency/client-groups', 'CompetencyController@getClientGroups');
    Route::post('/evaluation/exercises', 'EvaluationController@getExercises');
	Route::resource('evaluations', 'EvaluationController');
    Route::resource('clients', 'ClientController');
	Route::resource('evaluationUser', 'EvaluationUserController');
	Route::resource('users', 'UserController');
	Route::resource('competencies', 'CompetencyController');
    Route::resource('autoperceptions', 'AutoperceptionController');
    Route::resource('ratings', 'RatingController');
    Route::resource('exercises', 'ExerciseController');
    Route::resource('questionaries', 'QuestionaryController');
    Route::resource('messages', 'MessageController');
    Route::resource('trackings', 'TrackingController');

});

