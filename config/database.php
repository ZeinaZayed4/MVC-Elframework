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
			'host' => 'http://127.0.0.1',
		],
		'sqlite' => [
			'engine' => 'sqlite',
			'path' => base_path('storage/db'),
		]
	]
];
