<?php

namespace illuminates\Database\Types;

use illuminates\Database\Contracts\DatabaseConnectionInterface;
use PDO;

class SQLiteConnection implements DatabaseConnectionInterface
{
	private PDO $pdo;
	protected $path;
	
	public function __construct()
	{
		$config = config('database.drivers.sqlite');
		$this->path = $config('path');
		$dsn = "sqlite:$this->path";
		$this->pdo = new PDO($dsn);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	public function getPDO(): PDO
	{
		return $this->pdo;
	}
}
