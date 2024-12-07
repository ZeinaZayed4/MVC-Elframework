<?php

use illuminates\Router\Route;
use App\Http\Middleware\SimpleMiddleware;
use App\Http\Middleware\UsersMiddleware;
use illuminates\FrameworkSettings;
use App\Http\Controllers\HomeController;

Route::group(['prefix' => '/api/', 'middleware' => [SimpleMiddleware::class]], function () {
	Route::get('/', function () {
//		FrameworkSettings::setLocale($_GET['lang']);
		return FrameworkSettings::getLocale();
	});
	
	Route::get('any', HomeController::class, 'api_any', [UsersMiddleware::class]);
	
	Route::get('users', function () {
		return 'Welcome to users API route <br />';
	}, [UsersMiddleware::class]);
	
	Route::get('article', function () {
		return 'Welcome to article API route <br />';
	});
});
