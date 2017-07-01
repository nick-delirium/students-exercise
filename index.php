<?php

// index controller

// display errors
ini_set('display_errors', 1);
error_reporting(E_ALL);

// load classes
define('ROOT', dirname(__FILE__));


include(ROOT.'/vendor/autoload.php');
//include(ROOT.'/vendor/composer/autoload_psr4.php');

// open session
session_start();



// call router
$router = new Router();
$router->run();
