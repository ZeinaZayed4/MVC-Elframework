<?php

namespace illuminates\Database;

use illuminates\Database\Types\MySQLConnection;
use illuminates\Database\Types\SQLiteConnection;
use illuminates\Logs\Log;

class Model extends BaseModel
{
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
}
