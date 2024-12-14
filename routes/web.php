<?php

use App\Http\Controllers\HomeController;
use illuminates\Router\Route;

Route::get('/', HomeController::class, 'index');
Route::get('data', HomeController::class, 'data');
Route::post('send/data', HomeController::class, 'data_post');

Route::group(['prefix' => 'site'], function () {
	Route::get('/about', HomeController::class, 'about');
	
	Route::get('article/{id}', function ($id) {
		return $id;
	});
});
