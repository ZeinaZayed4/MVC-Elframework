<?php

namespace illuminates\Database;

use illuminates\Database\Contracts\DatabaseConnectionInterface;
use PDO;

abstract class BaseModel
{
	protected PDO $db;
	protected ?string $table = null;
	protected array $attributes = [];
	
	/**
	 */
	public function __construct(DatabaseConnectionInterface $connect)
	{
		$this->db = $connect->getPDO();
		if ($this->table == null) {
			$this->table = strtolower((new \ReflectionClass(static::class))->getShortName()) . 's';
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
