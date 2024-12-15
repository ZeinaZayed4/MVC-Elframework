<?php

namespace illuminates\Database;

use illuminates\Database\Types\MySQLConnection;
use illuminates\Database\Types\SQLiteConnection;
use illuminates\Logs\Log;

class Model extends BaseModel
{
	protected string $table;
	protected array $attributes = [];
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
		if ($this->table == null) {
			$model = explode('\\', strtolower(static::class));
			$this->table = end($model) . 's';
		}
	}
	
	/**
	 * @param $name
	 * @return mixed
	 */
	public function __get($name): mixed
	{
		return $this->attributes[$name] ?? null;
	}
	
	/**
	 * @param string $name
	 * @param $value
	 * @return void
	 */
	public function __set(string $name, $value): void
	{
		$this->attributes[$name] = $value;
	}
}
