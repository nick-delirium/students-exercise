<?php

// index controller

// display errors
ini_set('display_errors', 1);
error_reporting(E_ALL);

// load classes
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/autoload.php');
$loader = new Loader();
$loader->register();

// open session
session_start();


// call router
$router = new Router();
$router->run();
