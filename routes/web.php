<?php

use App\Http\Controllers\HomeController;
use illuminates\Router\Route;

Route::get('/', HomeController::class, 'index');
//Route::get('/', function () {
//	return view('index');
//});

Route::group(['prefix' => 'site'], function () {
	Route::get('/about', HomeController::class, 'about');
	
	Route::get('article/{id}', function ($id) {
		return $id;
	});
});
