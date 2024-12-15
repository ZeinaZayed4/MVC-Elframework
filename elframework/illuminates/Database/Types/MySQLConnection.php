<?php

namespace illuminates\Database\Types;

use Exception;
use illuminates\Database\Contracts\DatabaseConnectionInterface;
use illuminates\Logs\Log;
use PDO;

class MySQLConnection implements DatabaseConnectionInterface
{
	private PDO $pdo;
	protected mixed $username;
	protected mixed $password;
	protected mixed $database;
	protected mixed $charset;
	protected mixed $host;
	protected mixed $port;
	
	/**
	 * @throws Log
	 */
	public function __construct()
	{
		$config = config('database.drivers');
		$this->port = $config['mysql']['port'];
		$this->host = $config['mysql']['host'] . ':' . $this->port;
		$this->database = $config['mysql']['database'];
		$this->charset = $config['mysql']['charset'];
		$this->username = $config['mysql']['username'];
		$this->password = $config['mysql']['password'];
		try {
			$dsn = "mysql:host=$this->host;dbname=$this->database;charset=$this->charset";
			$this->pdo = new PDO($dsn, $this->username, $this->password);
			$this->pdo->setAttribute($config['mysql']['ERRMODE'], $config['mysql']['EXCEPTION']);
		} catch (Exception $e) {
			throw new Log($e->getMessage());
		}
	}
	
	public function getPDO(): PDO
	{
		return $this->pdo;
	}
}
