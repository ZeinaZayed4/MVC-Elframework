<?php

namespace illuminates\Database\Queries;

trait DBConditions
{
	protected static array $conditions = [];
	protected static array $columns = ['*'];
	
	/**
	 * @param string $column
	 * @param string $operator
	 * @param mixed $value
	 * @return \illuminates\Database\BaseModel|DBConditions
	 */
	public static function where(string $column, string $operator, mixed $value)
	{
		self::$conditions[] = [
			'column' => $column,
			'operator' => $operator,
			'value' => $value,
		];
		return new self;
	}
	
	/**
	 * @return string
	 */
	public static function buildSelectQuery(): string
	{
		$class = new self;
		$columns = implode(',', static::$columns);
		$query = "SELECT $columns FROM " . $class->table;
		if (static::$conditions) {
			$conditions = array_map(fn ($condition) => "{$condition['column']} {$condition['operator']} ?", static::$conditions);
			$query .= "WHERE " . implode(' AND ', $conditions);
		}
		return $query;
	}
	
	/**
	 * @return array
	 */
	public static function getConditionValues(): array
	{
		return array_map(fn ($condition) => $condition['value'], static::$conditions);
	}
}
