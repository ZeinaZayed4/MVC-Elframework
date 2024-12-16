<?php

namespace illuminates\Database;

use illuminates\Database\Drivers\MySQLConnection;
use illuminates\Database\Drivers\SQLiteConnection;
use illuminates\Database\Queries\DBConditions;
use illuminates\Database\Queries\Selector;
use illuminates\Logs\Log;

class Model extends BaseModel
{
	use DBConditions, Selector;
	
	/**
	 * @throws Log
	 */
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
