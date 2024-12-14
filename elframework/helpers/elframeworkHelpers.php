<?php

if (!function_exists('csrf_token')) {
	function csrf_token(): string
	{
		return \illuminates\Sessions\Session::get('csrf_token');
	}
}

if (!function_exists('csrf_field')) {
	function csrf_field(): string
	{
		$token = \illuminates\Sessions\Session::get('csrf_token');
		return "<input type='hidden' name='_token' value='" . $token . "' />";
	}
}

if (!function_exists('request')) {
	function request(string $name = null, mixed $default  = null)
	{
		if (empty($name)) {
			return \illuminates\Http\Request::all();
		} else {
			return \illuminates\Http\Request::get($name, $default);
		}
	}
}

if (!function_exists('trans')) {
	function trans(string $trans = null, array|null $attributes  = []): string|object
	{
		return !empty($trans) ? \illuminates\Locales\Lang::get($trans, $attributes) : new \illuminates\Locales\Lang;
	}
}

if (!function_exists('view')) {
	function view(string $view, null|array $data = []): mixed
	{
		return \illuminates\Views\View::make($view, $data);
	}
}

if (!function_exists('url')) {
	function url(string $url = ''): string
	{
		return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . ROOT_DIR . ltrim($url, '/');
	}
}

if (!function_exists('base_path')) {
	function base_path(string $file = null): string
	{
		return ROOT_PATH . '/../' . $file;
	}
}

if (!function_exists('storage_path')) {
	function storage_path(string $path = null): string
	{
		return !is_null($path) ? base_path('storage') . '/' . $path : '';
	}
}

if (!function_exists('route_path')) {
	function route_path(string $file = null): string
	{
		return !is_null($file) ? config('route.path') . '/' . $file : config('route.path');
	}
}

if (!function_exists('config')) {
	function config(string $file = null): string
	{
		$separator = explode('.', $file);
		if ((!empty($separator) && count($separator) > 1) && !is_null($file)) {
			$file = include base_path('config/') . $separator[0] . '.php';
			return $file[$separator[1]] ?? $file;
		}
		return $file;
	}
	
	if (!function_exists('public_path')) {
		function public_path(string $file = null): string
		{
			return !empty($file) ? getcwd() . '/' . $file : getcwd();
		}
	}
	
	if (!function_exists('bcrypt')) {
		function bcrypt(string $str): string
		{
			return (new illuminates\Hashes\Hash)->make($str);
		}
	}
	
	if (!function_exists('hash_check')) {
		function hash_check(string $pass, string $hash): string
		{
			return (new illuminates\Hashes\Hash)->check($pass, $hash);
		}
	}
	
	if (!function_exists('encrypt')) {
		function encrypt(string $value): string
		{
			return (new illuminates\Hashes\Hash)->encrypt($value);
		}
	}
	
	if (!function_exists('decrypt')) {
		function decrypt(string $value): string
		{
			return (new illuminates\Hashes\Hash)->decrypt($value);
		}
	}
}
