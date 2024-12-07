<?php


namespace App\Http\Middleware;

use Contracts\Middleware\Contract;

class UsersMiddleware implements Contract
{
	/**
	 * @param $request
	 * @param $next
	 * @param $role
	 * @return mixed
	 */
	public function handle($request, $next, ...$role): mixed
	{
//		if ($role[0] == 'user') {
//			header('Location: ' . url('about'));
//			exit;
//		}
		return $next($request);
	}
}
