<?php

namespace illuminates\Http\Controllers;

use illuminates\Http\Validations\Validation;

class BaseController
{
	/**
	 * @param array|object $requests
	 * @param array $rules
	 * @param array|null $attributes
	 * @return Validation
	 * @throws \illuminates\Logs\Log
	 */
	public function validate(array|object $requests, array $rules, array|null $attributes = []): Validation
	{
		return Validation::make($requests, $rules, $attributes);
	}
}
