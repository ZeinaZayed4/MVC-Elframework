<?php

namespace illuminates\Views;

class View
{
	protected static $cacDir;
	
	/**
	 * @return void
	 */
	public static function prepare_cache(): void
	{
		self::$cacDir = config('view.cache_dir');
		if (!is_dir(self::$cacDir)) {
			mkdir(self::$cacDir, 0755, true);
		}
	}
	
	/**
	 * @param $view
	 * @param array|null $data
	 * @return mixed
	 */
	public static function make($view, null|array $data): mixed
	{
		if (config('view.cache')) {
			self::prepare_cache();
			$cache_file = static::getCacheFilePath($view);
			if(static::isCacheValid($cache_file)) {
				return include $cache_file;
			} else {
				$output = static::generateViewOutput($view, $data);
				file_put_contents(static::getCacheFilePath($view), $output);
				return $output;
			}
		} else {
			$view = str_replace('.', '/', $view);
			$path = config('view.path');
			extract($data);
			return include $path . '/' . $view . '.tpl.php';
		}
	}
	
	/**
	 * @param $view
	 * @return string
	 */
	protected static function getCacheFilePath($view): string
	{
		return static::$cacDir . '_' . md5(config('view.path') . '_' . $view) . '.cache.php';
	}
	
	/**
	 * @param $file
	 * @return bool
	 */
	protected static function isCacheValid($file): bool
	{
		return file_exists($file);
	}
	
	/**
	 * @param $view
	 * @param $data
	 * @return mixed
	 */
	protected static function generateViewOutput($view, $data): mixed
	{
		$view = str_replace('.', '/', $view);
		$path = config('view.path');
		extract($data);
		ob_start();
		include $path . '/' . $view . '.tpl.php';
		return ob_get_clean();
	}
}
