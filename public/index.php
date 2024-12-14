<?php

define('ROOT_PATH', dirname(__FILE__));
define('ROOT_DIR', str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])) . '/');

/**
 * Run composer autoloader
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * Run the framework
 */
(new \illuminates\Application)->start();
