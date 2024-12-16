<?php

namespace illuminates\Database\Queries;

trait Selector
{
	public static function find(int $id): ?self
	{
		$query = self::where('id', '=', $id)->buildSelectQuery();
		var_dump($query);
		exit;
		$prepare = parent::$db->prepare();
		$prepare->execute([$id]);
		$data = $prepare->fetch(static::getDBConfig()->FETCH_MODE);
		if ($data) {
			self::setAttributes($data);
			return new self;
		}
		return null;
	}
}
