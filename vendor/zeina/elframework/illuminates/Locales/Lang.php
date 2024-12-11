<?php

namespace illuminates\Locales;

use illuminates\FrameworkSettings;

class Lang
{
	/**
	 * @param string $key
	 * @param string $locale
	 * @param array|null $attributes
	 * @return mixed|void|null
	 */
	private static function loadJsonTranslation(string $key, string $locale, array|null $attributes = [])
	{
		$path = base_path('app/lang/' . $locale . '.json');
		if (file_exists($path)) {
			$json = file_get_contents($path);
			$lang = json_decode($json, true);
		}
		return isset($lang[$key]) ? self::attribute($lang[$key], $attributes) : null;
	}
	
	/**
	 * @param array $key
	 * @param string $locale
	 * @param array|null $attributes
	 * @return mixed|void|null
	 */
	private static function loadPHPTranslation(array $key, string $locale, array|null $attributes = [])
	{
		$path = base_path('app/lang/' . $locale . '/' . $key[0] .  '.php');
		if (file_exists($path)) {
			$lang = include $path;
		}
		return isset($lang[$key[1]]) ? self::attribute($lang[$key[1]], $attributes) : null;
	}
	
	/**
	 * @param array $key
	 * @param string $locale
	 * @param array|null $attributes
	 * @return mixed|null
	 */
	private static function loadTranslation(array $key, string $locale, array|null $attributes = [])
	{
		return isset($key[1]) ? self::loadPHPTranslation($key, $locale, $attributes)
			: self::loadJsonTranslation($key[0], $locale, $attributes);
	}
	
	/**
	 * @param string $trans
	 * @param array|null $attributes
	 * @return array
	 */
	public static function path(string $trans, array|null $attributes = []): array
	{
		$key = explode('.', $trans);
		$locale = FrameworkSettings::getLocale();
		$translation = self::loadTranslation($key, $locale, $attributes);
		
		if (!$translation) {
			$fallback_locale = config('app.fallback_locale');
			$translation = self::loadTranslation($key, $fallback_locale, $attributes);
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
	 * @param array|null $attributes
	 * @return string
	 */
	public static function get(string $trans, array|null $attributes = []): string
	{
		return static::path($trans, $attributes)['trans'];
	}
	
	/**
	 * @param string $lang
	 * @param array $attributes
	 * @return string
	 */
	protected static function attribute(string $lang, array $attributes = []): string
	{
		$new_value = $lang;
		foreach ($attributes as $key => $value) {
			$new_value = str_replace(':' . $key, $value, $new_value);
		}
		return $new_value;
	}
}
