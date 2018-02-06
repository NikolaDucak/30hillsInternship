<?php

define('BASE_DIR', __DIR__);
define('BASE_URL', getBaseUrl());

spl_autoload_register(function($name){
	if (file_exists(BASE_DIR . '/classes/' . $name . '.php')) {
		include_once(BASE_DIR . '/classes/' . $name . '.php');
	}
});

function getBaseUrl() 
{

    $currentPath = $_SERVER['PHP_SELF']; 
    $pathInfo = pathinfo($currentPath); 
    $hostName = $_SERVER['HTTP_HOST']; 
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
    return $protocol.$hostName.$pathInfo['dirname']."/";
}
