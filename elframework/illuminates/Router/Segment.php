<?php

namespace illuminates\Router;

class Segment
{
	/**
	 * @return string
	 */
	public static function uri(): string
	{
		return str_replace(ROOT_DIR, '', $_SERVER['REQUEST_URI']);
	}
	
	/**
	 * @param int $offset
	 * @return string
	 */
	public static function get(int $offset): string
	{
		$uri = self::uri();
		$segments = explode('/', $uri);
		return $segments[$offset] ?? '';
	}
	
	/**
	 * @return string[]
	 */
	public static function all(): array
	{
		return explode('/', static::uri());
	}
}
