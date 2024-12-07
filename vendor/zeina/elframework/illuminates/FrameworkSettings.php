<?php

namespace illuminates;

use illuminates\Sessions\Session;

class FrameworkSettings
{
	/**
	 * @return void
	 */
	public static function setTimeZone(): void
	{
		date_default_timezone_set(config('app.timezone'));
	}
	
	/**
	 * @return string
	 */
	public static function getTimeZone(): string
	{
		return date_default_timezone_get();
	}
	
	/**
	 * @return string
	 */
	public static function getLocale(): string
	{
		return Session::has('locale') ? Session::get('locale') : config('app.locale'); ;
	}
	
	/**
	 * @param string $locale
	 * @return string
	 */
	public static function setLocale(string $locale): string
	{
		Session::make('locale', $locale);
		return Session::get('locale');
	}
}
