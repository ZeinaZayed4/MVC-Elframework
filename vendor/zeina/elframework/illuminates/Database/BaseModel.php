<?php

namespace illuminates\Database;

use illuminates\Database\Types\MySQLConnection;
use illuminates\Database\Types\SQLiteConnection;
use illuminates\Logs\Log;
use PDO;

class BaseModel
{
	protected PDO $db;
	
	/**
	 * @throws Log
	 */
	public function __construct()
	{
		$config = config('database.driver');
		if ($config == 'mysql') {
			$this->db = (new MySQLConnection)->getPDO();
		} elseif ($config == 'sqlite') {
			$this->db = (new SQLiteConnection)->getPDO();
		} else {
			throw new Log('Database driver not supported');
		}
	}
}
