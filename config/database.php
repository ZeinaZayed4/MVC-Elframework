<?php

return [
	'driver' => 'mysql',
	'drivers' => [
		'mysql' => [
			'engine' => 'mysql',
			'database' => 'elframework',
			'username' => 'root',
			'password' => '',
			'port' => '3306',
			'charset' => 'utf8mb4',
			'host' => '127.0.0.1',
			'FETCH_MODE' => PDO::FETCH_OBJ,
			'ERRMODE' => PDO::ATTR_ERRMODE,
			'EXCEPTION' => PDO::ERRMODE_EXCEPTION,
		],
		'sqlite' => [
			'engine' => 'sqlite',
			'path' => base_path('storage/db/sqlite.db'),
			'FETCH_MODE' => PDO::FETCH_OBJ,
			'ERRMODE' => PDO::ATTR_ERRMODE,
			'EXCEPTION' => PDO::ERRMODE_EXCEPTION,
		]
	]
];
