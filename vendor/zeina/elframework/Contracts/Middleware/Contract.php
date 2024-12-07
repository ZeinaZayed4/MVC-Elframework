<?php

namespace Contracts\Middleware;

interface Contract
{
	/**
	 * @param $request
	 * @param $next
	 * @param ...$role
	 * @return mixed
	 */
	public function handle($request, $next, ...$role): mixed;
}
