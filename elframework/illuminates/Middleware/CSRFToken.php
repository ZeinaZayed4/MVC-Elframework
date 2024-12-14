<?php

namespace illuminates\Middleware;

use illuminates\Http\Request;
use illuminates\Logs\Log;
use illuminates\Sessions\Session;

class CSRFToken
{
	/**
	 * @throws Log
	 */
	public function __construct()
	{
		if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' && (empty(Request::get('_token')) || Request::get('_token') !== Session::get('csrf_token'))) {
			throw new Log('Invalid CSRF token');
		}
	}
	
	/**
	 * @return string
	 * @throws \Random\RandomException
	 */
	public static function generateCSRFToken(): string
	{
		return bin2hex(random_bytes(32));
	}
}
