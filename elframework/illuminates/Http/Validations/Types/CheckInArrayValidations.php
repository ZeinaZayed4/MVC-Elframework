<?php

namespace illuminates\Http\Validations\Types;

trait CheckInArrayValidations
{
	protected static function in(mixed $rule, mixed $value)
	{
		$values = isset(explode(':', $rule)[1]) ? explode(',', $rule) : [];
		return !in_array($value, $values);
	}
}