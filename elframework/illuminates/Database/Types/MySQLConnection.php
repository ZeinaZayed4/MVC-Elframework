<?php

namespace illuminates\Database\Types;

use illuminates\Database\Contracts\DatabaseConnectionInterface;
use PDO;

class MySQLConnection implements DatabaseConnectionInterface
{
	private PDO $pdo;
	protected mixed $username;
	protected mixed $password;
	protected mixed $database;
	protected mixed $charset;
	protected mixed $host;
	public function __construct()
	{
		$config = config('database.drivers');
		$this->host = $config['mysql']['host'];
		$this->database = $config['mysql']['database'];
		$this->charset = $config['mysql']['charset'];
		$this->username = $config['mysql']['username'];
		$this->password = $config['mysql']['password'];
		$dsn = "mysql:host=$this->host;dbname=$this->database;charset=$this->charset";
		$this->pdo = new PDO($dsn, $this->username, $this->password);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	public function getPDO(): PDO
	{
		return $this->pdo;
	}
}
