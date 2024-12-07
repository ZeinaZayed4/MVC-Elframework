<?php

namespace App\Http\Middleware;

use Contracts\Middleware\Contract;
use illuminates\FrameworkSettings;

class SimpleMiddleware implements Contract
{
	/**
	 * @param $request
	 * @param $next
	 * @param mixed ...$role
	 * @return mixed
	 */
	public function handle($request, $next, ...$role): mixed
	{
//		FrameworkSettings::setLocale($_GET['lang']);
//		if ($role[0] == 'user') {
//			header('Location: ' . url('about'));
//			exit;
//		}
		return $next($request);
	}
}
