<?php

namespace illuminates\Router;

use Exception;
use illuminates\Logs\Log;
use illuminates\Middleware\Middleware;

class Router
{
	protected static $routes = [];
	protected static $groupAttributes = [];
	
	
	/**
	 * @param string $method
	 * @param string $route
	 * @param $controller
	 * @param $action
	 * @param array $middleware
	 * @return void
	 */
	public static function add(string $method, string $route, $controller, $action = null, array $middleware = []): void
	{
		$route  = self::applyGroupPrefix($route);
		$middleware = array_merge(static::getGroupMiddleware(), $middleware);
		self::$routes[] = [
			'method' => $method,
			'uri' => $route == '/' ? $route : ltrim($route, '/'),
			'controller' => $controller,
			'action' => $action,
			'middleware' => $middleware
		];
	}
	
	/**
	 * @param $attributes
	 * @param $callback
	 * @return void
	 */
	public static function group($attributes, $callback): void
	{
		$previousGroupAttribute  = static::$groupAttributes;
		static::$groupAttributes = array_merge(static::$groupAttributes, $attributes);
		call_user_func($callback, new self);
		static::$groupAttributes = $previousGroupAttribute;
	}
	
	/**
	 * @param $route
	 * @return string
	 */
	protected static function applyGroupPrefix($route): string
	{
		if (isset(static::$groupAttributes['prefix'])) {
			$full_route = rtrim(static::$groupAttributes['prefix'], '/') . '/' . ltrim($route, '/');
			return rtrim(ltrim($full_route, '/'), '/');
		} else {
			return $route;
		}
	}
	
	/**
	 * @return array
	 */
	protected static function getGroupMiddleware(): array
	{
		return static::$groupAttributes['middleware'] ?? [];
	}
	
	/**
	 * @return array
	 */
	public function routes(): array
	{
		return static::$routes;
	}
	
	/**
	 * @param $uri
	 * @param $method
	 * @return string
	 * @throws Exception
	 */
	public static function dispatch($uri, $method): string
	{
		$uri = ltrim($uri, ROOT_DIR);
		$uri = empty($uri) ? '/' : $uri;
		$method = strtoupper($method);
		
		foreach (static::$routes as $route) {
			if ($route['method'] == $method) {
				$pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_]+)', $route['uri']);
				$pattern = "#^$pattern$#";
				if (preg_match($pattern, $uri, $matches)) {
					$params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
					$controller = $route['controller'];
					if (is_object($controller)) {
						$middlewareStack = !empty($route['action']) && !empty($route['middleware']) ?
							array_merge($route['middleware'], $route['action']) : $route['middleware'];
						
						// Prepare Data and add anonymous function to $next variable
						$next = function ($request) use ($controller, $params) {
							return  $controller(...$params);
						};
						
						// Processing Middleware if using Anonymous Functions
						$next = Middleware::handleMiddleware($middlewareStack, $next);
						echo $next($uri);
					} else {
						$action = $route['action'];
						$middlewareStack = $route['middleware'];
						
						// Prepare Data and add anonymous function to $next variable
						$next = function ($request) use ($controller, $action, $params) {
							return call_user_func_array([new $controller, $action], $params);
						};
						
						// Processing Middleware if using A Controller With Action
						$next = Middleware::handleMiddleware($middlewareStack, $next);
						
						echo $next($uri);
					}
					
					return '';
				}
			}
		}
		throw new Log("This route $uri not found");
	}
}