<?php

namespace illuminates\Database;

use illuminates\Database\Contracts\DatabaseConnectionInterface;
use PDO;

class BaseModel
{
	protected PDO $db;
	
	/**
	 */
	public function __construct(DatabaseConnectionInterface $connect)
	{
		$this->db = $connect->getPDO();
	}
}
