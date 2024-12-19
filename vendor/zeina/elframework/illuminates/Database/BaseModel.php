<?php

namespace illuminates\Database;

use illuminates\Database\Contracts\DatabaseConnectionInterface;
use PDO;

abstract class BaseModel
{
	protected static PDO $db;
	protected ?string $table = null;
	protected static array $attributes = [];
	
	/**
	 * @param DatabaseConnectionInterface $connect
	 */
	public function __construct(DatabaseConnectionInterface $connect)
	{
		self::$db = $connect->getPDO();
	}
	
	/**
	 * @return object
	 */
	public static function getDBConfig(): object
	{
		$driver = config('database.driver');
		return (object) config('database.drivers')[$driver];
	}
	
	public static function setAttributes($attributes)
	{
		self::$attributes = $attributes;
	}
	
//	public static function getTable()
//	{
//		$class = new self;
//		return $class->table;
//	}
	
	/**
	 * @param $name
	 * @return mixed
	 */
	public function __get($name): mixed
	{
		return self::$attributes[$name] ?? null;
	}
	
	/**
	 * @param string $name
	 * @param $value
	 * @return void
	 */
	public function __set(string $name, $value): void
	{
		self::$attributes[$name] = $value;
	}
}
