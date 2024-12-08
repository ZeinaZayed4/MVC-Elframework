<?php

namespace illuminates\Locales;

use illuminates\FrameworkSettings;

class Lang
{
	/**
	 * @param string $key
	 * @param string $locale
	 * @return mixed|void|null
	 */
	private static function loadJsonTranslation(string $key, string $locale)
	{
		$path = base_path('app/lang/' . $locale . '.json');
		if (file_exists($path)) {
			$json = file_get_contents($path);
			$lang = json_decode($json, true);
			return $lang[$key] ?? null;
		}
	}
	
	/**
	 * @param array $key
	 * @param string $locale
	 * @return mixed|void|null
	 */
	private static function loadPHPTranslation(array $key, string $locale)
	{
		$path = base_path('app/lang/' . $locale . '/' . $key[0] .  '.php');
		if (file_exists($path)) {
			$lang = include $path;
			return $lang[$key[1]] ?? null;
		}
	}
	
	/**
	 * @param array $key
	 * @param string $locale
	 * @return mixed|null
	 */
	private static function loadTranslation(array $key, string $locale)
	{
		return isset($key[1]) ? self::loadPHPTranslation($key, $locale)
			: self::loadJsonTranslation($key[0], $locale);
	}
	
	/**
	 * @param string $trans
	 * @return array
	 */
	public static function path(string $trans): array
	{
		$key = explode('.', $trans);
		$locale = FrameworkSettings::getLocale();
		$translation = self::loadTranslation($key, $locale);
		
		if (!$translation) {
			$fallback_locale = config('app.fallback_locale');
			$translation = self::loadTranslation($key, $fallback_locale);
		}
		
		return [
			'has_trans' => isset($translation),
			'trans' => $translation ?? $trans,
		];
	}
	
	/**
	 * @param string $trans
	 * @return bool
	 */
	public static function has(string $trans): bool
	{
		return static::path($trans)['has_trans'];
	}
	
	/**
	 * @param string $trans
	 * @return string
	 */
	public static function get(string $trans): string
	{
		return static::path($trans)['trans'];
	}
}
