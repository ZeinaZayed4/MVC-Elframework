<?php

namespace App;

class Core
{
	public static array $globalWeb = [
		\illuminates\Sessions\Session::class,
		\illuminates\Middleware\CSRFToken::class,
	];
	
	public static array $middlewareWebRoute = [
		'simple' => \App\Http\Middleware\SimpleMiddleware::class,
	];

	public static array $middlewareApiRoute = [];
	
	public static array $globalApi = [];
}
