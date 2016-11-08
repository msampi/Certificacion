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


Route::auth();

require app_path().'/Http/Routes/admin_routes.php';
require app_path().'/Http/Routes/consultant_routes.php';
require app_path().'/Http/Routes/competitor_routes.php';
require app_path().'/Http/Routes/client_routes.php';


