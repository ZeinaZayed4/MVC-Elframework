<?php

namespace illuminates\Database;

use illuminates\Database\Drivers\MySQLConnection;
use illuminates\Database\Drivers\SQLiteConnection;
use illuminates\Database\Queries\DBConditions;
use illuminates\Database\Queries\DBSelector;
use illuminates\Logs\Log;

class Model extends BaseModel
{
	use DBConditions, DBSelector;
	
	/**
	 * @throws Log
	 */
	public function __construct()
	{
		$config = config('database.driver');
		if ($config == 'mysql') {
			parent::__construct(new MySQLConnection());
		} elseif ($config == 'sqlite') {
			parent::__construct(new SQLiteConnection());
		} else {
			throw new Log('Database driver not supported');
		}
	}
	
	public static function getTable()
	{
		$class = new static;
		if ($class->table == null) {
			$class->table = strtolower((new \ReflectionClass(static::class))->getShortName()) . 's';
		}
		return $class->table;
	}
	
	public function toArray()
	{
		return (array) static::$attributes;
	}
}
