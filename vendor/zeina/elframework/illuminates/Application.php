<?php

namespace illuminates;

use illuminates\Router\Route;
use App\Core;
use illuminates\Router\Segment;

class Application
{
	protected $router;
	protected $framework_setting;
	
	/**
	 * To start MVC app
	 * @return void
	 */
	public function start(): void
	{
		$this->router = new Route();
		$this->framework_setting = new FrameworkSettings();
		$this->framework_setting::setTimeZone();
		
		if (parse_url(Segment::get(0))['path'] == 'api') {
			$this->apiRoute();
		} else {
			$this->webRoute();
		}
	}
	
	/**
	 * To dispatch many classes
	 */
	public function __destruct()
	{
		$this->router->dispatch(parse_url($_SERVER['REQUEST_URI'])['path'], $_SERVER['REQUEST_METHOD']);
	}
	
	/**
	 * @return void
	 */
	public function webRoute(): void
	{
		foreach (Core::$globalWeb as $global) {
			new $global();
		}
		$this->framework_setting::setLocale(config('app.locale'));
		include route_path('/web.php');
	}
	
	public function apiRoute(): void
	{
		foreach (Core::$globalApi as $global) {
			new $global();
		}
		include route_path('/api.php');
	}
}