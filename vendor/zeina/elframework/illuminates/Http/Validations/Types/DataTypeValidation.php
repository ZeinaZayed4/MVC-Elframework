<?php

namespace illuminates\Http\Validations\Types;

trait DataTypeValidation
{
	public static function required(mixed $value): bool
	{
		return (is_null($value) || empty($value) || (isset($value['tmp_name']) && empty($value['tmp_name'])));
	}
	
	public static function string(mixed $value): bool
	{
		return !is_string($value) || is_numeric(($value));
	}
	
	public static function integer(mixed $value): bool
	{
		return !filter_var((int) $value, FILTER_VALIDATE_INT) || !is_numeric(($value));
	}
	
	public static function numeric(mixed $value): bool
	{
		return !preg_match('/^[0-9]+$/', $value);
	}
	
	public static function json(mixed $value): bool
	{
		json_decode($value);
		return !(json_last_error() === JSON_ERROR_NONE);
	}
	
	public static function array(mixed $value): bool
	{
		return !is_array($value);
	}
	
	public static function email(mixed $value): bool
	{
		return !filter_var($value, FILTER_VALIDATE_EMAIL);
	}
}
