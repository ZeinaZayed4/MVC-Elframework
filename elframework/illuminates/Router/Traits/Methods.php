<?php

namespace illuminates\Router\Traits;

trait Methods
{
	/**
	 * @param string $route
	 * @param mixed $controller
	 * @param mixed $action
	 * @param array $middleware
	 * @return void
	 */
	public static function get(string $route, mixed $controller, mixed $action = null, array $middleware = []): void
	{
		static::add('GET', $route, $controller, $action, $middleware);
	}
	
	/**
	 * @param string $route
	 * @param mixed $controller
	 * @param mixed $action
	 * @param array $middleware
	 * @return void
	 */
	public static function post(string $route, mixed $controller, mixed $action, array $middleware = []): void
	{
		static::add('POST', $route, $controller, $action, $middleware);
	}
	
	/**
	 * @param string $route
	 * @param mixed $controller
	 * @param mixed $action
	 * @param array $middleware
	 * @return void
	 */
	public static function put(string $route, mixed $controller, mixed $action, array $middleware = []): void
	{
		static::add('PUT', $route, $controller, $action, $middleware);
	}
	
	/**
	 * @param string $route
	 * @param mixed $controller
	 * @param mixed $action
	 * @param array $middleware
	 * @return void
	 */
	public static function patch(string $route, mixed $controller, mixed $action, array $middleware = []): void
	{
		static::add('PATCH', $route, $controller, $action, $middleware);
	}
	
	/**
	 * @param string $route
	 * @param mixed $controller
	 * @param mixed $action
	 * @param array $middleware
	 * @return void
	 */
	public static function delete(string $route, mixed $controller, mixed $action, array $middleware = []): void
	{
		static::add('DELETE', $route, $controller, $action, $middleware);
	}
}
