<?php

namespace illuminates\Database\Queries;

use illuminates\Database\Queries\Collection;
use illuminates\Pagination\Paginator;

trait DBSelector
{
	/**
	 * @param int $id
	 * @return static|null
	 */
	public static function find(int $id): ?static
	{
		return static::where('id', $id)->first();
	}
	
	/**
	 * @return static|null
	 */
	public static function first(): ?static
	{
		$query = static::buildSelectQuery();
		$prepare = parent::$db->prepare($query);
		$prepare->execute(static::getConditionValues());
		$data = $prepare->fetch(static::getDBConfig()->FETCH_MODE);
		if ($data) {
			static::setAttributes($data);
			return new static;
		}
		return null;
	}
	
	/**
	 * @param array|null $columns
	 * @return \illuminates\Database\Queries\Collection|null
	 */
	public static function get(null|array $columns = [], ?int $limit = null, ?int $offset = null): ?Collection
	{
		$query = static::buildSelectQuery($columns, $limit, $offset);
		$prepare = parent::$db->prepare($query);
		$prepare->execute(static::getConditionValues());
		$data = $prepare->fetchAll(static::getDBConfig()->FETCH_MODE);
		if ($data) {
			return new Collection($data);
		}
		return null;
	}
	
	/**
	 * @return \illuminates\Database\Queries\Collection
	 */
	public static function all()
	{
		return static::get();
	}
	
	public static function paginate(int $perPage = 15): ?Paginator
	{
		$page = (int) request('page', 1);
		$perPage = (int) request('per_page', $perPage);
		$offset = ($page - 1) * $perPage;
		$collection = static::get([], $perPage, $offset);
		$total = static::count();
		return new Paginator(data: $collection, total: $total, currentPage: $page, perPage: $perPage);
	}
	
	/**
	 * @return int
	 */
	public static function count(): int
	{
		$query = "SELECT COUNT(*) as count FROM " . static::getTable();
		if (static::$conditions) {
			$conditions = array_map(fn ($condition) => "{$condition['column']} {$condition['operator']} ?", static::$conditions);
			$query .= " WHERE " . implode(' AND ', $conditions);
		}
		$prepare = parent::$db->prepare($query);
		$prepare->execute(static::getConditionValues());
		$data = $prepare->fetch(static::getDBConfig()->FETCH_MODE);
		return $data->count ?? 0;
	}
}
