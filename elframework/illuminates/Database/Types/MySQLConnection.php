<?php

namespace illuminates\Database\Types;

use illuminates\Database\Contracts\DatabaseConnectionInterface;
use PDO;

class MySQLConnection implements DatabaseConnectionInterface
{
	private PDO $pdo;
	protected $username;
	protected $password;
	protected $database;
	protected $charset;
	protected $host;
	public function __construct()
	{
		$config = config('database.drivers.mysql');
		$this->host = $config('host');
		$this->database = $config('database');
		$this->charset = $config('charset');
		$this->username = $config('username');
		$this->password = $config('password');
		$dsn = "mysql:host=$this->host;dbname=$this->database;charset=$this->charset";
		$this->pdo = new PDO($dsn, $this->username, $this->password);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	public function getPDO(): PDO
	{
		return $this->pdo;
	}
}
