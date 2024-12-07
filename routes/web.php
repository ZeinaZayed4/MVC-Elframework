<?php

use App\Http\Controllers\HomeController;
use illuminates\Router\Route;
use illuminates\Sessions\Session;

//Route::get('/', HomeController::class, 'index');
Route::get('/', function () {
	return Session::get('locale');
});

Route::group(['prefix' => 'site'], function () {
	Route::get('about', HomeController::class, 'about');
	
	Route::get('article/{id}', function ($id) {
		return $id;
	});
});
