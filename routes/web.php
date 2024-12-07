<?php

use App\Http\Controllers\HomeController;
use illuminates\Router\Route;
use illuminates\Sessions\Session;
use illuminates\FrameworkSettings;
use illuminates\Locales\Lang;

//Route::get('/', HomeController::class, 'index');
Route::get('/', function () {
	FrameworkSettings::setLocale('en');
	return trans('main.channel');
});

Route::group(['prefix' => 'site'], function () {
	Route::get('about', HomeController::class, 'about');
	
	Route::get('article/{id}', function ($id) {
		return $id;
	});
});
