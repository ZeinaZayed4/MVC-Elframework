<?php

namespace illuminates\Middleware;

use App\Core;
use Exception;
use illuminates\Logs\Log;
use illuminates\Router\Segment;

class Middleware
{
	/**
	 * @param $middlewareStack
	 * @param $next
	 * @return mixed
	 */
	public static function handleMiddleware($middlewareStack, $next): mixed
	{
		if (!empty($middlewareStack) && is_array($middlewareStack)){
			foreach (array_reverse($middlewareStack) as $middleware) {
				$next = function ($request) use ($middleware, $next) {
					$role = explode(',', $middleware);
					$middleware = array_shift($role);
					if (!class_exists($middleware)) {
						$middleware =  self::getFromCore($middleware);
					}
					return (new $middleware)->handle($request, $next, ...$role);
				};
			}
		}
		return $next;
	}
	
	/**
	 * @throws Exception
	 */
	public static function getFromCore($key): mixed
	{
		$type = Segment::get(0) == 'api' ?? 'web';
		
		if ($type == 'web' && isset(Core::$middlewareWebRoute[$key])){
			return Core::$middlewareWebRoute[$key];
		} elseif ($type == 'api' && isset(Core::$middlewareApiRoute[$key])){
			return Core::$middlewareApiRoute[$key];
		} else {
			throw new Log("This middleware $key not found");
		}
	}
}
