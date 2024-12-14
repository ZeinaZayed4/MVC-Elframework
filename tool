<?php

if(php_sapi_name() == 'cli') {
    $str = $_SERVER['argv'];
    if ($str[1] == 'storage:link') {
        if (@symlink(__DIR__ . '/storage/public', __DIR__ . '/public/storage')) {
		    echo 'Storage is linked ' . PHP_EOL;
		} else {
		    echo 'Storage already linked ' . PHP_EOL;
		}
    }
}
C:\xampp\htdocs\MVC\storage\public\my\images\1733942660.jpeg
