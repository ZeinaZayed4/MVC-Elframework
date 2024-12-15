<?php

namespace illuminates\Database\Types;

use illuminates\Database\Contracts\DatabaseConnectionInterface;
use illuminates\Logs\Log;
use PDO;

class SQLiteConnection implements DatabaseConnectionInterface
{
	private PDO $pdo;
	protected $path;
	
	/**
	 * @throws Log
	 */
	public function __construct()
	{
		$config = config('database.drivers');
		$this->path = $config['sqlite']['path'];
		try {
			$dsn = "sqlite:$this->path";
			$this->pdo = new PDO($dsn);
			$this->pdo->setAttribute($config['mysql']['ERRMODE'], $config['mysql']['EXCEPTION']);
		} catch (\Exception $e) {
			throw new Log($e->getMessage());
		}
	}
	
	public function getPDO(): PDO
	{
		return $this->pdo;
	}
}
