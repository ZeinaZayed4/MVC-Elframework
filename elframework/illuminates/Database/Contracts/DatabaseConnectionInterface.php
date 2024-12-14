<?php

namespace illuminates\Database\Contracts;

interface DatabaseConnectionInterface
{
	public function getPDO(): \PDO;
}
